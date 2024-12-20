<?php

namespace App\Http\Controllers\Backend\CourseManagement\Course;

use App\DataTables\Course\CourseStudentDataTable;
use App\helper\ViewHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CourseManagement\CourseCreateFormRequest;
use App\Imports\Backend\StudentTransfer\StudentTransferImport;
use App\Models\Backend\BatchExamManagement\BatchExam;
use App\Models\Backend\BatchExamManagement\BatchExamRoutine;
use App\Models\Backend\BatchExamManagement\BatchExamSection;
use App\Models\Backend\BatchExamManagement\BatchExamSubscription;
use App\Models\Backend\Course\Course;
use App\Models\Backend\Course\CourseCategory;
use App\Models\Backend\Course\CourseCoupon;
use App\Models\Backend\Course\CourseRoutine;
use App\Models\Backend\Course\CourseSection;
use App\Models\Backend\Course\CourseSectionContent;
use App\Models\Backend\OrderManagement\ParentOrder;
use App\Models\Backend\UserManagement\Student;
use App\Models\Backend\UserManagement\Teacher;
use App\Models\CourseStudent;
use App\Models\User;
use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\Cursor;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
//use function PHPUnit\Runner\validate;
use DataTable;
use Yajra\DataTables\Facades\DataTables;
use Hash;
use Obs\ObsClient;
use Zing\Flysystem\Obs\ObsAdapter;



class CourseController extends Controller
{
    //    permission seed done
    protected $course, $courses = [];
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('manage-course'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!empty($request->category_id))
        {

            $courseCategory = CourseCategory::where('id', $request->category_id)->with(['coursesDescOrder' => function ($courses) {
                $courses->select('id','title','price','banner','is_featured','is_paid','status','alt_text','banner_title')->get();
            }])->select('id')->first();

            $this->courses = ViewHelper::paginateContentByCollectionFormat($request, $courseCategory->coursesDescOrder, 15, 'category_id');
        } else {
            $this->courses = Course::where('parent_id', 0)->orderBy('id', 'DESC')->select('id','title','price','duration_in_month','discount_amount', 'banner','is_featured','is_paid','status','alt_text','banner_title')->paginate(15);
        }

        return view('backend.course-management.course.courses.index', [
            'courses'   => $this->courses,
            'courseCategories'  => CourseCategory::whereStatus(1)->where('parent_id', 0)->with('courseCategories')->orderBy('order', 'DESC')->select('id','name', 'parent_id')->get(),
            'teachers'  => Teacher::whereStatus(1)->select('id', 'user_id')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('create-course'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCreateFormRequest $request)
    {

        abort_if(Gate::denies('store-course'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->course = Course::createOrUpdateCourse($request);
        $this->course->courseCategories()->sync(explode(',', $request->course_categories[0]));
//        $this->course->teachers()->sync($request->teachers_id);
        if ($request->ajax())
        {
            return response()->json('Course Created Successfully.');
        } else {
            return back()->with('success', 'Course Created Successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(Gate::denies('show-course'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.course-management.course.courses.show', [
            'course'    => Course::where('id',$id)->with('courseCategories')->first(),
            'courseCategories'  => CourseCategory::whereStatus(1)->get(),
            'teachers'  => Teacher::whereStatus(1)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        abort_if(Gate::denies('edit-course'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.course-management.course.courses.edit', [
            'course'    => Course::where('id',$id)->with('courseCategories')->first(),
            'courseCategories'  => CourseCategory::whereStatus(1)->where('parent_id', 0)->orderBy('order', 'ASC')->get(),
            'teachers'  => Teacher::whereStatus(1)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseCreateFormRequest $request, string $id)
    {
        // dd($request->all());
        abort_if(Gate::denies('update-course'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->course = Course::createOrUpdateCourse($request, $id);
            $this->course->courseCategories()->sync(explode(',', $request->course_categories[0]));
//        $this->course->teachers()->sync($request->teachers_id);
            if ($request->ajax())
            {
                return response()->json('Course Updated Successfully.');
            } else {
                return back()->with('success', 'Course Updated Successfully.');
            }
        } catch (\Exception $exception)
        {
            return response()->json($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(Gate::denies('delete-course'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//        return back()->with('error', 'Feature temporary disabled. Please contact your admin to enable it.');
        $user = auth()->user();
        foreach ($user->roles as $role)
        {
            if ($role->id == 1)
            {
                $delete_user = ParentOrder::where('parent_model_id',$id)->delete();
                $this->course = Course::find($id)->delete();
                return back()->with('success', 'Course deleted Successfully.');
            }
        }

        return back()->with('error', 'You dont have permission to delete this course.');
    }

    public function assignTeacherToCourse ($courseId)
    {
        abort_if(Gate::denies('assign-course-teacher-page'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.course-management.course.courses.assign-teacher', [
            'course'   => Course::find($courseId),
            'teachers'  => Teacher::whereStatus(1)->get()
        ]);
    }

    public function assignTeacher (Request $request, $id)
    {
        abort_if(Gate::denies('assign-course-teacher'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate(['teachers' => 'required']);
        $this->course = Course::find($id);
        $this->course->teachers()->sync($request->teachers);
        return back()->with('success', 'Trainer assigned to course successfully.');
    }
    public function detachTeacher (Request $request, $id)
    {
        abort_if(Gate::denies('detach-course-teacher'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->course = Course::find($id);
        if (count($this->course->teachers) > 1)
        {
            $this->course->teachers()->detach($request->teacher_id);
            return back()->with('success', 'Trainer assigned to course successfully.');
        }
        return back()->with('error', 'You must assign one teacher for this course.');
    }

    public function assignStudentToCourse (Request $request, CourseStudentDataTable $dataTable, $courseId)
    {
        abort_if(Gate::denies('assign-course-student-page'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->course = Course::select('id', 'title')->find($courseId);
        $students = [];
        $students =  ParentOrder::where('parent_model_id', $courseId)->with('user')->paginate(5000);
//        if ($request->ajax())
//        {
//            return \view('backend.course-management.course.courses.ajax-assign-student', ['students' => $students, 'course' => $this->course]);
//        }
        return view('backend.course-management.course.courses.assign-student', [
            'course'   => $this->course,
            'students'  => $students,
            'courses'   => Course::get(['id', 'title'])
        ]);
    }
    public function assignStudentProfile ($user_id)
    {
       //return $student_id;
        abort_if(Gate::denies('assign-course-student-page'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student = Student::select('user_id','first_name','last_name','email','mobile','image','created_at',)->where('user_id',$user_id)->first();
        if(!$student){
            return back()->with('warning', 'Not found!');
        }
        $allOrders = ParentOrder::where(['user_id' => $user_id])->select('id', 'parent_model_id', 'user_id', 'order_invoice_number', 'ordered_for', 'total_amount', 'paid_amount', 'payment_status', 'status','created_at')->orderBy('order_invoice_number','DESC')->with('course:id,title,price', 'batchExam:id,title,price','product:id,title,price')->get();

        return view('backend.role-management.user.student.profile',compact('student','allOrders'));
    }

    public function searchStudentAjax(Request $request)
    {
//        $users =  User::where('mobile', 'LIKE', '%'.$request->mobile.'%')->select('id', 'mobile')->get();
        $users = Student::where('mobile', 'LIKE', '%'.$request->mobile.'%')->select('id', 'mobile')->get();
        return \response()->json($users);
    }

    public function assignStudent (Request $request, $transferToId)
    {
//        return $request;
        abort_if(Gate::denies('assign-course-student'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $xlArray = [];

        if (isset($request->student_file)){
            $xlArray = Excel::toArray(new StudentTransferImport(), $request->file('student_file'))[0];

            foreach ($xlArray as $key => $item)
            {
                if ($key != 0)
                {
                    $user = User::where('mobile', $item[0])->first();
                    if (isset($user))
                    {
                        $student=Student::where('user_id', $user->id)->first();
                        if (!empty($student))
                        {
                            $courseStudent = CourseStudent::where(['student_id' => $student->id, 'course_id' => $transferToId])->first();
                            if (empty($courseStudent))
                            {
                                $this->createNewParentOrder($user->id, $transferToId);
                                Course::find($transferToId)->students()->attach($student->id);
                            }
                        }
                    }
                }
            }
        }else{
            foreach ($request->course_transfer_form_id as $courseId)
            {
                $this->course = Course::find($courseId);
                $st = CourseStudent::where('course_id',$courseId)->get();
                foreach ($st as $courseStudent){
                    $stud = Student::where('id', $courseStudent->student_id)->first();
                    if (!empty($stud))
                    {
                        $existStudentCourse = CourseStudent::where(['student_id' => $stud->id, 'course_id' => $transferToId])->first();
                        if (empty($existStudentCourse))
                        {
                            $this->createNewParentOrder($stud->user_id, $transferToId);
                            Course::find($transferToId)->students()->attach($stud->id);
                        }

                    }
                }
            }
        }
        return back()->with('success', 'Student assigned to course Successfully.');
    }


    public function createNewParentOrder($userId, $transferToId)
    {
        $parentOrder = new ParentOrder();
        $parentOrder->user_id   = $userId;
        $parentOrder->parent_model_id   = $transferToId;
        $parentOrder->ordered_for   = 'course';
        $parentOrder->payment_method   = 'cod';
        $parentOrder->vendor   = 'bkash';
        $parentOrder->paid_to   = '01963929208';
        $parentOrder->paid_from   = '01963929208';
        $parentOrder->txt_id   = 'abc';
        $parentOrder->paid_amount   = '0';
        $parentOrder->total_amount   = '0';
        $parentOrder->status   = 'approved';
        $parentOrder->payment_status   = 'complete';
        $parentOrder->save();
    }

    public function assignNewStudent(Request $request, $id)
    {
        abort_if(Gate::denies('assign-course-student'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validator = $request->validate([
            'student_id' => 'required',
            'paid_amount' => 'required',
            'payment_status' => 'required',
        ]);
        $this->course = Course::find($id);
        foreach ($this->course->students as $student)
        {
            if ($student->id == $request->student_id)
            {
                return back()->with('error', 'Student Already assigned this course.');
            }
        }
        ParentOrder::assignNewStudentToModel('course', $request, $id);
        $this->course->students()->attach($request->student_id);
        return back()->with('success', 'Student assigned to course Successfully.');
    }
    public function detachStudent (Request $request, $id)
    {
        // dd($request->all());
        abort_if(Gate::denies('detach-course-student'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->course = Course::find($id);
        $this->course->students()->detach($request->student_id);
        ParentOrder::where(['parent_model_id' => $id, 'user_id' => User::find($request->student_id)->id])->first()->update(['status' => 'canceled']);
        return back()->with('success', 'Student assigned to course Successfully.');
    }


    // public function detachStudent(Request $request, $id)
    // {
    //     abort_if(Gate::denies('detach-course-student'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $this->course = Course::find($id);
    //     $this->course->students()->detach($request->student_id);

    //     $student = Student::find($request->student_id);
    //     if ($student) {
    //         $parentOrder = ParentOrder::where(['parent_model_id' => $id, 'user_id' => $student->user_id])->first();
    //         if ($parentOrder) {
    //             $parentOrder->update(['status' => 'canceled']);
    //         } else {
    //             // Handle the case where ParentOrder is not found
    //             return back()->with('error', 'ParentOrder not found.');
    //         }
    //     } else {
    //         // Handle the case where Student is not found
    //         return back()->with('error', 'Student not found.');
    //     }

    //     return back()->with('success', 'Student detached from course successfully.');
    // }






    public function getCoursesByCategory($id)
    {
        return response()->json(CourseCategory::find($id)->courses);
    }

    protected $courseArray ;
    public function exportCourseJson($modelName, $modelId)
    {

// return $modelId;

        $tempDir = public_path('backend/json-tmp-dir/');
        if (!File::isDirectory($tempDir))
        {
            File::makeDirectory($tempDir, 0777, true, true);
        }
        if ($modelName == 'course')
        {
            $modelData = Course::whereId($modelId)->with(['courseRoutines', 'courseCoupons', 'courseSections.courseSectionContents'])->first();
        } elseif ($modelName == 'batch_exam')
        {
            $modelData = BatchExam::whereId($modelId)->with(['batchExamRoutines', 'batchExamSubscriptions', 'batchExamSections.batchExamSectionContents'])->first();
        }
        // return $modelData;
        File::put($tempDir.time().'-'.$modelName.'-export.json', $modelData);
        return \response()->download($tempDir.time().'-'.$modelName.'-export.json');
    }

    public function importModelJson(Request $request, $model)
    {
        try {
            $data = json_decode(File::get($request->file('json_file')->getRealPath()));
            if ($model == 'course')
            {
//            return $data->course_sections[0]->course_section_contents;
                $this->course = Course::importCourseModel($data);

//            course routines
                if (isset($data->course_routines) && count($data->course_routines) > 0)
                {
                    CourseRoutine::importCourseRoutine($data->course_routines, $this->course->id);
                }

//                course coupons
                if (isset($data->course_coupons) && count($data->course_coupons) > 0)
                {
                    CourseCoupon::importCourseCoupon($data->course_coupons, $this->course->id);
                }

//                course sections
                if (isset($data->course_sections) && count($data->course_sections) > 0)
                {
                    CourseSection::importCourseSections($data->course_sections, $this->course->id);
                }
            } elseif ($model == 'batch_exam')
            {
//                batch exam
                $batchExam = BatchExam::importBatchExamJson($data);

//                batch exam routines
                if (isset($data->batch_exam_routines) && count($data->batch_exam_routines) > 0)
                {
                    BatchExamRoutine::importBatchExamRoutine($data->batch_exam_routines, $batchExam->id);
                }

//                batch_exam_subscriptions
                if (isset($data->batch_exam_subscriptions) && count($data->batch_exam_subscriptions) > 0)
                {
                    BatchExamSubscription::importBatchExamSubcriptionsJson($data->batch_exam_subscriptions, $batchExam->id);
                }

//                batch_exam_sections
                if (isset($data->batch_exam_sections) && count($data->batch_exam_sections) > 0)
                {
                    BatchExamSection::importBatchExamSectionJson($data->batch_exam_sections, $batchExam->id);
                }
            }
            return back()->with('success', $model.' imported successfully.');
        } catch (\Exception $exception)
        {
            return back()->with('error', $exception->getMessage());
        }

    }

    public function saveNestedSectionsAndContents (Request $request)
    {
        $json = $request->nested_category_array;
        $decoded_json = json_decode($json, TRUE);

        $simplified_list = [];
        $this->recur1($decoded_json, $simplified_list);

        DB::beginTransaction();
        try {
            $info = [
                "success" => FALSE,
            ];
//            return $decoded_json;
//            foreach($simplified_list as $k => $v){
//                $category = CourseCategory::find($v['category_id']);
//                $category->fill([
//                    "parent_id" => $v['parent_id'],
//                    "order" => $v['sort_order'],
//                ]);
//
//                $category->save();
//            }

            foreach ($decoded_json as $sectionOrder => $section)
            {
                $courseSection = CourseSection::find($section['id']);
                if (isset($courseSection))
                {
                    $courseSection->order = ++$sectionOrder;
                    $courseSection->save();

                    foreach ($section['children'] as $contentOrder => $content)
                    {
                        $courseContent = CourseSectionContent::find( $content['id']);
                        if (isset($courseContent))
                        {
                            $courseContent->order = ++$contentOrder;
                            $courseContent->save();
                        }
                    }
                }
            }

            DB::commit();
            $info['success'] = TRUE;
        } catch (\Exception $e) {
            DB::rollback();
            $info['success'] = FALSE;
        }

        if($info['success']){
            $request->session()->flash('success', "All Orders updated.");
        }else{
            $request->session()->flash('error', "Something went wrong while updating...");
        }
        if ($request->ajax())
        {
            return response()->json('Order Updated');
        } else {
            return redirect(route('course-categories.index'));
        }
    }

    public function saveNestedCourses (Request $request)
    {
        $json = $request->nested_category_array;
        $decoded_json = json_decode($json, TRUE);

        $simplified_list = [];
        $this->recur1($decoded_json, $simplified_list);

        DB::beginTransaction();
        try {
            $info = [
                "success" => FALSE,
            ];

            foreach($simplified_list as $k => $v){
                $category = Course::find($v['category_id']);
                $category->fill([
                    "parent_id" => $v['parent_id'],
                    "c_order" => $v['sort_order'],
                ]);

                $category->save();
            }

            DB::commit();
            $info['success'] = TRUE;
        } catch (\Exception $e) {
            DB::rollback();
            $info['success'] = FALSE;
        }

        if($info['success']){
            $request->session()->flash('success', "All Courses updated.");
        }else{
            $request->session()->flash('error', "Something went wrong while updating...");
        }
        if ($request->ajax())
        {
            return response()->json('Order Updated');
        } else {
            return redirect(route('courses.index'));
        }
    }

    public function recur1($nested_array=[], &$simplified_list=[]){

        static $counter = 0;

        foreach($nested_array as $k => $v){

            $sort_order = $k+1;
            $simplified_list[] = [
                "category_id" => $v['id'],
                "parent_id" => 0,
                "sort_order" => $sort_order
            ];

            if(!empty($v["children"])){
                $counter+=1;
                $this->recur2($v['children'], $simplified_list, $v['id']);
            }

        }
    }

    public function recur2($sub_nested_array=[], &$simplified_list=[], $parent_id = NULL){

        static $counter = 0;

        foreach($sub_nested_array as $k => $v){

            $sort_order = $k+1;
            $simplified_list[] = [
                "category_id" => $v['id'],
                "parent_id" => $parent_id,
                "sort_order" => $sort_order
            ];

            if(!empty($v["children"])){
                $counter+=1;
                return $this->recur2($v['children'], $simplified_list, $v['id']);
            }
        }
    }


    public function import(Request $request)
    {
        $name = $request->name;
        $id = Course::where('title',$name)->first();
        $id = $id->id;

        $xlArray = [];

        $xlArray = Excel::toArray(new StudentTransferImport(), $request->file('student_file'))[0];

        // dd($xlArray);

            foreach ($xlArray as $key => $item)
            {

                if ($item[2] != null) {
                    # code...
                    $check = User::where('mobile',$item[2])->first();

                    if ($check) {
                        # code...
                        $check_2 = ParentOrder::where('parent_model_id',$id)->where('user_id',$check->id)->first();

                        if (empty($check_2) ) {

                            ParentOrder::create([
                                'parent_model_id'           => $id,
                                'user_id'                   => $check->id,
                                'order_invoice_number'      => mt_rand(00000,8484986484),
                                'ordered_for'               => 'course',
                                'payment_method'            => 'cod',
                                'vendor'                    => 'bkash',
                                'paid_to'                   => '01896060888',
                                'paid_from'                 => $item[3],
                                'txt_id'                    => mt_rand(00000,8484986484),
                                'paid_amount'               => $item[4],
                                'total_amount'              => $item[4],
                                'payment_status'            => 'complete',
                                'status'                    => 'approved',
                                'batch_exam_subscription_id' => isset($request->batch_exam_subscription_id) ?? null,
                            ]);
                        }

                    }else{
                        $user = new User();

                        $user->name       = $item[1];
                        $user->mobile       = '0'.$item[2];

                        $user->password   = Hash::make('123456789');
                        $user->p_code     = $user->password;

                        $user->status     = 1;
                        $user->save();

                        DB::table('role_user')->insert([
                            'user_id'=> $user->id,
                            'role_id'=>4
                        ]);

                        ParentOrder::create([
                            'parent_model_id'           => $id,
                            'user_id'                   => $user->id,
                            'order_invoice_number'      => mt_rand(00000,8484986484),
                            'ordered_for'               => 'course',
                            'payment_method'            => 'cod',
                            'vendor'                    => 'bkash',
                            'paid_to'                   => '01896060888',
                            'paid_from'                 => $item[3],
                            'txt_id'                    => mt_rand(00000,8484986484),
                            'paid_amount'               => $item[4],
                            'total_amount'              => $item[4],
                            'payment_status'            => 'complete',
                            'status'                    => 'approved',
                            'batch_exam_subscription_id' => isset($request->batch_exam_subscription_id) ?? null,
                        ]);
                    }
                }


            }

        // $missing = [];

        // $added = [];

        // foreach ($xlArray as $key => $value) {
        //     # code...
        //     $check = User::where('mobile', '0'.$value[0])->first();

        //     if ($check) {
        //         # code...
        //         array_push($added, $check->id);
        //     }else {
        //         # code...
        //         array_push($missing, $value[0]);
        //     }
        // }

            return 'success';

    }



    public function merge()
    {
        $user = DB::connection('mysql2')->table('users')->get();

        foreach($user as $u)
        {
            $check = DB::connection('mysql')->table('users')->first();

            if (empty($check)) {
                # code...

                $password = hash::make('123456789');

                $user = DB::connection('mysql')->table('users')->insert([
                    'name'=>$u->name,
                    'mobile'=>$u->mobile,
                    'password'=>$password,
                    'p_code'=>$password,
                    'status'=>1,
                ]);
            }
        }

        return 'success';

    }
    public function assign_role()
    {
        $data = User::get();

        foreach ($data as  $value) {
            # code...
            $check = DB::table('role_user')->where('user_id',$value->id)->first();

            if (empty($check)) {
                # code...
                $add = DB::table('role_user')->insert([
                    'user_id' => $value->id,
                    'role_id' => 4
                ]);
            }

            echo $value->id;

        }

        return 'done';
    }

    public function change_number()
    {
        $data = ParentOrder::latest()->take(20000)->get();
        foreach ($data as $key => $value) {
            # code...
            $user = User::where('id', $value->user_id)->first();


            if (empty($user)) {
                # code...
                $delete = ParentOrder::where('id',$value->id)->delete();
            }else{
                if ($value->paid_from != $user->mobile) {
                    # code...
                    $change = ParentOrder::find($value->id);
                    $change->paid_from = $user->mobile;
                    $change->update();
                }
            }
        }


        return 'success';

    }

    public function course_student()
    {
        $data = ParentOrder::latest()->take(20000)->get();

        $missing = [];

        foreach ($data as $key => $value) {

            $check = CourseStudent::where('student_id',$value->user_id)->where('course_id',$value->parent_model_id)->first();

            if (empty($check)) {
                # code...
                // $add = DB::table('course_student')->insert([
                //     'student_id'=>$value->user_id,
                //     'course_id'=> $value->parent_model_id,
                // ]);

                array_push($missing, $value->id);
            }
        }

        dd($missing);

        return 'success';

    }


    public function clean()
    {
        $id = 688;

        $delete = ParentOrder::where('parent_model_id',$id)->delete();
    }





     // This Function use for OBS fileUpload
    /*public function fileUpload ($fileObject, $directory, $nameString = null, $modelFileUrl = null)
    {
        // if ($fileObject)
        // {
            // if (isset($modelFileUrl))
            // {
            //     if (file_exists($modelFileUrl))
            //     {
            //         unlink($modelFileUrl);
            //     }
            // }

            $files = Storage::allFiles('D:\pdf');

            dd($files);

            $fileName       = $nameString.str_replace(' ', '-', pathinfo($fileObject->getClientOriginalName(), PATHINFO_FILENAME)).'_'.rand(100,100000).'.'.$fileObject->extension();
            $fileDirectory  = 'pdf/'.$directory;
            $fileObject->move($fileDirectory, $fileName);

            $prefix = '';
            $config = [
                'key' => '7NBPYLX5IMJMXEVUAMJR',
                'secret' => 'k8PDyRPK94ZXjtoZExxCqqEXD8HI4jN63qCtJW0Z',
                'bucket' => 'biddabari-bucket',
                'endpoint' => 'obs.as-south-208.rcloud.reddotdigitalit.com',
            ];

            $config['options'] = [
                'url' => '',
                'endpoint' => $config['endpoint'],
                'bucket_endpoint' => 'https://biddabari-bucket.obs.as-south-208.rcloud.reddotdigitalit.com',
                'temporary_url' => '',
            ];

            $client = new ObsClient($config);
            $adapter = new ObsAdapter($client, $config['bucket'], $prefix, null, null, $config['options']);
            $flysystem = new Filesystem($adapter);

            // dd(env('OBS_BUCKET'));

            $result = $client->putObject([
                'Bucket' => 'biddabari-bucket',
                'Key' => $fileDirectory.$fileName,
                'SourceFile' => $fileDirectory.$fileName,
                ]);

                if (file_exists($fileDirectory.$fileName))
                {
                    unlink($fileDirectory.$fileName);
                }



        //     return $fileDirectory.$fileName;
        // }
    }*/



    // This Function use for AWS fileUpload

    public function fileUpload($fileObject, $directory, $nameString = null, $modelFileUrl = null)
    {
        if ($fileObject) {
            // Delete the previous file from S3 if a URL is provided
            /*if ($modelFileUrl && Storage::disk('s3')->exists($modelFileUrl)) {
                Storage::disk('s3')->delete($modelFileUrl);
            }*/

            /*if ($modelFileUrl) {
                $filePath = parse_url($modelFileUrl, PHP_URL_PATH);
                $filePath = ltrim($filePath, '/');

                if ($filePath && Storage::disk('s3')->exists($filePath)) {
                    Storage::disk('s3')->delete($filePath);
                }
            }*/

            $fileName = ($nameString ? $nameString . '-' : '') .
                str_replace(' ', '-', pathinfo($fileObject->getClientOriginalName(), PATHINFO_FILENAME)) .
                '_' . rand(100, 100000) . '.' . $fileObject->extension();
            $fileDirectory = 'pdf/' . rtrim($directory, '/') . '/';


            $s3FilePath = $fileDirectory . $fileName;

            // Configure AWS S3 client
            $s3Client = new S3Client([
                'version' => 'latest',
                'region' => env('AWS_DEFAULT_REGION'),
                'credentials' => [
                    'key' => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
            ]);

            /*// Upload the file to S3
            $result = $s3Client->putObject([
                'Bucket' => env('AWS_BUCKET'),
                'Key' => $s3FilePath,
                'SourceFile' => $fileObject->getRealPath(),
            ]);


            return $result['ObjectURL'];*/

            // Upload file to S3
            $s3Client->putObject([
                'Bucket' => env('AWS_BUCKET'),
                'Key' => $s3FilePath,
                'SourceFile' => $fileObject->getRealPath(),
            ]);

            // Return the relative path
            return $s3FilePath;


        }

        return null;
    }



}

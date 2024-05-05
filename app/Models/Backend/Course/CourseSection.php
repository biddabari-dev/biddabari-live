<?php

namespace App\Models\Backend\Course;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseSection extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'course_id',
        'title',
        'available_at',
        'note',
        'is_paid',
        'status',
        'order',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'course_sections';

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::deleting(function ($courseSection){
            if (!empty($courseSection->courseSectionContents))
            {
                $courseSection->courseSectionContents->each->delete();
            }
        });
    }

    protected static $courseSection;

    public static function createOrUpdateCourseSection ($request, $id = null)
    {
        $lastRecord = CourseSection::where('course_id', $request->course_id)->latest()->first();
        if (isset($id))
        {
            self::$courseSection = CourseSection::find($id);
        } else {
            self::$courseSection = new CourseSection();
        }
        self::$courseSection->course_id = $request->course_id;
        self::$courseSection->title = $request->title;
        self::$courseSection->available_at = $request->available_at;
        self::$courseSection->note = $request->note;
        self::$courseSection->is_paid = $request->is_paid == 'on' ? 1 : 0;
        self::$courseSection->status = $request->status == 'on' ? 1 : 0;
        self::$courseSection->order = isset($id) ? static::find($id)->order : (isset($lastRecord) ? $lastRecord->order+1 : 1);
        self::$courseSection->save();
    }

    public static function importCourseSections($course_sections, $courseId)
    {
        foreach ($course_sections as $course_section)
        {
            $courseSection = new CourseSection();
            $courseSection->course_id       = $courseId;
            $courseSection->title           = $course_section->title;
            $courseSection->available_at    = $course_section->available_at;
            $courseSection->note            = $course_section->note;
            $courseSection->is_paid         = $course_section->is_paid;
            $courseSection->status          = $course_section->status;
            $courseSection->order          = $course_section->order;
            $courseSection->save();
            if (isset($course_section->course_section_contents) && !empty($course_section->course_section_contents) && count($course_section->course_section_contents) > 0)
            {
                CourseSectionContent::importCourseSectionContents($course_section->course_section_contents, $courseSection->id);
            }
        }
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseSectionContents()
    {
        return $this->hasMany(CourseSectionContent::class)->orderBy('order', 'ASC');
    }
    public function courseSectionContentsWithCustomColumns()
    {
        return $this->hasMany(CourseSectionContent::class)->orderBy('order', 'ASC')->select('id', 'title', 'content_type', 'has_class_xm', 'video_vendor', 'video_link', 'available_at_timestamp');
    }
    public function courseSectionContentsManagePage()
    {
        return $this->hasMany(CourseSectionContent::class)->select('id', 'course_section_id', 'parent_id', 'content_type', 'title', 'pdf_link', 'pdf_file', 'video_vendor', 'video_link', 'has_class_xm', 'course_section_content_id', 'status')->orderBy('order', 'ASC');
    }
    public function courseSectionContentsByAsc()
    {
        return $this->hasMany(CourseSectionContent::class)->orderBy('id', 'ASC');
    }
}

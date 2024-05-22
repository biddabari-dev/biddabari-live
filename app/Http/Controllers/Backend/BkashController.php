<?php

namespace App\Http\Controllers\Backend;

use App\helper\BkashPayment;
use App\helper\ViewHelper;
use App\Http\Controllers\Controller;
use App\Models\Backend\AdditionalFeatureManagement\Affiliation\AffiliationHistory;
use App\Models\Backend\BatchExamManagement\BatchExam;
use App\Models\Backend\Course\Course;
use App\Models\Backend\OrderManagement\ParentOrder;
use App\Models\Backend\UserManagement\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BkashController extends Controller
{

    public function createPayment(Request $request){
//        $requestData = (object) \session()->get('requestData');
//        return $requestData;
//        return $requestData;
        $bkashobj=new BkashPayment();
//return 'sarowar';
        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
//        $request['amount'] =  round(Crypt::decrypt($request->total_amount), 2);
        $request['amount'] = $request->total_amount;
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config('bkashpay.callbackURL');
//        return $request['callbackURL'];
        $request_data_json = json_encode($request->all());
//        return $request_data_json;

        $response=$bkashobj->requestPayment($request_data_json);
//        return $response;              // Output data submit bkash website for original creditionals
        if (isset($response['bkashURL'])){
            return redirect()->away($response['bkashURL']);
        }else{
            return redirect()->back()->with('error',$response['statusMessage']);
        }
    }

    public function callBack(Request $request){
//        return 'sarowar';
//        $requestData = (object) session()->get('requestData');
//        return $requestData;
        $execute=new BkashPayment();
//return $request;
        if ($request->status == 'success'){
            $response= $execute->executePayment($request['paymentID']);
            if (!isset($response)){
                $response=$execute->queryPayment($request['paymentID']);
            }
//            return $response; // Output data submit bkash website for original creditionals
//            $requestData = (object) \session()->get('requestData');
//            return $requestData;
            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed"){
                    $requestData = (object) \session()->get('requestData');
//                    return $requestData;
                    if ($requestData->ordered_for == 'product')
                    {
                        ParentOrder::orderProductThroughSSL($requestData, $request);
                    } else {
                        ParentOrder::placeOrderAfterGatewayPayment($request, $requestData);
                        if ($requestData->ordered_for == 'course')
                        {
//                            return 'sarowar';
                            Course::find($requestData->model_id)->students()->attach(Student::whereUserId(ViewHelper::loggedUser()->id)->first()->id);
                        } elseif ($requestData->ordered_for == 'batch_exam')
                        {
                            BatchExam::find($requestData->model_id)->students()->attach(Student::whereUserId(ViewHelper::loggedUser()->id)->first()->id);
                        }
                        //  Do the rest database saving works
                        //  take a look at dd($request->all()) to see what you need
                        if (isset($requestData->rc))
                        {
                            AffiliationHistory::createNewHistory($requestData, $requestData->model_name, $requestData->model_id, $requestData->affiliate_amount, 'insert');
                        }
                    }

//                    if (str()->contains(url()->current(), '/api/'))
//                    {
//                        return response()->json(['message' => 'You Ordered the course successfully.'], 200);
//                    }
                    return redirect()->route('front.student.dashboard')->with('success', 'You Ordered the '.$requestData->model_name.' successfully.');

            }else{
                return redirect()->back();
//                notify()->error($response['statusMessage']);
//                $failedTranscations = new FailedTranscations();
//                $failedTranscations->txn_id = 'Bkash' . Str::uuid();
//                $failedTranscations->user_id = auth()->id();
//                $failedTranscations->save();
//                return redirect(route('order.review'));
            }
        }else{
//            return 'sarowar bk';
            notify()->error($request->status);
            return redirect()->back();
        }
    }


    public function bkashSearch($trxID)
    {
        $bkash=new BkashPayment();
        $findpayment= $bkash->searchPayment($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
        return $findpayment;
    }
}

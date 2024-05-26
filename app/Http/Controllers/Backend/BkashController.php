<?php

namespace App\Http\Controllers\Backend;

use App\helper\BkashPayment;
use App\helper\ViewHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Checkout\CheckoutController;
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
        $bkashobj=new BkashPayment();
        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
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

        $execute=new BkashPayment();

        if ($request->status == 'success'){
            $response= $execute->executePayment($request['paymentID']);
            if (!isset($response)){
                $response=$execute->queryPayment($request['paymentID']);
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed"){
                    $requestData = (object) \session()->get('requestData');

                //                user create or old
                $request['trxID']   = $response->trxID;
                return CheckoutController::createOrderAndAssignStudent($requestData, $request);

//                    if (str()->contains(url()->current(), '/api/'))
//                    {
//                        return response()->json(['message' => 'You Ordered the course successfully.'], 200);
//                    }
//                    return redirect()->route('front.student.dashboard')->with('success', 'You Ordered the '.$requestData->model_name.' successfully.');

            }else{
                return redirect()->back()->with('error', 'Something went wrong during payment. Please try again.');;
            }
        }else{
            return redirect()->back()->with('error', 'Something went wrong during payment. Please try again.');
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

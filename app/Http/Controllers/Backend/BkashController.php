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
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

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
        $request_data_json = json_encode($request->all());

        $response=$bkashobj->requestPayment($request_data_json);
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

                $request['trxID']   = $response['trxID'];
                $request['tran_id']   = $response['paymentID'];
                $request['amount']   = $response['amount'];
                if (!empty($requestData))
                {
                    $userCreateAuth = CheckoutController::createUserAfterOrder($requestData);
                    if ($userCreateAuth['processStatus'] == 'success')
                    {
                        $studentId =  Student::whereUserId(ViewHelper::loggedUser()->id)->first()->id;
                        if ($requestData->ordered_for == 'product')
                        {
                            ParentOrder::orderProductThroughSSL($requestData, $request);
                        } else {
                            ParentOrder::placeOrderAfterGatewayPayment($request, $requestData);
                            if ($requestData->ordered_for == 'course')
                            {
                                Course::find($requestData->model_id)->students()->attach($studentId);
                            } elseif ($requestData->ordered_for == 'batch_exam')
                            {
                                BatchExam::find($requestData->model_id)->students()->attach($studentId);
                            }
                            if (isset($requestData->rc))
                            {
                                AffiliationHistory::createNewHistory($requestData, $requestData->model_name, $requestData->model_id, $requestData->affiliate_amount, 'insert');
                            }
                        }

                        if (!$userCreateAuth['userStatus'])
                        {
                            return redirect()->back()->with('error', 'We got your payment but we faced problem during creating your account in our system. Please try again.');
                        }
                        if ($userCreateAuth['message']) {
                            try {
                                $client = new Client();
                                // URL encode the message
                                $message = $userCreateAuth['message'];

                                // Send the request
                                $response = $client->request('GET', 'https://msg.elitbuzz-bd.com/smsapi', [
                                    'query' => [
                                        'api_key'   => 'C2008649660d0a04f3d0e9.72990969',
                                        'type'      => 'text',
                                        'contacts'  => $requestData->mobile,
                                        'senderid'  => '8809601011181',
                                        'msg'       => $message,
                                    ]
                                ]);

                                // Check the response
                                $body = $response->getBody()->getContents();

                                // Handle response if it's in expected format, otherwise log an error
                                if (strpos($body, ':') !== false) {
                                    $responseCode = explode(':', $body)[1];
                                } else {
                                    // Log unexpected response for debugging
                                    Log::error('Unexpected response format: ' . $body);
                                    $responseCode = null;
                                }
                            } catch (\Exception $e) {
                                // Handle errors (e.g., network issues)
                                Log::error('SMS API request failed: ' . $e->getMessage());
                                $responseCode = null;
                            }
                            return redirect()->route('front.thankyou')->with('success', 'You Ordered the '.$requestData->model_name.' successfully.');
                        }

                        if ($userCreateAuth['message'] == 'failed')
                        {
                            return redirect()->route('front.thankyou')->with('error', 'Your successfully enrolled in the course but something went wrong during sending sms to your number. Please Contact with our support.');
                        }


                        if (str()->contains(url()->current(), '/api/'))
                        {
                            return response()->json(['message' => 'You Ordered the course successfully.'], 200);
                        }
                        return redirect()->route('front.thankyou')->with('success', 'You Ordered the '.$requestData->model_name.' successfully.');
                    } elseif ($userCreateAuth['processStatus'] == 'failed')
                    {
                        return redirect()->back()->with('error', 'Something went wrong during payment. Please try again.');
                    }



                } else {
                    return 'Data is missing from session';
                }

            }else{

                return redirect()->back()->with('error', 'Something went wrong during payment. Please try again.');
            }
        }else{
            return redirect()->back()->with('error', 'Something went wrong during payment. Please try again 34.');
        }
    }


    public function bkashSearch($trxID)
    {
        $bkash=new BkashPayment();
        $findpayment= $bkash->searchPayment($trxID);
        return $findpayment;
    }
}

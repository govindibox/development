<?php

namespace App\Http\Controllers;

use App\Mail\PaymentMail;
use App\Models\User;
use App\Models\UserPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function new(){
        $user_id= Auth::user()->id;         
        $profile_details=User::with(['profile','role'])->whereKey($user_id)->first();        
        return view('payment.new',['profile'=> $profile_details]);    
    }

    public function payu(Request $request){
        $validated = $request->validate([
            'amount' => "required|numeric|min:0|not_in:0"
        ]);

        $user_id= Auth::user()->id;         
        $profile_details=User::with(['profile','role'])->whereKey($user_id)->first();

        $merchant_key = "gtKFFx";
        $salt = "wia56q6O";
        $payu_base_url = "https://test.payu.in";   
        $service_provider='payu_paisa';    
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

        $user_pay_data = array(            
            'txnid' => $txnid,
            'amount' => $validated['amount'],
            'productinfo' => 'Term Fees',
            'firstname' => $profile_details->profile->first_name,
            'lastname' => $profile_details->profile->last_name,
            'email' => $profile_details->email,
            'phone'=> $profile_details->profile->mobile,
        );

        $user_pay_db_data=json_encode($user_pay_data);

        UserPayment::create(array('user_id'=>$user_id,'transaction_id'=>$txnid,'amount'=>$validated['amount'],'pay_request'=>$user_pay_db_data,'status'=>'Initiated'));

        $payu_data = array(
            'key' => $merchant_key,            
            'surl' => route('payment.success'),
            'furl' => route('payment.failure'),
            'service_provider' => $service_provider
        );

        $payment_data = array_merge($payu_data, $user_pay_data);

        $hash = '';
        $action_url = '';
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        if(empty($payment_data['hash']) && sizeof($payment_data) > 0){
            $hashVarsSeq = explode('|', $hashSequence);
            $hash_string = '';
            foreach($hashVarsSeq as $hash_var){
                $hash_string .= isset($payment_data[$hash_var]) ? $payment_data[$hash_var] : '';
                $hash_string .= '|';
            }
            $hash_string .= $salt;
            $hash = strtolower(hash('sha512', $hash_string));	    
            $action_url = $payu_base_url . '/_payment';
        } 

        $payment_data['action_url']=$action_url;
        $payment_data['hash']=$hash;
        $payment_data['merchant_key']=$merchant_key;

        return view('payment.payu',['payment_data'=>$payment_data]);
    }

    public function success(Request $request){        
        $payu_response=$request->all();
        $payu_transaction_id=$payu_response['txnid'];
        $payu_status=$payu_response['status'];
        $user_id= Auth::user()->id;
        $payu_response_data=json_encode($request->all());       
        $update_payu_response=array('user_id'=>$user_id,'pay_response'=>$payu_response_data,'status'=>$payu_status);
        UserPayment::where(["user_id"=>$user_id, "transaction_id"=>$payu_transaction_id])->update($update_payu_response);

        $profile_details=User::with([
            'profile',
            'role',
            'transaction'=>function ($query)use($payu_transaction_id){
                $query->where('transaction_id',$payu_transaction_id);
            }
        ])->whereKey($user_id)->first();   
        Mail::to($profile_details->email)->send(
            new PaymentMail($profile_details)
        );
        return view('payment.success');
    }

    public function failure(Request $request){
        $payu_response=$request->all();
        $payu_transaction_id=$payu_response['txnid'];
        $payu_status=$payu_response['status'];
        $user_id= Auth::user()->id;
        $payu_response_data=json_encode($request->all());       
        $update_payu_response=array('user_id'=>$user_id,'pay_response'=>$payu_response_data,'status'=>$payu_status);
        UserPayment::where(["user_id"=>$user_id, "transaction_id"=>$payu_transaction_id])->update($update_payu_response);
        return view('payment.failure');
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Helper\Api\PopsendApi;
use App\Http\Helper\ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller{
    protected $request;
    protected $accessToken;
    protected $accessIp;
    protected $sessionId;

    public function __construct(Request $request){
        $this->request     = $request;
        $this->accessToken  = $request->header('Authorization');
        $this->sessionId = $request->header('AuthSession');
        $this->accessIp    = $request->ip();
    }

    public function listOrderUserSession(){
        // REVIEW Validation Laravel
            $rules = [
                'page'       => 'nullable',
                'status'     => 'nullable',
                'isComplete' => 'nullable|in:true,false',
            ];

            $validator = Validator::make($this->request->query(),$rules);
            if ($validator->fails()){
                $errors = $validator->errors()->all();
                return ApiHelper::buildErrRes(false,412,implode(' ',$errors),$errors);
            }

        // REVIEW Hit Api Login
            $resLogin = PopsendApi::orderSessionUser((object)array(
                'token'       => $this->accessToken,
                'session_id'  => $this->sessionId,
                'page'        => $this->request->query('page') ? ((int) $this->request->query('page') > 0 ? (int) $this->request->query('page') : 1 ) : 1,
                'status'      => $this->request->query('status'),
                'is_complete' => $this->request->query('isComplete') ? filter_var($this->request->query('isComplete'), FILTER_VALIDATE_BOOLEAN) : null,
            ));

            if(!$resLogin->status){
                return ApiHelper::buildErrRes(false, $resLogin->code, $resLogin->message, $resLogin->errors);
            }

        // REVIEW Set Result
            $tempFinalRes = $resLogin->data;
            return ApiHelper::buildRes(true, 200, 'Order User Founded', $tempFinalRes);

    }

    public function listOrderDetailUserSession(){
        // REVIEW Validation Laravel
            $rules = [
                'orderId' => 'required|string'
            ];

            $validator = Validator::make($this->request->query(),$rules);
            if ($validator->fails()){
                $errors = $validator->errors()->all();
                return ApiHelper::buildErrRes(false,412,implode(' ',$errors),$errors);
            }

        // REVIEW Hit Api Login
            $resLogin = PopsendApi::orderDetailSessionUser((object)array(
                'token'      => $this->accessToken,
                'session_id' => $this->sessionId,
                'order_id'   => $this->request->query('orderId'),
            ));

            if(!$resLogin->status){
                return ApiHelper::buildErrRes(false, $resLogin->code, $resLogin->message, $resLogin->errors);
            }

        // REVIEW Set Result
            $tempFinalRes = $resLogin->data[0];
            return ApiHelper::buildRes(true, 200, 'Order Detail User Founded', $tempFinalRes);

    }

}

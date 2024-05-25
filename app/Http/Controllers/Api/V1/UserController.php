<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Helper\Api\PopsendApi;
use App\Http\Helper\ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller{
    protected $request;
    protected $accessToken;
    protected $accessIp;

    public function __construct(Request $request){
        $this->request     = $request;
        $this->accessToken = $request->header('Authorization');
        $this->accessIp    = $request->ip();
    }

    public function login(){
        // REVIEW Validation Laravel
            $rules = [
                'phoneNumber' => 'required|numeric|digits_between:8,14',
                'pin'         => 'required|numeric|digits:6',
                'deviceType'  => 'required|in:android,ios',
                'deviceId'    => 'required',
                'deviceName'  => 'required'
            ];

            $validator = Validator::make($this->request->input(),$rules);
            if ($validator->fails()){
                $errors = $validator->errors()->all();
                return ApiHelper::buildErrRes(false,412,implode(' ',$errors),$errors);
            }

        // REVIEW Hit Api Login
            $resLogin = PopsendApi::login((object)array(
                'token'        => $this->accessToken,
                'phone_number' => $this->request->input('phoneNumber'),
                'pin'          => $this->request->input('pin'),
                'device_type'  => $this->request->input('deviceType'),
                'device_id'    => $this->request->input('deviceId'),
                'device_name'  => $this->request->input('deviceName')
            ));

            if(!$resLogin->status){
                return ApiHelper::buildErrRes(false, $resLogin->code, $resLogin->message, $resLogin->errors);
            }

        // REVIEW Set Result
            $tempFinalRes = $resLogin->data[0];
            return ApiHelper::buildRes(true, 200, 'User Login Authorized', $tempFinalRes);

    }

    public function userMe(){
        // REVIEW Validation Laravel
            $rules = [
                'phoneNumber' => 'required|numeric|digits_between:8,14',
            ];

            $validator = Validator::make($this->request->query(),$rules);
            if ($validator->fails()){
                $errors = $validator->errors()->all();
                return ApiHelper::buildErrRes(false,412,implode(' ',$errors),$errors);
            }

        // REVIEW Hit Api Login
            $resLogin = PopsendApi::userCheck((object)array(
                'token'        => $this->accessToken,
                'phone' => $this->request->query('phoneNumber'),
            ));

            if(!$resLogin->status){
                return ApiHelper::buildErrRes(false, $resLogin->code, $resLogin->message, $resLogin->errors);
            }

        // REVIEW Set Result
            $tempFinalRes = $resLogin->data[0];
            return ApiHelper::buildRes(true, 200, 'User Founded', $tempFinalRes);

    }

}

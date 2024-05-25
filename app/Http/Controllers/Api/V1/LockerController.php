<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Helper\Api\PopsendApi;
use App\Http\Helper\ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LockerController extends Controller{
    protected $request;
    protected $accessToken;
    protected $accessIp;
    
    public function __construct(Request $request){
        $this->request     = $request;
        $this->accessToken = $request->header('Authorization');
        $this->accessIp    = $request->ip();
    }

    public function listLockerLocation(){
        // REVIEW Validation Laravel
            $rules = [
                'country'      => 'nullable',
                'province'     => 'nullable',
                'city'         => 'nullable',
                'buildingType' => 'nullable|min:4',
                'latitude'     => 'nullable|numeric',
                'longitude'    => 'nullable|numeric'
            ];

            $validator = Validator::make($this->request->query(),$rules);
            if ($validator->fails()){
                $errors = $validator->errors()->all();
                return ApiHelper::buildErrRes(false,412,implode(' ',$errors),$errors);
            }

        // REVIEW Hit Api Login
            $resLogin = PopsendApi::lockers((object)array(
                'token'         => $this->accessToken,
                'country_name'  => $this->request->query('country'),
                'province_name' => $this->request->query('province'),
                'city_name'     => $this->request->query('city'),
                'building_type' => $this->request->query('buildingType'),
                'latitude'      => $this->request->query('latitude'),
                'longitude'     => $this->request->query('longitude')
            ));

            if(!$resLogin->status){
                return ApiHelper::buildErrRes(false, $resLogin->code, $resLogin->message, $resLogin->errors);
            }

        // REVIEW Set Result
            $tempFinalRes = $resLogin->data;
            return ApiHelper::buildRes(true, 200, 'Locker Founded', $tempFinalRes);

    }

}

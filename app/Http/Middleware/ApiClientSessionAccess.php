<?php

namespace App\Http\Middleware;

use App\Http\Helper\Api\PopsendApi;
use App\Http\Helper\ApiHelper;
use Closure;
use Illuminate\Http\Request;

class ApiClientSessionAccess{

    public function handle(Request $request, Closure $next){
        try {
            // REVIEW Cek Token Header Valid or Invalid
                if(!$request->hasHeader('AuthSession')){
                    return ApiHelper::buildErrRes(false,406,'Invalid Session');
                }

            // REVIEW Exception Method GET
            if($request->method() === "GET"){
                return $next($request);
            }

            // REVIEW Set Allowed Array Content-Type
                $collectAllowedContentType = array(
                    'application/json'
                );

                if(!in_array($request->header('Content-Type'),$collectAllowedContentType)){
                    return ApiHelper::buildErrRes(false,406,'Invalid Content-Type');
                }

        } catch (\Exception $e) {
            return ApiHelper::buildErrRes(false,500,$e->getMessage());
        }

        return $next($request);
    }
}

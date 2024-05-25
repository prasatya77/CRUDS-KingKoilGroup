<?php
namespace App\Http\Helper\Api;

use App\Http\Helper\ApiHelper;

class PopsendApi{

    private static function mainCurl($request, $param = [], $method='POST'){
        $host            = env('POPSEND_URL');
        $url             = $host.$request;
        $payload         = json_encode($param);

        $headers = [
            'Content-Type:application/json',
        ];

        // create curl resource
		$ch = curl_init();

		// set url
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, $method );
        if($payload != null) {
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        }
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_COOKIEJAR, "" );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false ); // required for https urls
		curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );

		if(is_array($headers) && !empty($headers)) {
			curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		}

		// $output contains the output string
		$output = curl_exec($ch);

		curl_close($ch);

        return $output;
    }

    public static function checkAuthorizedIp($params){
        $url       = 'v2/clientApi/config/whitelistIp';
        $result    = self::mainCurl($url, $params, 'POST');
        $result    = $result;
        $parseJson = json_decode($result);
        if(is_object($parseJson)){
            if(isset($parseJson->response)){
                if(isset($parseJson->response->code)){
                    if((int) $parseJson->response->code == 200){
                        return ApiHelper::buildFuncRes(
                            true,
                            (int) $parseJson->response->code,
                            isset($parseJson->response->message) ? $parseJson->response->message : null,
                            isset($parseJson->data) ? $parseJson->data : null
                        );
                    }else{
                        return ApiHelper::buildFuncRes(
                            false,
                            (int) $parseJson->response->code,
                            isset($parseJson->response->message) ? $parseJson->response->message : null,
                            null,
                            isset($parseJson->data) ? $parseJson->data : null
                        );
                    }
                }

                return ApiHelper::buildFuncRes(
                    false,
                    500,
                    isset($parseJson->response->message) ? $parseJson->response->message : null,
                    null,
                    isset($parseJson->data) ? $parseJson->data : null
                );

            }
        }

        return ApiHelper::buildFuncRes(
            false,
            500,
            'Something Wrong Authorized IP',
            null,
            $parseJson
        );
    }

    public static function login($params){
        $url       = 'v2/user/login';
        $result    = self::mainCurl($url, $params, 'POST');
        $result    = $result;
        $parseJson = json_decode($result);
        if(is_object($parseJson)){
            if(isset($parseJson->response)){
                if(isset($parseJson->response->code)){
                    if((int) $parseJson->response->code == 200){
                        return ApiHelper::buildFuncRes(
                            true,
                            (int) $parseJson->response->code,
                            isset($parseJson->response->message) ? $parseJson->response->message : null,
                            isset($parseJson->data) ? $parseJson->data : null
                        );
                    }else{
                        return ApiHelper::buildFuncRes(
                            false,
                            (int) $parseJson->response->code,
                            isset($parseJson->response->message) ? $parseJson->response->message : null,
                            null,
                            isset($parseJson->data) ? $parseJson->data : null
                        );
                    }
                }

                return ApiHelper::buildFuncRes(
                    false,
                    500,
                    isset($parseJson->response->message) ? $parseJson->response->message : null,
                    null,
                    isset($parseJson->data) ? $parseJson->data : null
                );

            }
        }

        return ApiHelper::buildFuncRes(
            false,
            500,
            'Something Wrong Login',
            null,
            $parseJson
        );
    }

    public static function userCheck($params){
        $url       = 'v2/user/check';
        $result    = self::mainCurl($url, $params, 'POST');
        $result    = $result;
        $parseJson = json_decode($result);
        if(is_object($parseJson)){
            if(isset($parseJson->response)){
                if(isset($parseJson->response->code)){
                    if((int) $parseJson->response->code == 200){
                        return ApiHelper::buildFuncRes(
                            true,
                            (int) $parseJson->response->code,
                            isset($parseJson->response->message) ? $parseJson->response->message : null,
                            isset($parseJson->data) ? $parseJson->data : null
                        );
                    }else{
                        return ApiHelper::buildFuncRes(
                            false,
                            (int) $parseJson->response->code,
                            isset($parseJson->response->message) ? $parseJson->response->message : null,
                            null,
                            isset($parseJson->data) ? $parseJson->data : null
                        );
                    }
                }

                return ApiHelper::buildFuncRes(
                    false,
                    500,
                    isset($parseJson->response->message) ? $parseJson->response->message : null,
                    null,
                    isset($parseJson->data) ? $parseJson->data : null
                );

            }
        }

        return ApiHelper::buildFuncRes(
            false,
            500,
            'Something Wrong Login',
            null,
            $parseJson
        );
    }

    public static function lockers($params){
        $url       = 'v2/lockers';
        $result    = self::mainCurl($url, $params, 'POST');
        $result    = $result;
        $parseJson = json_decode($result);
        if(is_object($parseJson)){
            if(isset($parseJson->response)){
                if(isset($parseJson->response->code)){
                    if((int) $parseJson->response->code == 200){
                        return ApiHelper::buildFuncRes(
                            true,
                            (int) $parseJson->response->code,
                            isset($parseJson->response->message) ? $parseJson->response->message : null,
                            isset($parseJson->data) ? $parseJson->data : null
                        );
                    }else{
                        return ApiHelper::buildFuncRes(
                            false,
                            (int) $parseJson->response->code,
                            isset($parseJson->response->message) ? $parseJson->response->message : null,
                            null,
                            isset($parseJson->data) ? $parseJson->data : null
                        );
                    }
                }

                return ApiHelper::buildFuncRes(
                    false,
                    500,
                    isset($parseJson->response->message) ? $parseJson->response->message : null,
                    null,
                    isset($parseJson->data) ? $parseJson->data : null
                );

            }
        }

        return ApiHelper::buildFuncRes(
            false,
            500,
            'Something Wrong Login',
            null,
            $parseJson
        );
    }

    public static function orderSessionUser($params){
        $url       = 'v2/user/orderHistory';
        $result    = self::mainCurl($url, $params, 'POST');
        $result    = $result;
        $parseJson = json_decode($result);
        if(is_object($parseJson)){
            if(isset($parseJson->response)){
                if(isset($parseJson->response->code)){
                    if((int) $parseJson->response->code == 200){

                        $tempFinal =  isset($parseJson->data) ? $parseJson->data : null;
                        if(!empty($tempFinal)){
                            $tempFinal = (object)array(
                                'pagination' => (object)array(
                                    'totalPage'   => isset($parseJson->totalpage) ? $parseJson->totalpage : 0,
                                    'currentPage' => isset($params->page) ? $params->page : 0,
                                    'totalData'   => isset($parseJson->totaldata) ? $parseJson->totaldata : 0,
                                ),
                                'collectData' => $tempFinal
                            );
                        }

                        if(empty($tempFinal)){
                            return ApiHelper::buildFuncRes(
                                false,
                                404,
                                'Order User Not Found',
                                null,
                                null
                            );
                        }

                        return ApiHelper::buildFuncRes(
                            true,
                            (int) $parseJson->response->code,
                            isset($parseJson->response->message) ? $parseJson->response->message : null,
                            $tempFinal
                        );
                    }else{

                        $tempFinal =  isset($parseJson->data) ? $parseJson->data : null;
                        if(!empty($tempFinal)){
                            $tempFinal = (object)array(
                                'pagination' => (object)array(
                                    'totalPage'   => isset($parseJson->totalpage) ? $parseJson->totalpage : 0,
                                    'currentPage' => isset($params->page) ? $params->page : 0,
                                    'totalData'   => isset($parseJson->totaldata) ? $parseJson->totaldata : 0,
                                ),
                                'collectData' => $tempFinal
                            );
                        }

                        return ApiHelper::buildFuncRes(
                            false,
                            (int) $parseJson->response->code,
                            isset($parseJson->response->message) ? $parseJson->response->message : null,
                            null,
                            isset($parseJson->data) ? $parseJson->data : null
                        );
                    }
                }

                return ApiHelper::buildFuncRes(
                    false,
                    500,
                    isset($parseJson->response->message) ? $parseJson->response->message : null,
                    null,
                    isset($parseJson->data) ? $parseJson->data : null
                );

            }
        }

        return ApiHelper::buildFuncRes(
            false,
            500,
            'Something Wrong Login',
            null,
            $parseJson
        );
    }

    public static function orderDetailSessionUser($params){
        $url       = 'v2/user/orderHistoryDetail';
        $result    = self::mainCurl($url, $params, 'POST');
        $result    = $result;
        $parseJson = json_decode($result);
        if(is_object($parseJson)){
            if(isset($parseJson->response)){
                if(isset($parseJson->response->code)){
                    if((int) $parseJson->response->code == 200){

                        $tempFinal =  isset($parseJson->data) ? $parseJson->data : null;
                        if(empty($tempFinal)){
                            return ApiHelper::buildFuncRes(
                                false,
                                404,
                                'Order Detail User Not Found',
                                null,
                                null
                            );
                        }

                        return ApiHelper::buildFuncRes(
                            true,
                            (int) $parseJson->response->code,
                            isset($parseJson->response->message) ? $parseJson->response->message : null,
                            $tempFinal
                        );
                    }else{

                        $tempFinal =  isset($parseJson->data) ? $parseJson->data : null;
                        return ApiHelper::buildFuncRes(
                            false,
                            (int) $parseJson->response->code,
                            isset($parseJson->response->message) ? $parseJson->response->message : null,
                            null,
                            isset($parseJson->data) ? $parseJson->data : null
                        );
                    }
                }

                return ApiHelper::buildFuncRes(
                    false,
                    500,
                    isset($parseJson->response->message) ? $parseJson->response->message : null,
                    null,
                    isset($parseJson->data) ? $parseJson->data : null
                );

            }
        }

        return ApiHelper::buildFuncRes(
            false,
            500,
            'Something Wrong Login',
            null,
            $parseJson
        );
    }

}

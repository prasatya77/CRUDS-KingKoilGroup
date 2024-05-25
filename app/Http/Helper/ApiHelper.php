<?php
namespace App\Http\Helper;

class ApiHelper
{
    public static function buildRes($status=false, $code=500, $message='Failed Response', $data=array(), $errors=null){
        $dataFinal = null;
        if(is_array($data)){
            if(count($data) > 0){
                $dataFinal = $data;
            }else{
                $dataFinal = [];
            }
        }else if(is_object($data)){
            $dataFinal = $data;
        }else if(!empty($data)){
            $dataFinal = $data;
        }else{
            $dataFinal = null;
        }

        $res = (object)array(
            'code'    => $code,
            'status'  => $status,
            'message' => $message,
            'errors'  => $errors,
            'data'    => $dataFinal,

        );

        return response()->json($res,$code);
    }

    public static function buildErrRes($status=false, $code=500, $message='Failed Response', $errors=null, $data=array() ){
        $dataFinal = null;
        if(is_array($data)){
            if(count($data) > 0){
                $dataFinal = $data;
            }else{
                $dataFinal = [];
            }
        }else if(is_object($data)){
            $dataFinal = $data;
        }else if(!empty($data)){
            $dataFinal = $data;
        }else{
            $dataFinal = null;
        }

        $res = (object)array(
            'code'    => $code,
            'status'  => $status,
            'message' => $message,
            'errors'  => $errors,
            'data'    => $dataFinal,
        );

        return response()->json($res,$code);
    }

    public static function buildFuncRes($status=false, $code=500, $message='Failed Response', $data=array(), $errors=null ){
        $dataFinal = null;
        if(is_array($data)){
            if(count($data) > 0){
                $dataFinal = $data;
            }else{
                $dataFinal = [];
            }
        }else if(is_object($data)){
            $dataFinal = $data;
        }else if(!empty($data)){
            $dataFinal = $data;
        }else{
            $dataFinal = null;
        }

        $res = (object)array(
            'code'    => $code,
            'status'  => $status,
            'message' => $message,
            'errors'  => $errors,
            'data'    => $dataFinal,

        );

        return $res;
    }
}

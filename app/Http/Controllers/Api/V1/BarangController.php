<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Helper\Api\PopsendApi;
use App\Http\Helper\ApiHelper;
use App\Models\TblBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller{

    protected $request;
    protected $accessToken;
    protected $accessIp;

    public function __construct(Request $request){
        $this->request     = $request;
        $this->accessToken = $request->header('Authorization');
        $this->accessIp    = $request->ip();
    }

    public function create(){
          // REVIEW Validation Laravel
            $rules = [
                'namaBarang'  => 'required',
                'hargaBarang' => 'required|numeric',
            ];

            $validator = Validator::make($this->request->input(),$rules);
            if ($validator->fails()){
                $errors = $validator->errors()->all();
                return ApiHelper::buildErrRes(false,412,implode(' ',$errors),$errors);
            }

            $paramInsert = array(
                'nama_barang'  => $this->request->input('namaBarang'),
                'harga_barang' => $this->request->input('hargaBarang')
            );

          // REVIEW Call Model
            $resModel = TblBarang::createModel($paramInsert);

            if(!$resModel->status){
                return ApiHelper::buildErrRes(false, $resModel->code, $resModel->message, $resModel->errors);
            }

          // REVIEW Set Result
            $tempFinalRes = $resModel->data[0];
            return ApiHelper::buildRes(true, 200, 'Insert Barang Success', $tempFinalRes);

    }

    public function read(){
        // REVIEW Validation Laravel
          $rules = [
              'idBarang' => 'required|numeric',
          ];

          $validator = Validator::make($this->request->input(),$rules);
          if ($validator->fails()){
              $errors = $validator->errors()->all();
              return ApiHelper::buildErrRes(false,412,implode(' ',$errors),$errors);
          }

        // REVIEW Call Model
          $resModel = TblBarang::readModel($this->request->input('idBarang'));

          if(!$resModel->status){
              return ApiHelper::buildErrRes(false, $resModel->code, $resModel->message, $resModel->errors);
          }

        // REVIEW Set Result
          $tempFinalRes = $resModel->data[0];
          return ApiHelper::buildRes(true, 200, 'Data Barang Found', $tempFinalRes);

    }

    public function update(){
        // REVIEW Validation Laravel
          $rules = [
              'idBarang'    => 'required|numeric',
              'namaBarang'  => 'required',
              'hargaBarang' => 'required|numeric',
          ];

          $validator = Validator::make($this->request->input(),$rules);
          if ($validator->fails()){
              $errors = $validator->errors()->all();
              return ApiHelper::buildErrRes(false,412,implode(' ',$errors),$errors);
          }

        // REVIEW Call Model Read
          $resModelRead = TblBarang::readModel($this->request->input('idBarang'));

          if(!$resModelRead->status){
              return ApiHelper::buildErrRes(false, $resModelRead->code, $resModelRead->message, $resModelRead->errors);
          }

        $paramUpdate = array(
            'nama_barang'  => $this->request->input('namaBarang'),
            'harga_barang' => $this->request->input('hargaBarang')
        );

        // REVIEW Call Model Update
            $resUpdateModel = TblBarang::updateModel($paramUpdate, $this->request->input('idBarang'));

            if(!$resUpdateModel->status){
                return ApiHelper::buildErrRes(false, $resUpdateModel->code, $resUpdateModel->message, $resUpdateModel->errors);
            }

        // REVIEW Set Result
          $tempFinalRes = $resUpdateModel->data[0];
          return ApiHelper::buildRes(true, 200, 'Data Barang Found', $tempFinalRes);

    }

    public function softDelete(){
        // REVIEW Validation Laravel
          $rules = [
              'idBarang'    => 'required|numeric',
          ];

          $validator = Validator::make($this->request->input(),$rules);
          if ($validator->fails()){
              $errors = $validator->errors()->all();
              return ApiHelper::buildErrRes(false,412,implode(' ',$errors),$errors);
          }

        // REVIEW Call Model Read
          $resModelRead = TblBarang::readModel($this->request->input('idBarang'));

          if(!$resModelRead->status){
              return ApiHelper::buildErrRes(false, $resModelRead->code, $resModelRead->message, $resModelRead->errors);
          }

        // REVIEW Call Model Update
            $resDeleteModel = TblBarang::deleteModel($this->request->input('idBarang'));

            if(!$resDeleteModel->status){
                return ApiHelper::buildErrRes(false, $resDeleteModel->code, $resDeleteModel->message, $resDeleteModel->errors);
            }

        // REVIEW Set Result
          return ApiHelper::buildRes(true, 200, 'Data Barang Delete Success');

    }

    public function search(){
        // REVIEW Validation Laravel
          $rules = [
              'searchIdBarang'    => 'nullable|numeric',
              'searchBarangName'  => 'nullable|string',
              'searchBarangPrice' => 'nullable|numeric',
              'typePrice'         => 'nullable|in:GREATER,EQUAL,LESS',
          ];

          $validator = Validator::make($this->request->input(),$rules);
          if ($validator->fails()){
              $errors = $validator->errors()->all();
              return ApiHelper::buildErrRes(false,412,implode(' ',$errors),$errors);
          }

          if($this->request->input('searchBarangPrice')){
            if(empty($this->request->input('typePrice'))){
                return ApiHelper::buildErrRes(false, 403, "Type Price Can Not Empty If searchBarangPrice Have Value");
            }
          }

        // REVIEW Call Model
          $resModel = TblBarang::searchModel(
            array(
                'searchIdBarang'    => !empty($this->request->input('searchIdBarang')) ? $this->request->input('searchIdBarang') : null,
                'searchBarangName'  => !empty($this->request->input('searchBarangName')) ? $this->request->input('searchBarangName') : null,
                'searchBarangPrice' => !empty($this->request->input('searchBarangPrice')) ? $this->request->input('searchBarangPrice') : null,
                'typePrice'         => !empty($this->request->input('typePrice')) ? $this->request->input('typePrice') : null,
            )
          );

          if(!$resModel->status){
              return ApiHelper::buildErrRes(false, $resModel->code, $resModel->message, $resModel->errors);
          }

        // REVIEW Set Result
          $tempFinalRes = $resModel->data;
          return ApiHelper::buildRes(true, 200, 'Data Barang Found', $tempFinalRes);

    }

}

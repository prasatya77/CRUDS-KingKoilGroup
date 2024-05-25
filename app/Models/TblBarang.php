<?php

namespace App\Models;

use App\Http\Helper\ApiHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TblBarang extends Model
{
    protected $table      = 'tbl_barang';
    protected $primaryKey = 'id_barang';

    use SoftDeletes;

    // REVIEW Define Param Value for Search Model
    public static function defineParamFilter(){
        $collectFilterNameVariable = array(
            'collectSelect',

            'searchIdBarang',
            'searchBarangName',
            'searchBarangPrice',
            'typePrice'
        );

        return $collectFilterNameVariable;
    }

    public static function searchModel($params){
        try{
            //REVIEW Genereate Variable For Filter
                $collectVariable = TblBarang::defineParamFilter();
                foreach ($collectVariable as $attr) {
                    ${$attr} = (isset($params[$attr]) ? $params[$attr] : null);
                }
                
            // REVIEW Get All Data Barang
                $resGetData = self::when($collectSelect, function($query) use($collectSelect){
                        return $query->select($collectSelect);
                    })
                    ->when($searchIdBarang, function($query) use($searchIdBarang){
                        return $query->where('id_barang', $searchIdBarang);
                    })
                    ->when($searchBarangName, function($query) use($searchBarangName){
                        return $query->where('nama_barang','regexp','^'.$searchBarangName.'.*|.*'.$searchBarangName.'.*|.*'.$searchBarangName.'$');
                    })
                    ->when($searchBarangPrice, function($query) use($searchBarangPrice, $typePrice){
                        if($typePrice == 'GREATER'){
                            return $query->where('harga_barang','>',$searchBarangPrice);
                        }
                        else if($typePrice == 'EQUAL'){
                            return $query->where('harga_barang','=',$searchBarangPrice);
                        }
                        else if($typePrice == 'LESS'){
                            return $query->where('harga_barang','<',$searchBarangPrice);
                        }else{
                            return $query->where('harga_barang','=',$searchBarangPrice);
                        }
                    });

                $data = $resGetData->get()->toArray();
                if(is_array($data)){
                    if(count($data) > 0){
                        return ApiHelper::buildFuncRes(true, 200, 'Data Barang Found', $data);
                    }
                }

                return ApiHelper::buildFuncRes(false, 404, 'Data Barang Not Found');
    

        } catch (\Exception $e) {
            Log::error( $e );

            return ApiHelper::buildFuncRes(false, 500, 'Data Barang Not Found');
        }
    }

    public static function createModel($params){

        try{
            DB::beginTransaction();

        // REVIEW Insert
            $insertId = self::insertGetId($params);
            if(empty($insertId)){
                DB::rollBack();
                return ApiHelper::buildFuncRes(false, 403, 'Data Barang Failed Insert');
            }

        // REVIEW Get Data
            $collectBarang = self::where('id_barang', $insertId)->get()->toArray();

            // REVIEW Check Data Result
                if(is_array($collectBarang)){
                    if(count($collectBarang) > 0){
                        DB::commit();
                        return ApiHelper::buildFuncRes(true, 200, 'Data Barang Insert Success', $collectBarang);
                    }
                }

                DB::rollBack();
                return ApiHelper::buildFuncRes(false, 403, 'Data Barang Failed Insert');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error( $e );

            return ApiHelper::buildFuncRes(false, 500, 'Data Barang Failed Insert');
        }
    }

    public static function readModel($idBarang){

        try{
            $collectBarang = self::where('id_barang', $idBarang)->get()->toArray();

            // REVIEW Check Data Result
                if(is_array($collectBarang)){
                    if(count($collectBarang) > 0){
                        return ApiHelper::buildFuncRes(true, 200, 'Data Barang Found', $collectBarang);
                    }
                }
                return ApiHelper::buildFuncRes(false, 404, 'Data Barang Not Found');

        } catch (\Exception $e) {
            Log::error( $e );

            return ApiHelper::buildFuncRes(false, 500, 'Data Barang Not Found');
        }
    }

    public static function updateModel($params, $idBarang){

        try{
            DB::beginTransaction();

        // REVIEW Update
            self::where('id_barang',$idBarang)
                ->update($params);

        // REVIEW Get Data
            $collectBarang = self::where('id_barang', $idBarang)->get()->toArray();

            // REVIEW Check Data Result
                if(is_array($collectBarang)){
                    if(count($collectBarang) > 0){
                        DB::commit();
                        return ApiHelper::buildFuncRes(true, 200, 'Data Barang Update Success', $collectBarang);
                    }
                }

                DB::rollBack();
                return ApiHelper::buildFuncRes(false, 403, 'Data Barang Failed Update');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error( $e );

            return ApiHelper::buildFuncRes(false, 500, 'Data Barang Failed Update');
        }
    }

    public static function deleteModel($idBarang){

        try{
            DB::beginTransaction();

        // REVIEW Delete use Soft Delete
            self::where('id_barang',$idBarang)
                ->update(['deleted_at' => date("Y-m-d H:i:s")]);

            DB::commit();
            return ApiHelper::buildFuncRes(true, 200, 'Data Barang Soft Delete Success');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error( $e );

            return ApiHelper::buildFuncRes(false, 500, 'Data Barang Failed Soft Delete');
        }
    }
}
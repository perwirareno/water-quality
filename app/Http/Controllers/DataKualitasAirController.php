<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\TblKualitasAir;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataKualitasAirController extends Controller
{
    public function index(){
        try {
            $data = TblKualitasAir::all();
            $data_response = Helpers::generateResponse(1, 200, trans('KualitasAirMessage.success_view_all'), $data, null);
        } catch (Exception $e) {
            $data_response = Helpers::getException($e);
        }

        return $data_response;
    }

    public function view(Request $request){
        try {
            $id = $request->id;
            
            if (isset($id)) {
                $data = TblKualitasAir::find($id);
                if ($data) {
                    $data_response = Helpers::generateResponse(1, 200, trans('KualitasAirMessage.success_view_by_id'), $data, null);
                } else {
                    $data_response = Helpers::generateResponse(0, 404, trans('KualitasAirMessage.failed_view_by_id'), null, null);
                }
            }
        } catch (Exception $e) {
            $data_response = Helpers::getException($e);
        }

        return $data_response;
    }

    public function store(Request $request){
        DB::beginTransaction();
        try {
            $data_kualitas_air = new TblKualitasAir;
            $data_kualitas_air->id = $request->id;
            $data_kualitas_air->temperatur = $request->temperatur;
            $data_kualitas_air->tds = $request->tds;
            $data_kualitas_air->tss = $request->tss;
            $data_kualitas_air->ph = $request->ph;
            $data_kualitas_air->bod = $request->bod;
            $data_kualitas_air->cod = $request->cod;
            $data_kualitas_air->do = $request->do;
            $data_kualitas_air->curah_hujan = $request->curah_hujan;
            $data_kualitas_air->kelas = $request->kelas;
            $data_kualitas_air->save();
            
            DB::commit();

            $data_response = Helpers::generateResponse(1, 200, trans('KualitasAirMessage.success_create_data'), null, null);
        } catch (Exception $e) {
            DB::rollBack();
            $data_response = Helpers::getException($e);
        }

        return $data_response;
    }

    public function update(Request $request, $id){
        DB::beginTransaction();
        try {
            TblKualitasAir::where('id','=',$id)->update([
                'temperatur' => $request->temperatur,
                'tds' => $request->tds,
                'tss' => $request->tss,
                'ph' => $request->ph,
                'bod' => $request->bod,
                'cod' => $request->cod,
                'do' => $request->do,
                'curah_hujan' => $request->curah_hujan,
                'kelas' => $request->kelas
            ]);
            
            DB::commit();

            $data_response = Helpers::generateResponse(1, 200, trans('KualitasAirMessage.success_update_data'), null, null);
        } catch (Exception $e) {
            DB::rollBack();
            $data_response = Helpers::getException($e);
        }

        return $data_response;
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            $data_kualitas_air = TblKualitasAir::find($id);
            $data_kualitas_air->delete();
            
            DB::commit();

            $data_response = Helpers::generateResponse(1, 200, trans('KualitasAirMessage.success_delete_data'), null, null);
        } catch (Exception $e) {
            DB::rollBack();
            $data_response = Helpers::getException($e);
        }

        return $data_response;
    }
}
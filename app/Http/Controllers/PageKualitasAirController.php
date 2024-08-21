<?php

namespace App\Http\Controllers;

use App\Helpers\APIConnection;
use App\Models\TblKualitasAir;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PageKualitasAirController extends Controller
{
    public function index(Request $request)
    {
        // Get response from services
        $endpoint = '/api/kualitas_air';
        $method = 'GET';
        $response = APIConnection::getResponse($endpoint, $method);
        $data_kualitas_air = $response['data'];

        // Draw data from services response
        if ($request->ajax()) {
            return Datatables::of($data_kualitas_air)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row['id'] . '" class="edit btn btn-primary btn-sm editKualitasAir"><i class="fa fa-edit"></i> Edit</a>';
                    $btn = $btn . '&nbsp' . '<a href="javascript:void(0)" data-id="' . $row['id'] . '" class="view btn btn-success btn-sm viewKualitasAir"><i class="fa fa-eye"></i> View</a>';
                    $btn = $btn . '&nbsp' . '<a href="javascript:void(0)" data-id="' . $row['id'] . '" class="btn btn-danger btn-sm deleteKualitasAir"><i class="fa fa-trash"></i> Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('kualitas_air.index', compact('data_kualitas_air'));
    }

    // public function show(Request $request)
    // {
    //     dd($request->all());
    //     // // Get response from services
    //     // $endpoint = '/api/kualitas_air';
    //     // $method = 'GET';
    //     // $response = APIConnection::getResponse($endpoint, $method);
    //     // $data_kualitas_air = $response['data'];
    // }

    public function store(Request $request)
    {
        $id = $request->id;
        $response_msg = "";

        // Set Parameter
        $params = [
            'temperatur' => $request->temperatur,
            'tds' => $request->tds,
            'tss' => $request->tss,
            'ph' => $request->ph,
            'bod' => $request->bod,
            'cod' => $request->cod,
            'do' => $request->do,
            'curah_hujan' => $request->curah_hujan,
            'kelas' => $request->kelas
        ];

        // Encode param
        $query_string = http_build_query($params);

        // If $id = null then store, else do update
        if ($id == null) {
            // Get response from services
            $endpoint = '/api/kualitas_air?'.$query_string;
            $method = 'POST';
            $response = APIConnection::getResponse($endpoint, $method);
            $response_msg = $response['message'];
        } else {
            // Get response from services
            $endpoint = '/api/kualitas_air/'.$id.'?'.$query_string;
            $method = 'PUT';
            $response = APIConnection::getResponse($endpoint, $method);
            $response_msg = $response['message'];
        }

        return response()->json(['success' => $response_msg]);
    }

    public function edit($id)
    {
        $datakualitasair = TblKualitasAir::find($id);
        return response()->json($datakualitasair);
    }

    public function destroy($id)
    {
        // Get response from services
        $endpoint = '/api/kualitas_air/'.$id.'';
        $method = 'DELETE';
        $response = APIConnection::getResponse($endpoint, $method);

        return response()->json(['success' => $response['message']]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SuaCauHoi extends Controller
{
    function suacauhoi(Request $request){
        if($request->session()->has('quyen') && $request->session()->get('quyen')=="admin" ){
            $cauhoi = json_decode($request->get('CH'));
            DB::table('cauhoi')
            ->where('ID', $cauhoi->ID)
            ->update(['NoiDung' => $cauhoi->NoiDung , 'DoKho' => $cauhoi->DoKho]);
             foreach($cauhoi->DapAn as $da){
                DB::table('dapan')
            ->where('ID', $da->ID)
            ->update(['NoiDung' => $da->NoiDung , 'DapAn' => $da->DapAn]);
            }
            
            echo "Sửa thành công";
        }

    }
}

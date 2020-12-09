<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ThemCauHoi extends Controller
{
    function themcauhoi(Request $request){
   
            if($request->session()->has('quyen') && $request->session()->get('quyen')=="admin" ){
                $cauhoi = json_decode($request->get('data'));
                $id = DB::table('cauhoi')->insertGetId(
            ['NoiDung' => $cauhoi->noiDung, 'DoKho' => $cauhoi->doKho,'IDMH' => $cauhoi->IDMH,'NhomCH' => null]
        );

         foreach($cauhoi->dapAn as $da){
            DB::table('dapan')->insert(
                ['ID' => null,'IDCH' => $id,'NoiDung'=> $da->noiDung,'DapAn'=> $da->dapAn]
            );
                     }
                     echo "Thêm thành công";
                           }
                                 }
                                        
                                      }

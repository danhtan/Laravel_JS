<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class XemDiem extends Controller
{
    function xemdiem(Request $request){
       
         $idtk=$request->session()->get('ID');
         $monhoc= $request->post('TenMH');
        $sqlIDMH = DB::table('monhoc')->select('ID')->where('TenMonhoc' ,$monhoc)->get();
        $total = DB::table('monhoc')->select('ID')->where('TenMonhoc' ,$monhoc)->get()->count();
         if ($total > 0) {
            foreach($sqlIDMH as $row){
                $IDMH = $row->ID;
                } 
             $sqlDiem = DB::table('diem')->select('Diem')->where('IDMH' ,$IDMH)->where('IDTK' ,$idtk)->get();
             $total1 = DB::table('diem')->select('Diem')->where('IDMH' ,$IDMH)->where('IDTK' ,$idtk)->get()->count();
             if($total1 > 0){
                foreach($sqlDiem as $row){
                    echo $row->Diem;
                    } 
             }
             else{
                 echo '-1';
             }
         }

    }
}

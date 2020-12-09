<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DanhSachMonThi extends Controller
{
    function danhsach(Request $request){
     $json=array();

    if($request->session()->has('quyen') && $request->session()->get('quyen')=="user" ) {
       
        $data = DB::table('monhoc')->get();
        $total = DB::table('monhoc')->get()->count();
        if($total > 0){
        foreach($data as $row){
            $ID = $row->ID;
            $TenMonHoc = $row->TenMonHoc;
            array_push($json,array("ID"=>$ID, "TenMonHoc"=>$TenMonHoc));
           
            }    
        }
                 }
                 echo json_encode($json);

    }


}

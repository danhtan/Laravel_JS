<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DanhSachMonThi_admin extends Controller
{
    function danhsach_admin(Request $request){
        $json=array();
       if($request->session()->has('quyen') && $request->session()->get('quyen')=="admin" ) {
          
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

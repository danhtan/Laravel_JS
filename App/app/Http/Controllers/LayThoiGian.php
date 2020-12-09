<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
class LayThoiGian extends Controller
{
    
    function laythoigian(Request $request){
        $tenmon="";
        $query=0;
        $tenmon = $request->post('TenMH');
        $json=(object) array("start"=>"2050/01/01 00:00:00", "end"=>"2050/01/01 01:00:00","thi"=>false,"tenmon"=>$tenmon);
    
        
        $sqlIDMH = DB::table('monhoc')->select('ID')->where('TenMonHoc' , $tenmon)->get();
        foreach($sqlIDMH as $row){
            $query = $row->ID;
            } 
         
        $sql = DB::table('thoigian')->select('thoigianbatdau', 'thoigianketthuc')->where('thoigianbatdau', '<', Carbon::now('Asia/Ho_Chi_Minh'))->where('thoigianketthuc', '>', Carbon::now('Asia/Ho_Chi_Minh'))->where('IDMH', $query)->get();
        $total = DB::table('thoigian')->select('thoigianbatdau', 'thoigianketthuc')->where('thoigianbatdau', '<', Carbon::now('Asia/Ho_Chi_Minh'))->where('thoigianketthuc', '>', Carbon::now('Asia/Ho_Chi_Minh'))->where('IDMH', $query)->get()->count();
        if($total > 0){
            foreach ($sql as $row) {
                $json->start = $row->thoigianbatdau;
                $json->end = $row->thoigianketthuc;
            }
            $json->thi = true;
            
        }
        else{
            $json->thi = false;
            $sql1 = DB::table('thoigian')->select('thoigianbatdau', 'thoigianketthuc')->where('thoigianbatdau', '>', Carbon::now('Asia/Ho_Chi_Minh'))->where('IDMH', $query)->get();
            $total1 = DB::table('thoigian')->select('thoigianbatdau', 'thoigianketthuc')->where('thoigianbatdau', '>', Carbon::now('Asia/Ho_Chi_Minh'))->where('IDMH', $query)->get()->count();
            if($total1 > 0){
                foreach ($sql1 as $row) {
                    $json->start = $row->thoigianbatdau;
                    $json->end = $row->thoigianketthuc;
                }

            }
        }

        echo json_encode($json);



    }
    

}

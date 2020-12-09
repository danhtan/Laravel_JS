<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DanhSachCauHoi_admin extends Controller
{
    function danhsachcauhoi_admin(Request $request){
        $json=array();
        if($request->session()->has('quyen') && $request->session()->get('quyen')=="admin" ) {
             $id = $request->get('ID');
            $sql = DB::table('cauhoi')->where('IDMH',$id)->get();
            $total = DB::table('cauhoi')->where('IDMH',$id)->get()->count();
                if($total > 0){
                    foreach($sql as $row){
                        $ID= $row->ID;
                        $NoiDung = $row->NoiDung;
                        $DoKho = $row->DoKho;
                        $IDMH = $row->IDMH;
                        $DapAn = array();
                        $sql2 = DB::table('DapAn')->where('IDCH' ,$ID)->get();
                        $total2 = DB::table('DapAn')->where('IDCH' ,$ID)->get()->count();
                        if($total2 > 0){
                            foreach($sql2 as $row){
                                    $IDDA = $row->ID;
                                    $IDCH = $ID;
                                    $NoiDungDA = $row->NoiDung;
                                    $dapAn = $row->DapAn;
                                    array_push($DapAn,array("ID"=>$IDDA, "IDCH"=>$IDCH, "NoiDung"=>$NoiDungDA, "DapAn"=>$dapAn));
                            }
                        }
                      
                        array_push($json,array("ID"=>$ID, "NoiDung"=>$NoiDung, "DoKho"=>$DoKho, "IDMH"=>$IDMH, "DapAn"=>$DapAn));
                    }

                }
           


        }
                     echo json_encode($json);



    }


}

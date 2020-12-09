<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DanhSachCauHoi extends Controller
{
    function danhsachcauhoi(Request $request) {

     $json=array();
     if($request->session()->has('quyen') && $request->session()->get('quyen')=="user") {
        $cauhinh = [
            'Toán Học' => [
                '1' => [
                    'Cacbon-Silic' => 3,
                    'sunfaat'    => 3,
                ], 
                '2' => [

                ]                
            ],
            'Vật Lí' => [
                '1' => [
                    'Cacbon-Silic' => 3,
                    'sunfaat'    => 3,
                ], 
                '2' => [

                ]                
            ],

            'Hóa Học' => [
                '1' => [
                    'Cacbon – Silic' => 3,
                    'Phân biệt - nhận biết'    => 3,
                ]
            ]
        ];

     
         $SoCau = 30;
         $ID_MH = 0;
        $ten="";
    
        $ten=$request->post('tenmh'); 
        $sessionDataKey = 'danglambaithi_'.md5($ten);
        if( $request->session()->has($sessionDataKey) && 
        $sessionData = $request->session()->get($sessionDataKey) ){
            goto _inketqua;
        }

        $laysocau = DB::table('monhoc')->select('SoCauTrongDe')->where('TenMonHoc' ,$ten)->get();

         $result = DB::table('monhoc')->select('SoCauTrongDe')->where('TenMonHoc' ,$ten)->get()->count();
         if($result > 0){
            foreach($laysocau as $row){
                $SoCau = $row->SoCauTrongDe;
                } 
            }

             foreach($cauhinh[$ten] as $dokho => $mangdokho){
             foreach($mangdokho as $nhom => $socau){
            $IDMH = DB::table('monhoc')->select('ID')->where('TenMonHoc' ,$ten)->get();
            foreach($IDMH as $row){
                 $ID_MH= $row->ID;
                } 
            $sql = DB::table('cauhoi')->where('IDMH' ,$ID_MH)->where('dokho' ,$dokho)->where('nhomch' ,$nhom) ->inRandomOrder() ->limit($socau)->get();
            $total = DB::table('cauhoi')->where('IDMH' ,$ID_MH)->where('dokho' ,$dokho)->where('nhomch' ,$nhom) ->inRandomOrder() ->limit($socau)->get()->count();
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
                                array_push($DapAn,array("ID"=>$IDDA, "IDCH"=>$IDCH, "NoiDung"=>$NoiDungDA));
                        }
                    }
                    shuffle($DapAn);
                    array_push($json,array("ID"=>$ID, "NoiDung"=>$NoiDung, "DoKho"=>$DoKho, "IDMH"=>$IDMH, "DapAn"=>$DapAn));
                }
                   shuffle($json);
               }
            }
        }
    }
     
    $sessionData = json_encode(array_slice($json,0,$SoCau));
    $request->session()->put('danglambaithi_'.md5($ten), $sessionData );

    _inketqua:
    echo $sessionData;
}
}
 






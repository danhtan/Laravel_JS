<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ChamDiem extends Controller
{
    function chamdiem(Request $request){
        $diem=0;
        $soCauHoi = $request->post('socauhoi');
        if($soCauHoi != 0){
            $soDapAnDung = 0;
            $dapAn = $request->post('dapan');
            foreach($dapAn as $id){
                 $sql = DB::table('DapAn')->where('id' ,$id)->get();
                 $total = DB::table('DapAn')->where('id' ,$id)->get()->count();
                if ($total > 0) {
                   foreach($sql as $row)
                    if($row->DapAn == 1){
                        $soDapAnDung++;
                    } 
                }
            }
            $tenmon = $request->session()->get('tenmon');

            $sessionDataKey = 'danglambaithi_'.md5($tenmon);
            $request->session()->forget($sessionDataKey); //xoa de thi vu lam xong, lan sau tao ra de thi moi...

            $sqlIDMH = DB::table('monhoc')->select('id')->where('TenMonHoc' ,$tenmon)->get();
            $total1 =  DB::table('monhoc')->select('id')->where('TenMonHoc' ,$tenmon)->get()->count();
            if($total1 > 0){
                foreach($sqlIDMH as $row){
                    $idmh = $row->id;
                    $diem = 10/$soCauHoi*$soDapAnDung;
                    $idtk = $request->session()->get('ID');

                    DB::table('diem')->where('IDMH', $idmh)->where('IDTK' , $idtk)->delete(); // xoa cai cu di truoc...
                    DB::table('history')->where('IDMH', $idmh)->where('IDTK' , $idtk)->delete(); // xoa cai cu di truoc...

                    $sqlInsertDiem = DB::table('diem')->insert(
                        ['IDMH' => $idmh,'IDTK' => $idtk,'Diem'=>$diem]
                    );
                }
            }
        }
         else{
            $tenmon = $request->session()->get('tenmon');
            $sqlIDMH = DB::table('monhoc')->select('id')->where('TenMonHoc' ,$tenmon)->get();
            $total1 =  DB::table('monhoc')->select('id')->where('TenMonHoc' ,$tenmon)->get()->count();                
            if($total1 > 0){
                foreach($sqlIDMH as $row){
                    $idmh = $row->id;
                    $diem = 0;
                    $idtk = $request->session()->get('ID');

                    

                    $sqlInsertDiem =   DB::table('diem')->insert(
                       ['IDMH' => $idmh,'IDTK' => $idtk,'Diem'=>$diem]
                    );
                }
            }
         }

        
        

         echo $diem;
    }
}


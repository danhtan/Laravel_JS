<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LayDiem extends Controller
{
    function laydiem(Request $request){
        $json=array();
        $idtk = $request->session()->get('ID');
        $data =  DB::table('Diem')->join('MonHoc', 'Diem.IDMH', '=', 'MonHoc.ID')->select('Diem', 'TenMonHoc')->where('IDTK' ,$idtk)->get();
        $total = DB::table('Diem')->join('MonHoc', 'Diem.IDMH', '=', 'MonHoc.ID')->select('Diem', 'TenMonHoc')->where('IDTK' ,$idtk)->get()->count();
        if($total > 0){
            foreach($data as $row){
                $tenmon = $row->TenMonHoc;
                $diem = $row->Diem;
                array_push($json,array("TenMonHoc"=>$tenmon, "Diem"=>$diem));
               
                }   
        }
        echo json_encode($json);

    }
    

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LichSuThi extends Controller
{
    function lichsuthi(Request $request){
        $idMH = 0;
        $idch = $request->post('idch');
        $dapan = $request->post('dapan');
        $ten = $request->post('tenmh'); 
        $idtk = $request->session()->get('ID');
        $idmh = DB::table('monhoc')->select('ID')->where('TenMonHoc' ,$ten)->get(); //
        foreach($idmh as $row){
            $idMH = $row->ID;
        }

        for ($i = 0; $i < count($idch) ; $i++) { 
            $total = $idch[$i];
            $total1 = $dapan[$i];
            DB::table('history')->insert(
            ['ID' => null,'IDMH' => $idMH,'IDTK'=>$idtk,'IDCH'=>$total,'IDDA'=>$total1]
        );
        }
       

    }



}

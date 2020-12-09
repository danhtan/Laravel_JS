<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request ;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;

class Login_controller extends Controller
{
     function check_login(Request $request){     
        $user = $request->get('user1');
        $pass = $request->get('pass1');
        $data = DB::table('taikhoan')->where('TenTaiKhoan' ,$user)->Where('MatKhau', $pass)->get();
        $total = DB::table('taikhoan')->where('TenTaiKhoan',$user)->Where('MatKhau', $pass)->get()->count();
        if($total>0){
           foreach($data as $row){
           $request->session()->put('ID', $row->ID);
           $request->session()->put('username', $row->TenTaiKhoan);
           $request->session()->put('quyen', $row->Quyen);
           echo $row->Quyen;
           }    
        }
        else{
            echo "false";
        }

    }

    function logout(Request $request){
      $request->session()->forget('ID');
      $request->session()->forget('username');
      $request->session()->forget('quyen');
      return view('index');
     
    }
    
}



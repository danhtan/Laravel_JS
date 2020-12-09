<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LayThongTin extends Controller
{
  
    function laythongtin(Request $request ){

       if($request->session()->has('quyen') && $request->session()->get('quyen')=="user"){
        $value = $request->session()->get('username');
        echo $value;
    }

    }
 


}

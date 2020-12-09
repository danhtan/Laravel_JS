<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClickMonThi extends Controller
{
    function clickmonthi(Request $request){
       $TenMH = $request->post('TenMH');
        $request->session()->put('tenmon',  $TenMH );
        $value = $request->session()->get('tenmon');
        echo $value;
    }


}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LayTenMon extends Controller
{
    function laytenmon(Request $request){

        // $value = $request->session()->get('tenmon');
         $value = $request->get('tenmon');

        echo $value;

    }
}

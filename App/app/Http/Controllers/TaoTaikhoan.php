<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class TaoTaikhoan extends Controller
{
    function taotaikhoan(Request $request){
        if($request->session()->has('quyen') && $request->session()->get('quyen')=="admin" ) {
        $tenTK = $request->get('tenTK');
        $mk = $request->get('mK');
        $data = DB::table('taikhoan')->where('TenTaiKhoan' ,$tenTK)->get();
        $total = DB::table('taikhoan')->where('TenTaiKhoan',$tenTK)->get()->count();
        if($total > 0){
            echo "Tên đăng nhập đã tồn tại";
        }
        else{
            DB::table('taikhoan')->insert(
                ['ID' => null,'TenTaiKhoan' => $tenTK,'MatKhau'=>$mk,'Quyen'=>'user']
            );
            echo "Tạo thành công";
        }
    
       
                 }
    
        }
}

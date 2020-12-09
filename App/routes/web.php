<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/welcome', function () {
    return 'Chào mừng các bạn đã đến với toidicode.com';
});

Route::get('/view_login', function () {
    return view('index');
});

Route::get('/view_admin', function () {
    return view('admin');
})->name('view_admin.check');

Route::get('/checklogin','Login_controller@check_login')->name('checklogin.check');

Route::get('/logout', 'Login_controller@logout')->name('logout.view');
    
Route::get('/taotaikhoan','TaoTaikhoan@taotaikhoan')->name('taotaikhoan.create');

Route::get('/danhsachmon_admin', 'DanhSachMonThi_admin@danhsach_admin')->name('danhsach_admin.check');

Route::get('/danhsachcauhoi_admin', 'DanhSachCauHoi_admin@danhsachcauhoi_admin')->name('danhsachcauhoi_admin.check');

Route::get('/themcauhoi', 'ThemCauHoi@themcauhoi')->name('themcauhoi.check');

Route::get('/suacauhoi', 'SuaCauHoi@suacauhoi')->name('suacauhoi.check');

Route::get('/view_user', function () {
    return view('user');
})->name('view_user.check');

Route::get('/view_thi', function () {
    return view('thi');
})->name('thi.view');

Route::get('/danhsachmon', 'DanhSachMonThi@danhsach')->name('danhsach.check');

Route::post('/clickmon', 'ClickMonThi@clickmonthi')->name('clickmonthi.check');

Route::get('/laythongtin', 'LayThongTin@laythongtin')->name('laythongtin.check');

Route::get('/laydiem', 'LayDiem@laydiem')->name('laydiem.check');

Route::post('/laythoigian', 'LayThoiGian@laythoigian')->name('laythoigian.check');

Route::post('/xemdiem', 'XemDiem@xemdiem')->name('xemdiem.check');

Route::get('/laytenmon', 'LayTenMon@laytenmon')->name('laytenmon.check');

Route::post('/danhsachcauhoi', 'DanhSachCauHoi@danhsachcauhoi')->name('danhsachcauhoi.check');

Route::post('/chamdiem', 'ChamDiem@chamdiem')->name('chamdiem.check');

Route::post('/lichsuthi', 'LichSuThi@lichsuthi')->name('lichsuthi.check');

Route::post('/laylichsuthi', 'LayLichSuThi@laylichsuthi')->name('laylichsuthi.check');




















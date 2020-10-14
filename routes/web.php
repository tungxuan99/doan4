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

Route::get('/', 'Admin\ThongKeController@ViewTKMon')->name('admin.index');
//Quản lý giáo viên
Route::group(['prefix' => 'admin'], function(){
	// Route::resource('/giao-vien','Admin\QLGiaoVienController');
	Route::get('/giao-vien','Admin\QLGiaoVienController@index')->name('giaovien.index');
	Route::get('/giao-vien/{id?}','Admin\QLGiaoVienController@edit')->name('giaovien.edit');
	Route::post('/giao-vien','Admin\QLGiaoVienController@create')->name('giaovien.create');
	Route::put('/giao-vien/{id?}','Admin\QLGiaoVienController@put')->name('giaovien.put');
	Route::delete('/giao-vien/{id?}','Admin\QLGiaoVienController@delete')->name('giaovien.delete');
});

//Quản lý học sinh
Route::group(['prefix' => 'admin'], function(){
	// Route::resource('/hocsinh','Admin\QLHocSinhController');
	Route::get('/hoc-sinh','Admin\QLHocSinhController@index')->name('hocsinh.index');
	Route::get('/hoc-sinh/{id?}','Admin\QLHocSinhController@edit')->name('hocsinh.edit');
	Route::post('/hoc-sinh','Admin\QLHocSinhController@create')->name('hocsinh.create');
	Route::put('/hoc-sinh/{id?}','Admin\QLHocSinhController@put')->name('hocsinh.put');
	Route::delete('/hoc-sinh/{id?}','Admin\QLHocSinhController@delete')->name('hocsinh.delete');
	Route::get('/hoc-sinh/{khoi?}','Admin\QLHocSinhController@khoi')->name('hocsinh.khoi');
	Route::get('/hoc-sinh1/{lop?}','Admin\QLHocSinhController@lop')->name('hocsinh.lop');
});

//Quản lý lớp học
Route::group(['prefix' => 'admin'], function(){
	// Route::resource('/lophoc','Admin\QLLopHocController');
	Route::get('/lop-hoc','Admin\QLLopHocController@index')->name('lophoc.index');
	Route::get('/lop-hoc/{id?}','Admin\QLLopHocController@edit')->name('lophoc.edit');
	Route::post('/lop-hoc','Admin\QLLopHocController@create')->name('lophoc.create');
	Route::put('/lop-hoc/{id?}','Admin\QLLopHocController@put')->name('lophoc.put');
	Route::delete('/lop-hoc/{id?}','Admin\QLLopHocController@delete')->name('lophoc.delete');
});

//Quản lý môn học
Route::group(['prefix' => 'admin'], function(){
	Route::get('/mon-hoc','Admin\QLMonHocController@index')->name('monhoc.index');
	Route::get('/mon-hoc/{id?}','Admin\QLMonHocController@edit')->name('monhoc.edit');
	Route::post('/mon-hoc','Admin\QLMonHocController@create')->name('monhoc.create');
	Route::put('/mon-hoc/{id?}','Admin\QLMonHocController@put')->name('monhoc.put');
	Route::delete('/mon-hoc/{id?}','Admin\QLMonHocController@delete')->name('monhoc.delete');
});

//Quản lý điểm và điểm danh
Route::group(['prefix' => 'admin'], function(){
	//điểm danh
	Route::get('/quan-ly','Admin\QuanLyController@index')->name('quanly.index');
	Route::post('/quan-ly-diem-danh','Admin\QuanLyController@diemdanh')->name('quanly.diemdanh');
	Route::post('/quan-ly/create','Admin\QuanLyController@create')->name('quanly.create');
	//thêm điểm
	Route::get('/quan-ly-diem','Admin\QuanLyController@diemindex')->name('quanly.diem');
	Route::post('/quan-ly-diem','Admin\QuanLyController@ThemDiem')->name('quanly.diem');
	Route::post('/quan-ly/creatediem','Admin\QuanLyController@creatediem')->name('quanly.creatediem');
	//Sửa điểm
	Route::get('/sua-diem','Admin\QuanLyController@SuaDiemIndex')->name('quanly.suadiem');
	Route::post('/sua-diem','Admin\QuanLyController@SuaDiem')->name('quanly.suadiem');
	Route::post('/quan-ly/updatediem','Admin\QuanLyController@updatediem')->name('quanly.updatediem');
	//Xem điểm
	Route::get('/xem-diem','Admin\QuanLyController@xemdiem')->name('quanly.xemdiem');
	Route::post('/xem-diem','Admin\QuanLyController@dsdiem')->name('quanly.xemdiem');
	Route::get('/mail','Admin\QuanLyController@sendmail');
	Route::get('/diems','Admin\QuanLyController@hsdiem')->name('diemhs');
});

//Thống kê
Route::group(['prefix' => 'admin'], function(){
	Route::get('/thong-ke-diem','Admin\ThongKeController@ViewTKMon')->name('thongke.diem');
	Route::post('/thong-ke-diem','Admin\ThongKeController@PostTKMon')->name('thongke.diem');
	Route::get('/top10diem','Admin\ThongKeController@TOP10Diem')->name('thongke.top10');
	Route::get('/hb-hoc-sinh','Admin\ThongKeController@DSHocSinh')->name('dshocsinh');
	Route::get('/hb-hoc-sinh/pdf/{MaHS?}','Admin\ThongKeController@pdf')->name('pdf');
});
// DiemHome
Route::get('/admin/login','Admin\QuanLyController@login');
Route::get('/homehs','Home\DiemController@home');
Route::get('/slogin','Home\DiemController@slogin');
Route::get('/diems/{id?}', 'Home\DiemController@Xemdiem')->name('diems');
Route::get('/xemdiem/{id?}', 'Home\DiemController@PHxemdiem');
Route::post('/tradiem', 'Home\DiemController@kt')->name('tradiem');
Route::post('/diemhk','Home\DiemController@diemhk')->name('diemhk');
Route::get('/diemhk','Home\DiemController@tradiemhk')->name('diemhk');
//Đăng nhập
Route::get('dang-ky','Admin\QuanLyController@getinfo')->name('dangky');
Route::post('dang-ky','Admin\QuanLyController@postinfo')->name('dangky');
Route::get('dang-nhap','Admin\QuanLyController@getLogin')->name('login');
Route::post('dang-nhap','Admin\QuanLyController@postLogin')->name('login');
Route::get('dang-xuat','Admin\QuanLyController@postLogout')->name('logout');
Route::get('/import', 'Admin\QuanLyController@themtufile')->name('import');
Route::post('/import', 'Admin\QuanLyController@postImport')->name('import');

Route::get('/test', 'Admin\QuanLyController@test');
Route::group(['prefix' => 'admin'], function(){
	Route::get('/gui-diem', 'Admin\QuanLyController@guidiem')->name('guidiem');
	Route::post('/gui-diem', 'Admin\QuanLyController@sendmail')->name('sendmail');
});

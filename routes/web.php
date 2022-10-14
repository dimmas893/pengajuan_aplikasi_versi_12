<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Keranjangontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\pengajuan_detailController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PusherNotificationController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperSuperAdminController;
use Illuminate\Support\Facades\Auth;
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
// Route::get('/notification', function () {
//     return view('dashboard');
// });

// Route::get('send', [PusherNotificationController::class, 'notification']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/barang', [BarangController::class, 'index'])->name('barang');
Route::get('/barang_json', [BarangController::class, 'barang_json'])->name('barang_json');
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang_store');
Route::get('/barang/edit', [BarangController::class, 'edit'])->name('barang_edit');
Route::post('/barang/update', [BarangController::class, 'update'])->name('barang_update');
Route::delete('/barang/delete', [BarangController::class, 'delete'])->name('barang_delete');



Route::get('/keranjang', [Keranjangontroller::class, 'index'])->name('keranjang');
Route::post('/keranjang/store', [Keranjangontroller::class, 'store'])->name('keranjang_store');
Route::post('/keranjang/store_approve', [Keranjangontroller::class, 'store_approve'])->name('keranjang_store_approve');
Route::post('simpan-pengajuan', [Keranjangontroller::class, 'storePengajuan'])->name('simpan_pengajuan');
Route::get('/keranjang/delete/{id}', [Keranjangontroller::class, 'delete'])->name('keranjang_delete');

Route::get('/keranjang/total', [Keranjangontroller::class, 'total'])->name('keranjang_total');

Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan_store');


Route::get('/approval', [ApprovalController::class, 'index'])->name('approval');
Route::get('/approval/detail/{id}', [ApprovalController::class, 'detail'])->name('approval_detail');
Route::get('/approval/edit/{pengajuan}/{pengajuan_detail}', [ApprovalController::class, 'edit']);
Route::get('/approval/update', [ApprovalController::class, 'update'])->name('approval_update');


Route::get('/approval/data_user_barang_approve', [ApprovalController::class, 'data_user_barang_approve'])->name('approval_data_user_barang_approve');
Route::get('/approval/data_user_barang_belum_approve', [ApprovalController::class, 'data_user_barang_belum_approve'])->name('approval_data_user_barang_belum_approve');

Route::get('/approval/data_admin_barang_approve', [ApprovalController::class, 'data_admin_barang_approve'])->name('approval_data_admin_barang_approve');
Route::get('/approval/data_admin_barang_belum_approve', [ApprovalController::class, 'data_admin_barang_belum_approve'])->name('approval_data_admin_barang_belum_approve');

Route::get('/approval/data_level_2_barang_belum_approve', [ApprovalController::class, 'data_level_2_barang_belum_approve'])->name('approval_data_level_2_barang_belum_approve');
Route::get('/approval/data_level_2_barang_approve', [ApprovalController::class, 'data_level_2_barang_approve'])->name('approval_data_level_2_barang_approve');

Route::get('/approval/data_level_3_barang_approve', [ApprovalController::class, 'data_level_3_barang_approve'])->name('approval_data_level_3_barang_approve');
Route::get('/approval/data_level_3_barang_belum_approve', [ApprovalController::class, 'data_level_3_barang_belum_approve'])->name('approval_data_level_3_barang_belum_approve');




Route::get('/approval/admin', [ApprovalController::class, 'admin'])->name('approval_admin');
Route::get('/approval/notiv/user', [ApprovalController::class, 'notiv_user'])->name('approval_notiv_user');
Route::get('/approval/notiv/level_1', [ApprovalController::class, 'notiv'])->name('approval_notiv_level_1');
Route::get('/approval/notiv/level_2', [ApprovalController::class, 'notiv2'])->name('approval_notiv_level_2');
Route::get('/approval/notiv/level_3', [ApprovalController::class, 'notiv3'])->name('approval_notiv_level_3');
Route::post('/approval/approve_admin', [ApprovalController::class, 'approve_admin'])->name('approval_approve_admin');
Route::get('/approval/approve_admin_detail/{id}', [ApprovalController::class, 'approve_admin_detail'])->name('approval_approve_admin_detail');
Route::get('/approval/approve_admin_edit/{pengajuan}/{pengajuan_detail}', [ApprovalController::class, 'approve_admin_edit'])->name('');
Route::get('/approval/approve_admin_update', [ApprovalController::class, 'approve_admin_update'])->name('approval_approve_admin_update');
Route::get('/approval/edit/ajax', [ApprovalController::class, 'editaprrove'])->name('approval_edit_ajax');
Route::post('/approval/update/ajax', [ApprovalController::class, 'updateapprove'])->name('approval_update_ajax');
Route::delete('/pengajuan_detail/delete', [ApprovalController::class, 'delete_pengajuan_detail'])->name('pengajuan_detail_delete');

Route::get('/super_admin_approval', [SuperAdminController::class, 'index'])->name('super_admin_approval');
Route::get('/barang_super_admin', [SuperAdminController::class, 'barang'])->name('barang_super_admin');
Route::get('/approval/super_admin_detail/{id}', [SuperAdminController::class, 'detail'])->name('approval_super_admin_detail');
Route::post('/approval/approve_superadmin', [SuperAdminController::class, 'store'])->name('approval_approve_superadmin');


Route::get('/super_super_admin_approval', [SuperSuperAdminController::class, 'index'])->name('super_super_admin_approval');
Route::get('/barang_super_super_admin', [SuperSuperAdminController::class, 'barang'])->name('barang_super_super_admin');
Route::get('/approval/super_super_admin_detail/{id}', [SuperSuperAdminController::class, 'detail'])->name('approval_super_super_admin_detail');
Route::post('/approval/approve_supersuperadmin', [SuperSuperAdminController::class, 'store'])->name('approval_approve_supersuperadmin');

Route::get('/pengajuan_detail/delete/{pengajuan}/{pengajuan_detail}', [ApprovalController::class, 'delete']);
Route::get('/pengajuan_detail/delete/{pengajuan}', [ApprovalController::class, 'delete_2']);
Route::get('/pengajuan_detail/delete_pengajuan/{id}', [ApprovalController::class, 'delete_pengajuan'])->name('pengajuan_detail_delete_pengajuan');
Route::get('/all/{id}', [ApprovalController::class, 'all'])->name('all');
Route::get('/all_2/{id}', [ApprovalController::class, 'all_2'])->name('all_2');
Route::get('/all_kondisi/{id}', [ApprovalController::class, 'all_kondisi'])->name('all_kondisi');
Route::get('/all_kondisi_admin/{id}', [ApprovalController::class, 'all_kondisi_admin'])->name('all_kondisi_admin');
Route::get('/sum/total/{id}', [ApprovalController::class, 'total'])->name('total');
Route::get('/tes', [ApprovalController::class, 'tes'])->name('tes');


// Route::get('/login', [LoginController::class, 'login'])->name('login');
// Route::post('/login', [LoginController::class, 'postLogin'])->name('');
// Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/superadminstore', [SuperAdminController::class, 'store']);




require __DIR__ . '/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DplController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\PamongController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RencanaKegiatanController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserControlller;

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



Route::get('/',[BerandaController::class,'index'])->name('home');
Route::get('/auth',[AuthController::class,'index'])->name('auth');
Route::post('/auth',[AuthController::class,'store'])->name('auth.store');
Route::get('/logout',[AuthController::class,'destroy'])->name('auth.logout');
Route::get('/registrasi',[RegisterController::class,'index'])->name('register');
Route::post('/registrasi',[RegisterController::class,'store'])->name('register.store');
Route::get('post/{id}',[InformasiController::class,'show'])->name('post.detail');
Route::get('/berita/{id}',[PostController::class,'show'])->name('berita.detail');
Route::get("tentang-kami",[BerandaController::class,'about'])->name('about');

Route::get('/forgot-password',[ForgotPasswordController::class,'index'])->name('forgotPassword');
Route::post('/forgot-password',[ForgotPasswordController::class,'store'])->name('forgotPassword.store');
Route::get('/reset-password/{token}',[ForgotPasswordController::class,'resetPassword'])->name('password.reset');
Route::post('/reset-password',[ForgotPasswordController::class,'updatePassword'])->name('passwordReset');


// ini halaman dashboard
Route::prefix('/account')->group(function(){
    // halaman edit profile
    Route::middleware('allauth')->group(function(){
        Route::put('profile-update/{id}',[ProfileController::class,'profile'])->name('profile.image');
        Route::resource('profile',ProfileController::class);    
        Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard')->middleware('allauth');
        Route::put('status-rencana-kegiatan/{id}',[RencanaKegiatanController::class,'status'])->name('rencana_kegiatan.status');
        Route::put('status_aktif/{id}',[UserControlller::class,'status'])->name('status');
        Route::post('upload-pembagian',[RencanaKegiatanController::class,'upload_pembagian'])->name('upload_pembagian');
        Route::put('upload-pembagian/{id}',[RencanaKegiatanController::class,'ubah_pembagian'])->name('upload_pembagian.update');
        Route::put('tambah-catatan/{id}',[RencanaKegiatanController::class,'add_catatan'])->name("catatan");
        Route::get('log-book/{id}',[LogbookController::class,'detailLogBook'])->name('detailLog');
        Route::resource('mahasiswa',UserControlller::class);
        Route::resource('logbook',LogbookController::class);
        Route::get("rekap",[LogbookController::class,"rekap"])->name("rekap");
        Route::put("rekap/{id}",[LogbookController::class,"update"])->name("rekap.update");
        Route::put("delete/{id}",[LogbookController::class,"destroy"])->name("rekap.destroy");
        Route::put('/upload-mk',[LaporanController::class,'uploadLaporanMk'])->name('uploadLaporanMk');
    });

    

    
    
    
    
    // mahasiswa akses
    Route::middleware('auth')->group(function(){
        Route::get('log-book',[LogbookController::class,'index'])->name('logbook');
        Route::get('laporan',[LaporanController::class,'index'])->name('laporan');
        Route::post('tambah-laporan',[LaporanController::class,'tambahLaporan'])->name('tambahLaporan');
        Route::resource('rencana-kegiatan',RencanaKegiatanController::class);
    });

    Route::middleware('operatorauth')->group(function(){
        Route::resource('pamong',PamongController::class);
        Route::resource('dosen',DplController::class);    
        Route::resource('pengaturan',SettingController::class);
        Route::resource('operator',OperatorController::class);
        Route::resource('post',InformasiController::class);
        Route::resource('berita',PostController::class);
    });

});








<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenyidikController;
use App\Http\Controllers\UserController;
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

Auth::routes(['verify' => true]);

Route::get('/graph', [HomeController::class, 'graph']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pengaduan', [HomeController::class, 'pengaduan'])->name('pengaduan.index');
Route::get('/tambah-pengaduan', [HomeController::class, 'tambahPengaduan'])->name('pengaduan.add');
Route::post('/simpan-pengaduan', [HomeController::class, 'simpanPengaduan'])->name('pengaduan.store');
Route::get('/pengaduan/{id}', [HomeController::class, 'detailPengaduan'])->name('pengaduan.detail');
Route::post('/pengaduan-delete/{id}', [HomeController::class, 'delete'])->name('pengaduan.delete');
Route::post('/pengaduan-penyidik/{id}', [HomeController::class, 'pilihPenyidik'])->name('pengaduan.penyidik');
Route::get('/pengaduan-ticket/{id}', [HomeController::class, 'chat'])->name('pengaduan.chat');
Route::post('/chat', [HomeController::class, 'chatting'])->name('pengaduan.chatting');

Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
Route::post('/profile', [UserController::class, 'profileUpdate'])->name('user.profile.update');


Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/users-add', [UserController::class, 'add'])->name('user.add');
Route::get('/users-edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/users-update/{id}', [UserController::class, 'update'])->name('user.update');
Route::post('/users-store', [UserController::class, 'store'])->name('user.store');
Route::post('/users-delete/{id}', [UserController::class, 'delete'])->name('user.delete');


Route::get('/penyidik', [PenyidikController::class, 'index'])->name('penyidik.index');
Route::get('/penyidik-add', [PenyidikController::class, 'add'])->name('penyidik.add');
Route::post('/penyidik-store', [PenyidikController::class, 'store'])->name('penyidik.store');


Route::get('/admins', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin-add', [AdminController::class, 'add'])->name('admin.add');
Route::post('/admin-store', [AdminController::class, 'store'])->name('admin.store');

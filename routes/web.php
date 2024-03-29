<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\KehilanganController;
use App\Models\kehilangan;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\TelfonController;
use App\Http\Controllers\JointController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//biar bisa akses laravel breeze

Route::get('/', [KehilanganController::class, 'index'])->name('post.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/savepanggilan',[TelfonController::class,'store']);

Route::get('/layout', function () {
    return view('layout');
});



require __DIR__.'/auth.php';

//route tidak perlu autentifikasi


Route::middleware(['guest'])->group(function () {
    Route::get('homepage', function () {
        return view('homepage-tailwind');
    });
    Route::get('/home', [KehilanganController::class, 'index'])->name('post.index');
  });

//route that need authentication
Route::middleware('auth')->group(function () {
    Route::get('tes', function (){
        return view('tes');
    });
    Route::get('kehilangan', function (){
        return view('teslogout');
    });
    Route::get('/profil', function () {
        return view('profil');
    });
    Route::post('/kehilangan',[KehilanganController::class,'store']);
    Route::get('/profile', [JointController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/destroy/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/laporkehilangan', function () {
        return view('formlaporan');
    });
    Route::get('/kehilangansuccess', function () {
        return view('kehilangan-success');
    });
});

Route::get('/tentang', function () {
    return view('tentangproduk');
});

Route::get('/kehilangan/{id}', [KehilanganController::class, 'show'])->name('show');


Route::post('/savelaporan',[KehilanganController::class,'storeuname']);
Route::get('kehilangan/destroy/{id}', [KehilanganController::class,'destroy']);
Route::get('/post/sortByJenis/{jenis}', [KehilanganController::class, 'sortByJenis'])->name('post.sortByJenis');


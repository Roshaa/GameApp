<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\GeneratePlayerStats;
use App\Http\Controllers\PlayerMenusController;
use App\Models\User;
use App\Http\Controllers\ShopController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');});
Route::get('/dashboard', function () {return redirect('playerprofile');}); 
Route::get('/profile', function () {return view('profile.edit');});
Route::get('/chooseclass', [PlayerMenusController::class,'chooseclass'])->name('chooseclass');

Route::get('/playershop', [PlayerMenusController::class, 'returnshopinfo'])->middleware(['auth', 'verified'])->name('playershop');
Route::get('/playermissions', [PlayerMenusController::class,'missionsmobs'])->middleware(['auth', 'verified'])->name('playermissions');
Route::get('/playerprofile', [GeneratePlayerStats::class, 'returnprofilewithstats'])->middleware(['auth', 'verified'])->name('playerprofile');


//Apenas para testes
Route::get('/devpage', function () {

    $user_id= Auth::user()->id;

    return view('devpage', ['users' => User::get()], ['displayid'=> $user_id]);
    
})->middleware(['auth', 'verified'])->name('devpage');

Route::post('/playermissions',[PlayerMenusController::class,'returncombatview'])->name('CombatResult');
Route::post('/unlockshop',[ShopController::class,'unlockshop'])->name('unlockshop');
Route::post('/shopupgrade',[ShopController::class,'shopupgrade'])->name('shopupgrade');
Route::post('/shoprestock',[ShopController::class,'shoprestock'])->name('shoprestock');
Route::post('/shopbuy',[ShopController::class,'shopbuy'])->name('shopbuy');
Route::post('/chooseclass',[GeneratePlayerStats::class,'submitplayerclass'])->name('ChooseClass');
Route::post('/playerprofile',[ItemsController::class,'ManageItems'])->name('ManageItems');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
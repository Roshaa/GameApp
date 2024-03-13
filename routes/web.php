<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\GeneratePlayerStats;
use App\Http\Controllers\PlayerMenusController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {return view('welcome');});
Route::get('/dashboard', function () {return redirect('playerprofile');}); 
Route::get('/profile', function () {return view('profile.edit');});
Route::get('/chooseclass', [PlayerMenusController::class,'chooseclass'])->name('chooseclass');

//Retorna os mobs que existem na db para esta view que permite uma escolha de 1 a 3
Route::get('/playermissions', [PlayerMenusController::class,'missionsmobs'])->middleware(['auth', 'verified'])->name('playermissions');

//Retorna a view playerprofile perante uma funcao da class generateplayerstats que dá os valores dos stats do jogador
Route::get('/playerprofile', [GeneratePlayerStats::class, 'returnprofilewithstats'])->middleware(['auth', 'verified'])->name('playerprofile');
Route::get('/playershop', [PlayerMenusController::class, 'returnshopinfo'])->middleware(['auth', 'verified'])->name('playershop');

//Apenas para testes
Route::get('/devpage', function () {

    $user_id= Auth::user()->id;

    return view('devpage', ['users' => User::get()], ['displayid'=> $user_id]);
    
})->middleware(['auth', 'verified'])->name('devpage');


//Escolha nas missions recebe o post(escolha de 1 a 3) e faz o combate
//Necessário solucao para evitar multiplos clicks na form
Route::post('/playermissions',[PlayerMenusController::class,'returncombatview'])->name('CombatResult');

//Post quando o utilizador escolhe a class -> route chooseclass
Route::post('/chooseclass',[GeneratePlayerStats::class,'submitplayerclass'])->name('ChooseClass');
Route::post('/playerprofile',[ItemsController::class,'ManageItems'])->name('ManageItems');



//laravel default
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
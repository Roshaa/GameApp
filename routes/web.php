<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GeneratePlayerStats;
use App\Http\Controllers\CombatPVE;
use App\Http\Controllers\PlayerMenusController;


use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\playerinventory;
use App\Models\UserCharacter;

use App\Http\Requests\MissionOptionRequest;
use App\Http\Requests\ChooseClassRequest;

//possivelmente mover para outro sitio
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//

Route::get('/', function () {return view('welcome');});
Route::get('/dashboard', function () {return redirect('playerprofile');}); 
Route::get('/profile', function () {return view('profile.edit');});
Route::get('/combatresult', function () {return view('combatresult');})->name('combatresult');
Route::get('/chooseclass', [PlayerMenusController::class,'chooseclass'])->name('chooseclass');

//Retorna os mobs que existem na db para esta view que permite uma escolha de 1 a 3
Route::get('/playermissions', [PlayerMenusController::class,'missionsmobs'])->middleware(['auth', 'verified'])->name('playermissions');

//Retorna a view playerprofile perante uma funcao da class generateplayerstats que dá os valores dos stats do jogador
Route::get('/playerprofile', [GeneratePlayerStats::class, 'returnprofilewithstats'])->middleware(['auth', 'verified'])->name('playerprofile');

//Apenas para testes
Route::get('/devpage', function () {

    $user_id= Auth::user()->id;

    return view('devpage', ['users' => User::get()], ['displayid'=> $user_id]);
    
})->middleware(['auth', 'verified'])->name('devpage');

//Escolha nas missions recebe o post(escolha de 1 a 3) e faz o combate
//Necessário solucao para evitar multiplos clicks na form
Route::post('/combatresult',[PlayerMenusController::class,'returncombatview'])->name('combatresult');

//Post quando o utilizador escolhe a class -> route chooseclass
Route::post('/chooseclass',[GeneratePlayerStats::class,'submitplayerclass'])->name('chooseclass');
Route::post('/playerprofile',[GeneratePlayerStats::class,'equipitem'])->name('equipitem');



//laravel default
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
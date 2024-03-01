<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GeneratePlayerStats;
use App\Http\Controllers\CombatPVE;
use App\Http\Controllers\InventoryController;

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





//Class para o utilizador escolher, caso ja tenha escolhido redireciona para a sua profile
Route::get('/chooseclass', function () {
    $user_id= Auth::user()->id;
    $class = DB::table('user_characters')->where('user_id','=', $user_id)->value('class');
    if($class!= ''){return redirect()->route('playerprofile');}
    return view('chooseclass');
});

//Retorna os mobs que existem na db para esta view que permite uma escolha de 1 a 3
Route::get('/playermissions', function () {

    $mobs=DB::table('mobsmissions')->get();
    return view('playermissions', ['mobs'=> $mobs]);
})->middleware(['auth', 'verified'])->name('playermissions');


//Retorna a view playerprofile perante uma funcao da class generateplayerstats que dá os valores dos stats do jogador
Route::get('/playerprofile', [GeneratePlayerStats::class, 'returnprofilewithstats'])->middleware(['auth', 'verified'])->name('playerprofile');

Route::get('/devpage', function () {

    $user_id= Auth::user()->id;

    return view('devpage', ['users' => User::get()], ['displayid'=> $user_id]);
    
})->middleware(['auth', 'verified'])->name('devpage');

//Escolha nas missions recebe o post(escolha de 1 a 3) e faz o combate
//Necessário solucao para evitar multiplos clicks na form
Route::post('/combatresult',function(MissionOptionRequest $request){

    $optionvalue=$request->option;
    $combatinfo=CombatPVE::combat($optionvalue);

    extract($combatinfo);

    return view(
        'combatresult',
        [
            'class' => "$class",
            'mobimg' => "$mobimg",
            'playermissinghp'=>"$playermissinghp",
            'mobmissinghp'=>"$mobmissinghp",
        ]
    );

})->name('missions.option');



//Post quando o utilizador escolhe a class -> route chooseclass
Route::post('/chooseclass',function(ChooseClassRequest $request){

    $optionvalue=$request->Class;
    $user_id= Auth::user()->id;


    $UserChar=$request->validated();

    $UserChar = new UserCharacter;
    $UserChar->user_id= $user_id;
    $UserChar->class=$optionvalue;
    $UserChar->level=1;

    $UserChar->save();

    $playerinventory = new playerinventory;
    $playerinventory->user_id= $user_id;  
    $playerinventory->save();

    return redirect()->route('playerprofile');

})->name('chooseclass');



//laravel default
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
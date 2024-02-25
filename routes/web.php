<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GeneratePlayerStats;
use App\Http\Controllers\CombatPVE;

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Items;
use App\Models\UserCharacter;

use App\Http\Requests\MissionOptionRequest;
use App\Http\Requests\ChooseClassRequest;

//possivelmente mover para outro sitio
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//




Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return redirect('playerprofile');
}); 
Route::get('/profile', function () {
    return view('profile.edit');
});
Route::get('/combatresult', function () {
    return view('combatresult');
})->name('combatresult');
Route::get('/chooseclass', function () {
    $user_id= Auth::user()->id;
    $class = DB::table('user_characters')->where('user_id','=', $user_id)->value('class');
    if($class!= ''){return redirect()->route('playerprofile');}
    return view('chooseclass');
});





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

//Player mission e insere item se for concluida
Route::post('/combatresult',function(MissionOptionRequest $request){

    $optionvalue=$request->option;
    $combatinfo=CombatPVE::combat($optionvalue);

    extract($combatinfo);
    
    /*
    $user_id= Auth::user()->id;

    $Items=$request->validated();

    $Items = new Items;
    $Items->itemname='item insert teste';
    $Items->user_owner_id=$user_id;
    $Items->stat1=1;
    $Items->stat2=2;

    $Items->save();*/

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



//Post para o utilizador escolher a class
Route::post('/chooseclass',function(ChooseClassRequest $request){

    $optionvalue=$request->Class;
    $user_id= Auth::user()->id;


    $UserChar=$request->validated();

    $UserChar = new UserCharacter;
    $UserChar->user_id= $user_id;
    $UserChar->class=$optionvalue;
    $UserChar->level=1;

    $UserChar->save();

    return redirect()->route('playerprofile');

})->name('chooseclass');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
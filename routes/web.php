<?php

use App\Http\Controllers\Class_stats;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GeneratePlayerStats;

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Items;
use App\Models\UserCharacter;

use App\Http\Requests\MissionOptionRequest;
use App\Http\Requests\ChooseClassRequest;
use Illuminate\Http\Request;

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
Route::get('/chooseclass', function () {
    return view('chooseclass');
});





Route::get('/playermissions', function () {
    return view('playermissions');
})->middleware(['auth', 'verified'])->name('playermissions');


//Faz uma querie perante o utilizador com login e retorna uma view perante os dados
Route::get('/playerprofile', function () {



    $user_id= Auth::user()->id;
    
    $playername= DB::table('USERS')->where('id','=', $user_id)->value('name');
    $class = DB::table('user_characters')->where('user_id','=', $user_id)->value('class');

    $getstats = GeneratePlayerStats::generatestats();

    $mainstat= $getstats[0];
    $Willpower= $getstats[1];
    $Constituion= $getstats[2];
    $Expertise= $getstats[3];
    $Resistance= $getstats[4];
    $Mastery= $getstats[5];
    $Alchemy= $getstats[6];
    $Armoursmith= $getstats[7];
    $Weaponsmith= $getstats[8];
    $Jewellery= $getstats[9];
    $Librarian= $getstats[10];

    return view('playerprofile', [
    'class'=> $class
    ,'playername'=> $playername
    ,'mainstat'=> $mainstat 
    ,'Willpower'=> $Willpower
    ,'Constituion'=> $Constituion
    ,'Expertise'=> $Expertise
    ,'Resistance'=> $Resistance
    ,'Mastery'=> $Mastery
    ,'Alchemy'=> $Alchemy
    ,'Armoursmith'=> $Armoursmith
    ,'Weaponsmith'=> $Weaponsmith
    ,'Jewellery'=> $Jewellery
    ,'Librarian'=> $Librarian
    ]

);


})->middleware(['auth', 'verified'])->name('playerprofile');

















Route::get('/devpage', function () {

    $user_id= Auth::user()->id;

    return view('devpage', ['users' => User::get()], ['displayid'=> $user_id]);
    
})->middleware(['auth', 'verified'])->name('devpage');



//Player mission e insere item se for concluida
Route::post('/playermissions',function(MissionOptionRequest $request){


    $optionvalue=$request->option;
    $user_id= Auth::user()->id;

    $Items=$request->validated();

    $Items = new Items;
    $Items->itemname='item insert teste';
    $Items->user_owner_id=$user_id;
    $Items->stat1=1;
    $Items->stat2=2;

    $Items->save();

    return redirect()->route('playermissions')->with('missionresult',$optionvalue);

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

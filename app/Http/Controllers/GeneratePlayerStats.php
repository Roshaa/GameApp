<?php  
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GeneratePlayerStats extends Controller
{

public static function generatestats(){

    $user_id= Auth::user()->id;
    
    $playername= DB::table('USERS')->where('id','=', $user_id)->value('name');
    $class = DB::table('user_characters')->where('user_id','=', $user_id)->value('class');

    //basestats

    $statsarray=[

    //mainstat
    20,
    //Willpower
    0,
    //Constituion
    5,
    //Expertise
    10,
    //Resistance
    5,
    //Mastery
    0,

    //Alchemy
    0,
    //Armoursmith
    0,
    //Weaponsmith
    0,
    //Jewelrery
    0,
    //Librarian
    0,
    ];

    return $statsarray;
}


}
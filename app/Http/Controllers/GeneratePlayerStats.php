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

    switch ($class) {
        //stats base de cada classe
        case 'Assassin':
            
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
                //BaseHP
                120,
                //BaseDamage
                30
                ];

            break;
            case 'Paladin':
            
                $statsarray=[
    
                    //mainstat
                    20,
                    //Willpower
                    5,
                    //Constituion
                    10,
                    //Expertise
                    0,
                    //Resistance
                    10,
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
                    //BaseHP
                    200,
                    //BaseDamage
                    20
                    ];
    
                break;
                case 'Warlock':
            
                    $statsarray=[
        
                        //mainstat
                        20,
                        //Willpower
                        10,
                        //Constituion
                        0,
                        //Expertise
                        10,
                        //Resistance
                        0,
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
                        //BaseHP
                        80,
                        //BaseDamage
                        40
                        ];
        
                    break;
        
        default:
            # code...
            break;
    }

    return $statsarray;
    
}
public function returnprofilewithstats(){
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

    //Estes valores já não são o base e terão que ser atualizados perante os items equipados,talentos,efeitos especiais etc
    $hp= $getstats[11];
    $damage= $getstats[12];

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
    ,'hp'=> $hp
    ,'damage'=> $damage
    ]
    );
}


}
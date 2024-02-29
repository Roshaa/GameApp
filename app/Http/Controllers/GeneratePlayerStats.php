<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PlayerInventory;


class GeneratePlayerStats extends Controller
{

    public static function GenerateStats()
    {

        $user_id = Auth::user()->id;
        $class = DB::table('user_characters')->where('user_id', '=', $user_id)->value('class');
        $level = DB::table('user_characters')->where('user_id', '=', $user_id)->value('level');

        switch ($class) {
            //stats base de cada classe
            case 'Assassin':

                $statsarray = [

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
                    200,
                    //BaseDamage
                    30
                ];

                break;
            case 'Paladin':

                $statsarray = [

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
                    360,
                    //BaseDamage
                    20
                ];

                break;
            case 'Warlock':

                $statsarray = [

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
                    140,
                    //BaseDamage
                    40
                ];

                break;
        }

        //Estes valores já não são o base e terão que ser atualizados perante os items equipados,talentos,efeitos especiais etc

        $mainstat = $statsarray[0];
        $Willpower = $statsarray[1];
        $Constituion = $statsarray[2];
        $Expertise = $statsarray[3];
        $Resistance = $statsarray[4];
        $Mastery = $statsarray[5];

        $Alchemy = $statsarray[6];
        $Armoursmith = $statsarray[7];
        $Weaponsmith = $statsarray[8];
        $Jewellery = $statsarray[9];
        $Librarian = $statsarray[10];


        //Isto retorna os verdadeiros valores do jogador perante a class,nivel,talentos,equipamento etc
        switch ($class) {
            
            //Cada classe tem propriedades unicas e valores unicos portanto para ja fica assim em switches
            //No futuro cada Classe podera ter a sua class em codigo
            case 'Assassin':
            
                $hp = $statsarray[11] + ($level * 10 + $Constituion * 5);
                $damage = $statsarray[12]+$mainstat/2;
                $skilldamage=100+$Willpower+($Mastery/3);

                $damagereduction= $Resistance+($Mastery/3)/$level;
                
                //Critical strike for assassin
                //Base 20%
                $ClassSpecial = 20+$Expertise+($Mastery/3)/$level;

                $truestats=[

                'mainstat'=>$mainstat,
                'Willpower'=>$Willpower,
                'Constituion'=>$Constituion,
                'Expertise'=>$Expertise,
                'Resistance'=>$Resistance,
                'Mastery'=>$Mastery,
                'Alchemy'=>$Alchemy,
                'Armoursmith'=>$Armoursmith,
                'Weaponsmith'=>$Weaponsmith,
                'Jewellery'=>$Jewellery,
                'Librarian'=>$Librarian,
                'hp'=>$hp,
                'damage'=>$damage,
                'skilldamage'=>$skilldamage,
                'damagereduction'=>$damagereduction,
                'ClassSpecial'=>$ClassSpecial

                ];
                break;
            case 'Paladin':

                $hp = $statsarray[11] + ($level * 10 + $Constituion * 5);
                $damage = $statsarray[12]+$mainstat/2;
                $skilldamage=100+$Willpower+($Mastery/3);

                $damagereduction= $Resistance+($Mastery/3)/$level;
                
                //Self Heal Paladin
                //Base 1%
                $ClassSpecial = 1+($Expertise+($Mastery/3)/20)-($level*0.05);

                $truestats=[

                'mainstat'=>$mainstat,
                'Willpower'=>$Willpower,
                'Constituion'=>$Constituion,
                'Expertise'=>$Expertise,
                'Resistance'=>$Resistance,
                'Mastery'=>$Mastery,
                'Alchemy'=>$Alchemy,
                'Armoursmith'=>$Armoursmith,
                'Weaponsmith'=>$Weaponsmith,
                'Jewellery'=>$Jewellery,
                'Librarian'=>$Librarian,
                'hp'=>$hp,
                'damage'=>$damage,
                'skilldamage'=>$skilldamage,
                'damagereduction'=>$damagereduction,
                'ClassSpecial'=>$ClassSpecial

                ];

                break;
            case 'Warlock':

                $hp = $statsarray[11] + ($level * 10 + $Constituion * 5);
                $damage = $statsarray[12]+$mainstat/2;
                $skilldamage=100+$Willpower+($Mastery/3);

                $damagereduction= $Resistance+($Mastery/3)/$level;
                
                //Mana
                //Base 100
                $ClassSpecial = 100+(($Expertise+($Mastery/3))*3)/$level;

                $truestats=[

                'mainstat'=>$mainstat,
                'Willpower'=>$Willpower,
                'Constituion'=>$Constituion,
                'Expertise'=>$Expertise,
                'Resistance'=>$Resistance,
                'Mastery'=>$Mastery,
                'Alchemy'=>$Alchemy,
                'Armoursmith'=>$Armoursmith,
                'Weaponsmith'=>$Weaponsmith,
                'Jewellery'=>$Jewellery,
                'Librarian'=>$Librarian,
                'hp'=>$hp,
                'damage'=>$damage,
                'skilldamage'=>$skilldamage,
                'damagereduction'=>$damagereduction,
                'ClassSpecial'=>$ClassSpecial

                ];

                break;
        }


        return $truestats;
    }
    public static function returnprofilewithstats()
    {
        $user_id = Auth::user()->id;

        $playername = DB::table('USERS')->where('id', '=', $user_id)->value('name');
        $class = DB::table('user_characters')->where('user_id', '=', $user_id)->value('class');
        $GetStats = GeneratePlayerStats::GenerateStats();


        $InventoryInfo = PlayerInventory::find($user_id);
        //Pode ser util para obter os valores dos items equipados
        $teste=$InventoryInfo->bagslot1;
        


        
        return view(
            'playerprofile',
            [
                'class' => $class,
                'playername' => $playername,
                'InventoryInfo'=>$InventoryInfo,
                'GetStats'=>$GetStats
            ]
        );
    }
}

<?php  
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\Items;
use App\Models\UserCharacter;

class ItemGeneration extends Controller
{

public static function missionitemgeneration(){

    $user_id = Auth::user()->id;
    $class = UserCharacter::where('user_id', '=', $user_id)->value('class');
    $level = UserCharacter::where('user_id', '=', $user_id)->value('level');

//1 common, 2 uncommon, 3 rare, 4 epic
        //controlar com mob tier no futuro
        $itemrarityroll = rand(0, 99);
        switch ($itemrarityroll) {
            case $itemrarityroll <= 50:
                $itemrarityroll = 'common';
                break;

            case $itemrarityroll > 51 && $itemrarityroll < 80:
                $itemrarityroll = 'uncommon';
                break;

            case $itemrarityroll > 81 && $itemrarityroll < 95:
                $itemrarityroll = 'rare';
                break;

            case $itemrarityroll >= 95:
                $itemrarityroll = 'epic';
                break;
        }


        //é necessario controlar o item generation perante o tipo de item, no momento que isto esta a ser escrito só da para generar armor
        function getrandomstatvalue($level) {
            return rand($level * 3.5, $level * 6);
        }
        $getrandomarmorvalue = rand($level * 30, $level * 50);
        $getrandomarmortype = rand(1, 4);




        /*
            stat 1 -> main stat
            stat 2 -> Willpower
            stat 3 -> Constituion
            stat 4 -> Expertise
            stat 5 -> Resistance
            stat 6 -> Mastery
        */


        //necessario optimizar depois
        $randomstatsarray= [2,3,4,5,6];
        $getrandomstattofill1=$randomstatsarray[rand(0,4)];
        $getrandomstattofill2=$randomstatsarray[rand(0,4)];
        while ($getrandomstattofill2==$getrandomstattofill1){
            $getrandomstattofill2=$randomstatsarray[rand(0,4)];
        }
        $getrandomstattofill3=$randomstatsarray[rand(0,4)];
        while ($getrandomstattofill3==$getrandomstattofill2){
            $getrandomstattofill3=$randomstatsarray[rand(0,4)];
        }

        $dbrandomstatstring1 ='stat'.strval($getrandomstattofill1);
        $dbrandomstatstring2 ='stat'.strval($getrandomstattofill2);
        $dbrandomstatstring3 ='stat'.strval($getrandomstattofill3);



        switch ($getrandomarmortype) {
            case $getrandomarmortype == 1:
                $armortype = 'Head';
                break;
            case $getrandomarmortype == 2:
                $armortype = 'Chest';
                break;
            case $getrandomarmortype == 3:
                $armortype = 'Gloves';
                break;
            case $getrandomarmortype == 4:
                $armortype = 'Boots';
                break;
        }

        $Items =new Items;
        $Items->user_owner_id = $user_id;
        $Items->itemname = 'NoName';



        switch ($itemrarityroll) {
            case $itemrarityroll == 'common':

                $Items->armor = $getrandomarmorvalue;
                $Items->stat1 = getrandomstatvalue($level);
                $Items->type=$armortype;
                $Items->rarity=$itemrarityroll;

                break;
            case $itemrarityroll == 'uncommon':

                $Items->armor = $getrandomarmorvalue;
                $Items->stat1 = getrandomstatvalue($level);
                $Items->$dbrandomstatstring1=getrandomstatvalue($level);
                $Items->type=$armortype;
                $Items->rarity=$itemrarityroll;

                break;
            case $itemrarityroll == 'rare':

                $Items->armor = $getrandomarmorvalue;
                $Items->stat1 = getrandomstatvalue($level);
                $Items->$dbrandomstatstring1=getrandomstatvalue($level);
                $Items->$dbrandomstatstring2=getrandomstatvalue($level);
                $Items->type=$armortype;
                $Items->rarity=$itemrarityroll;

                break;
            case $itemrarityroll == 'epic':

                $Items->armor = $getrandomarmorvalue;
                $Items->stat1 = getrandomstatvalue($level);
                $Items->$dbrandomstatstring1=getrandomstatvalue($level);
                $Items->$dbrandomstatstring2=getrandomstatvalue($level);
                $Items->$dbrandomstatstring3=getrandomstatvalue($level);

                $Items->type=$armortype;
                $Items->rarity=$itemrarityroll;
                break;
        }


        
        

        $Items->save();
    }
}
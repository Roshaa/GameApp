<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ItemsController;
use App\Models\PlayerInventory;
use App\Models\Items;
use App\Http\Requests\ChooseClassRequest;
use App\Models\UserCharacter;


class GeneratePlayerStats extends Controller
{

    public static function GenerateStats()
    {

        $user_id = Auth::user()->id;
        $class = DB::table('user_characters')->where('id', '=', $user_id)->value('class');
        $level = DB::table('user_characters')->where('id', '=', $user_id)->value('level');

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
                    500,
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
                    700,
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
                    400,
                    //BaseDamage
                    80
                ];

                break;
        }

        //Estes valores já não são o base e terão que ser atualizados perante os items equipados,talentos,efeitos especiais etc
        $valuefromitems = ItemsController::GenerateStatsFromItems();


        $mainstat = $statsarray[0]+$valuefromitems['stat1'];
        $Willpower = $statsarray[1]+$valuefromitems['stat2'];
        $Constituion = $statsarray[2]+$valuefromitems['stat3'];
        $Expertise = $statsarray[3]+$valuefromitems['stat4'];
        $Resistance = $statsarray[4]+$valuefromitems['stat5'];
        $Mastery = $statsarray[5]+$valuefromitems['stat6'];

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

                $hp = $statsarray[11] + ($level * 50 + $Constituion * 8);
                $damage = $statsarray[12]+($valuefromitems['damage']*1.1) + $mainstat / 2;
                $skilldamage = 100 + $Willpower + ($Mastery / 3);
                $armor= $valuefromitems['armor'];

                $damagereduction = ($Resistance + $armor + ($Mastery / 3) *0.3)/6;

                //Critical strike for assassin
                //Base 20%
                $ClassSpecial = 20 + ($Expertise+($Mastery / 3) )/($level/2);

                break;
            case 'Paladin':

                $hp = $statsarray[11] + ($level * 80 + $Constituion * 10);
                $damage = $statsarray[12]+($valuefromitems['damage']*0.8) + $mainstat / 2;
                $skilldamage = 100 + $Willpower + ($Mastery / 3);
                $armor= $valuefromitems['armor']*1.2;

                $damagereduction = ($Resistance + $armor + ($Mastery / 3) *0.3)/6;

                //Self Heal Paladin
                //Base 1%
                $ClassSpecial = 1 + ($Expertise + ($Mastery / 3) )/ 50 - ($level * 0.05);

                break;
            case 'Warlock':

                $hp = $statsarray[11] + ($level * 40 + $Constituion * 7);
                $damage = $statsarray[12] +($valuefromitems['damage']*1.5)+ $mainstat / 2;
                $skilldamage = 100 + $Willpower + ($Mastery / 3);
                $armor= $valuefromitems['armor']*0.8;

                $damagereduction = ($Resistance + $armor + ($Mastery / 3) *0.3)/6;

                //Mana
                //Base 100
                $ClassSpecial = 100 + (($Expertise + ($Mastery / 3)) * 3) / $level;

                break;
        }

        $truestats = [

            'mainstat' => number_format($mainstat,0),
            'Willpower' => number_format($Willpower,0),
            'Constituion' => number_format($Constituion,0),
            'Expertise' => number_format($Expertise,0),
            'Resistance' => number_format($Resistance,0),
            'Mastery' => number_format($Mastery,0),
            'Alchemy' => number_format($Alchemy,0),
            'Armoursmith' => number_format($Armoursmith,0),
            'Weaponsmith' => number_format($Weaponsmith,0),
            'Jewellery' => number_format($Jewellery,0),
            'Librarian' => number_format($Librarian,0),
            'hp' => number_format($hp,0),
            'damage' => number_format($damage,2),
            'skilldamage' => number_format($skilldamage,2),
            'damagereduction' => number_format($damagereduction,2),
            'ClassSpecial' => number_format($ClassSpecial,2),
            'armor'=>number_format($armor,0)

        ];


        return $truestats;
    }
    //Recebe valores bases das classes mais os itens e obtem os valores para colocar na playerprofile
    public static function returnprofilewithstats()
    {
        $user_id = Auth::user()->id;

        $playername = DB::table('USERS')->where('id', '=', $user_id)->value('name');
        $class = DB::table('user_characters')->where('id', '=', $user_id)->value('class');
        $level = UserCharacter::where('id', '=', $user_id)->value('level');
        $GetStats = GeneratePlayerStats::GenerateStats();

        $Inventoryid = PlayerInventory::where('user_id', '=', $user_id)->value('id');
        $InventoryInfo = PlayerInventory::find($Inventoryid);

        $BagItemsArray = [];
        $BagSlots=0;

        for ($i = 0; $i <= 10; $i++) {

            $bagslot = 'bagslot' . strval($i);
            $ItemId = $InventoryInfo->$bagslot;
            if($ItemId!=''){
                $BagSlots++;
            }
            $ItemInfo = Items::find($ItemId);
            array_push($BagItemsArray, $ItemInfo);
        };

        $EquipItemsArray = [];

        for ($i = 0; $i <= 15; $i++) {

            $bagslot = 'equipslot' . strval($i);
            $ItemId = $InventoryInfo->$bagslot;
            $ItemInfo = Items::find($ItemId);
            array_push($EquipItemsArray, $ItemInfo);
        };

        return view(
            'playerprofile',
            [
                'class' => $class,
                'playername' => $playername,
                'level'=>$level,
                'GetStats' => $GetStats,
                'BagItemsArray' => $BagItemsArray,
                'EquipItemsArray'=>$EquipItemsArray,
                'BagSlots'=>$BagSlots
                ]
        );
    }

    //Recebe o post de quando se escolhe a class na view chooseclass
    public static function submitplayerclass(ChooseClassRequest $request)
    {
        $optionvalue = $request->Class;
        $user_id = Auth::user()->id;


        $UserChar = $request->validated();

        $UserChar = new UserCharacter;
        $UserChar->user_id = $user_id;
        $UserChar->class = $optionvalue;
        $UserChar->level = 1;
        $UserChar->currentlxlexp = 0;
        $UserChar->exptonextlevel = 5000;

        $UserChar->save();

        $playerinventory = new playerinventory;
        $playerinventory->user_id = $user_id;
        $playerinventory->save();

        return redirect()->route('playerprofile');
    }

}

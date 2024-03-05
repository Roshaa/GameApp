<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PlayerInventory;
use App\Models\Items;
use App\Http\Requests\ChooseClassRequest;
use App\Http\Requests\InventoryItemsRequest;
use App\Models\UserCharacter;


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
                $damage = $statsarray[12] + $mainstat / 2;
                $skilldamage = 100 + $Willpower + ($Mastery / 3);

                $damagereduction = $Resistance + ($Mastery / 3) / $level;

                //Critical strike for assassin
                //Base 20%
                $ClassSpecial = 20 + $Expertise + ($Mastery / 3) / $level;

                $truestats = [

                    'mainstat' => $mainstat,
                    'Willpower' => $Willpower,
                    'Constituion' => $Constituion,
                    'Expertise' => $Expertise,
                    'Resistance' => $Resistance,
                    'Mastery' => $Mastery,
                    'Alchemy' => $Alchemy,
                    'Armoursmith' => $Armoursmith,
                    'Weaponsmith' => $Weaponsmith,
                    'Jewellery' => $Jewellery,
                    'Librarian' => $Librarian,
                    'hp' => $hp,
                    'damage' => $damage,
                    'skilldamage' => $skilldamage,
                    'damagereduction' => $damagereduction,
                    'ClassSpecial' => $ClassSpecial

                ];
                break;
            case 'Paladin':

                $hp = $statsarray[11] + ($level * 10 + $Constituion * 5);
                $damage = $statsarray[12] + $mainstat / 2;
                $skilldamage = 100 + $Willpower + ($Mastery / 3);

                $damagereduction = $Resistance + ($Mastery / 3) / $level;

                //Self Heal Paladin
                //Base 1%
                $ClassSpecial = 1 + ($Expertise + ($Mastery / 3) / 20) - ($level * 0.05);

                $truestats = [

                    'mainstat' => $mainstat,
                    'Willpower' => $Willpower,
                    'Constituion' => $Constituion,
                    'Expertise' => $Expertise,
                    'Resistance' => $Resistance,
                    'Mastery' => $Mastery,
                    'Alchemy' => $Alchemy,
                    'Armoursmith' => $Armoursmith,
                    'Weaponsmith' => $Weaponsmith,
                    'Jewellery' => $Jewellery,
                    'Librarian' => $Librarian,
                    'hp' => $hp,
                    'damage' => $damage,
                    'skilldamage' => $skilldamage,
                    'damagereduction' => $damagereduction,
                    'ClassSpecial' => $ClassSpecial

                ];

                break;
            case 'Warlock':

                $hp = $statsarray[11] + ($level * 10 + $Constituion * 5);
                $damage = $statsarray[12] + $mainstat / 2;
                $skilldamage = 100 + $Willpower + ($Mastery / 3);

                $damagereduction = $Resistance + ($Mastery / 3) / $level;

                //Mana
                //Base 100
                $ClassSpecial = 100 + (($Expertise + ($Mastery / 3)) * 3) / $level;

                $truestats = [

                    'mainstat' => $mainstat,
                    'Willpower' => $Willpower,
                    'Constituion' => $Constituion,
                    'Expertise' => $Expertise,
                    'Resistance' => $Resistance,
                    'Mastery' => $Mastery,
                    'Alchemy' => $Alchemy,
                    'Armoursmith' => $Armoursmith,
                    'Weaponsmith' => $Weaponsmith,
                    'Jewellery' => $Jewellery,
                    'Librarian' => $Librarian,
                    'hp' => $hp,
                    'damage' => $damage,
                    'skilldamage' => $skilldamage,
                    'damagereduction' => $damagereduction,
                    'ClassSpecial' => $ClassSpecial

                ];

                break;
        }


        return $truestats;
    }
    //Recebe valores bases das classes mais os itens e obtem os valores para colocar na playerprofile
    public static function returnprofilewithstats()
    {
        $user_id = Auth::user()->id;

        $playername = DB::table('USERS')->where('id', '=', $user_id)->value('name');
        $class = DB::table('user_characters')->where('user_id', '=', $user_id)->value('class');
        $GetStats = GeneratePlayerStats::GenerateStats();

        $Inventoryid = PlayerInventory::where('user_id', '=', $user_id)->value('id');
        $InventoryInfo = PlayerInventory::find($Inventoryid);

        $BagItemsArray = [];

        for ($i = 0; $i <= 10; $i++) {

            $bagslot = 'bagslot' . strval($i);
            $ItemId = $InventoryInfo->$bagslot;
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

        //POSSIVELMENTE ALTERAR DEPOIS AS VARIAVEIS DAS BAGSLOTSINFO

        return view(
            'playerprofile',
            [
                'class' => $class,
                'playername' => $playername,
                'GetStats' => $GetStats,
                'BagItemsArray' => $BagItemsArray,
                'EquipItemsArray'=>$EquipItemsArray            ]
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

        $UserChar->save();

        $playerinventory = new playerinventory;
        $playerinventory->user_id = $user_id;
        $playerinventory->save();

        return redirect()->route('playerprofile');
    }

    public static function verifyavailablebagslot()
    {
        for ($i = 1; $i <= 10; $i++) {

            $user_id = Auth::user()->id;
            $bagslotstring = 'bagslot' . strval($i);
            $verifyempty = PlayerInventory::where('user_id', '=', $user_id)->value($bagslotstring);

            if ($verifyempty == '') {
                return $bagslotstring;
            }

            if ($verifyempty != '' && $i == 10) {
                return $bagslotstring = 'FullBag';
            }
        }
    }
    public static function ManageItems(InventoryItemsRequest $request)
    {

        $user_id = Auth::user()->id;
        $Inventoryid = PlayerInventory::where('user_id', '=', $user_id)->value('id');
        $playerinventory = PlayerInventory::find($Inventoryid);

        if(isset($request->Delete)) {   

            $chosenitem=$request->Delete;
            $deleteitem= Items::find($chosenitem);
    
            for ($i = 1; $i <= 10; $i++) {
    
                $bagslotstring = 'bagslot' . strval($i);
                $verifybag = PlayerInventory::where('user_id', '=', $user_id)->value($bagslotstring);
    
                if ($verifybag == $chosenitem) {
                    $playerinventory->$bagslotstring=null;
                }
    
            }
    
            $playerinventory->save();
            echo $deleteitem;
            $deleteitem->delete();
    
            return redirect()->route('playerprofile');

        }else{

            $itemtoequip=$request->Equip;
            $verifyownership=Items::where('user_owner_id', '=', $user_id)->value('user_owner_id');
            $itemtype = Items::where('id', '=', $itemtoequip)->value('type');
    
            if ($user_id == $verifyownership) {
    
                switch ($itemtype) {
                    case 'Head':
                        $replaceitem=$playerinventory->equipslot1;
                        $playerinventory->equipslot1 = $itemtoequip;
                        break;
                    case 'Chest':
                        $replaceitem=$playerinventory->equipslot2;
                        $playerinventory->equipslot2 = $itemtoequip;
                        break;
                    case 'Gloves':
                        $replaceitem=$playerinventory->equipslot3;
                        $playerinventory->equipslot3 = $itemtoequip;
                        break;
                    case 'Boots':
                        $replaceitem=$playerinventory->equipslot4;
                        $playerinventory->equipslot4 = $itemtoequip;
                        break;
                    case 'Weapon':
                        $replaceitem=$playerinventory->equipslot5;
                        $playerinventory->equipslot5 = $itemtoequip;
                        break;
                    case 'ProfessionTool':
    
                        for ($i = 6; $i <= 7; $i++) {
    
                            $user_id = Auth::user()->id;
                            $equipslot = 'equipslot' . strval($i);
                            $verifyslot = PlayerInventory::where('user_id', '=', $user_id)->value($equipslot);
                
                            if ($verifyslot == '' && $verifyslot!=$itemtoequip) {
                                $replaceitem=$playerinventory->$equipslot;
                                $playerinventory->$equipslot = $itemtoequip;
                                break;
                            }
                        }
    
                        break;
                    case 'Ring':
    
                        for ($i = 8; $i <= 9; $i++) {
    
                            $user_id = Auth::user()->id;
                            $equipslot = 'equipslot' . strval($i);
                            $verifyslot = PlayerInventory::where('user_id', '=', $user_id)->value($equipslot);
                
                            if ($verifyslot == ''&& $verifyslot!=$itemtoequip) {
                                $replaceitem=$playerinventory->$equipslot;
                                $playerinventory->$equipslot = $itemtoequip;
                                break;
                            }
                        }
                        break;
                }
    
    
                for ($i = 1; $i <= 10; $i++) {
    
                    $bagslotstring = 'bagslot' . strval($i);
                    $verifybag = PlayerInventory::where('user_id', '=', $user_id)->value($bagslotstring);
        
                    if ($verifybag == $itemtoequip) {
                        $playerinventory->$bagslotstring=null;
                        if($replaceitem!=''){
                            $playerinventory->$bagslotstring=$replaceitem;
                        }
                    }
    
                }
    
                
    
    
                $playerinventory->save();
                return redirect()->route('playerprofile');
            }


        }



        
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\PlayerInventory;
use App\Models\Items;
use App\Http\Requests\InventoryItemsRequest;

class ItemsController extends Controller
{
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

        if (isset($request->Delete)) {

            $chosenitem = $request->Delete;
            $deleteitem = Items::find($chosenitem);

            for ($i = 1; $i <= 10; $i++) {

                $bagslotstring = 'bagslot' . strval($i);
                $verifybag = PlayerInventory::where('user_id', '=', $user_id)->value($bagslotstring);

                if ($verifybag == $chosenitem) {
                    $playerinventory->$bagslotstring = null;
                }
            }

            $playerinventory->save();
            $deleteitem->delete();

            return redirect()->route('playerprofile');

        }else if (isset($request->Unequip)){

            $itemtounequip=$request->Unequip;
            $returntoslot=ItemsController::verifyavailablebagslot();
    
            for ($i = 1; $i <= 15; $i++) {
    
                $equipslot = 'equipslot' . strval($i);
                $equipeditem = PlayerInventory::where($equipslot, '=', $itemtounequip)->value($equipslot);
                echo $equipeditem;
    
                if ($equipeditem == $itemtounequip) {
                    $playerinventory->$equipslot = null;
                    break;
                }
            }
    
            if($returntoslot=='FullBag'){
    
            }else{
                $playerinventory->$returntoslot= $itemtounequip;
                $playerinventory->save();    
            }
    
    
            
            return redirect()->route('playerprofile');

        }
        
        else {

            $itemtoequip = $request->Equip;
            $verifyownership = Items::where('user_owner_id', '=', $user_id)->value('user_owner_id');
            $itemtype = Items::where('id', '=', $itemtoequip)->value('type');

            if ($user_id == $verifyownership) {

                switch ($itemtype) {
                    case 'Head':
                        $replaceitem = $playerinventory->equipslot1;
                        $playerinventory->equipslot1 = $itemtoequip;
                        break;
                    case 'Chest':
                        $replaceitem = $playerinventory->equipslot2;
                        $playerinventory->equipslot2 = $itemtoequip;
                        break;
                    case 'Gloves':
                        $replaceitem = $playerinventory->equipslot3;
                        $playerinventory->equipslot3 = $itemtoequip;
                        break;
                    case 'Boots':
                        $replaceitem = $playerinventory->equipslot4;
                        $playerinventory->equipslot4 = $itemtoequip;
                        break;
                    case 'Weapon':
                        $replaceitem = $playerinventory->equipslot5;
                        $playerinventory->equipslot5 = $itemtoequip;
                        break;
                    case 'ProfessionTool':

                        for ($i = 6; $i <= 7; $i++) {

                            $user_id = Auth::user()->id;
                            $equipslot = 'equipslot' . strval($i);
                            $verifyslot = PlayerInventory::where('user_id', '=', $user_id)->value($equipslot);

                            if ($verifyslot == '' && $verifyslot != $itemtoequip) {
                                $replaceitem = $playerinventory->$equipslot;
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

                            if ($verifyslot == '' && $verifyslot != $itemtoequip) {
                                $replaceitem = $playerinventory->$equipslot;
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
                        $playerinventory->$bagslotstring = null;
                        if ($replaceitem != '') {
                            $playerinventory->$bagslotstring = $replaceitem;
                        }
                    }
                }

                $playerinventory->save();
                return redirect()->route('playerprofile');
            }
        }
    }

    public static function GenerateStatsFromItems()
    {


        $user_id = Auth::user()->id;
        $Inventoryid = PlayerInventory::where('user_id', '=', $user_id)->value('id');
        $playerinventory = PlayerInventory::find($Inventoryid);

        $mainstat = 0;
        $willpower = 0;
        $constituion = 0;
        $expertise = 0;
        $resistance = 0;
        $mastery = 0;
        $armor = 0;
        $damage = 0;


        for ($i = 1; $i <= 15; $i++) {

            $equipslot = 'equipslot' . strval($i);
            $getitemid = $playerinventory->$equipslot;
            $itemscan = Items::find($getitemid);

            if (isset($itemscan->stat1)) {
                $mainstat += $itemscan->stat1;
            }
            if (isset($itemscan->stat2)) {
                $willpower += $itemscan->stat2;
            }
            if (isset($itemscan->stat3)) {
                $constituion += $itemscan->stat3;
            }
            if (isset($itemscan->stat4)) {
                $expertise += $itemscan->stat4;
            }
            if (isset($itemscan->stat5)) {
                $resistance += $itemscan->stat5;
            }
            if (isset($itemscan->stat6)) {
                $mastery += $itemscan->stat6;
            }
            if (isset($itemscan->armor)) {
                $armor += $itemscan->armor;
            }
            if (isset($itemscan->damage)) {
                $damage += $itemscan->damage;
            }
        }

        $statsfromitems = [

            'stat1' => $mainstat,
            'stat2' => $willpower,
            'stat3' => $constituion,
            'stat4' => $expertise,
            'stat5' => $resistance,
            'stat6' => $mastery,
            'armor' => $armor,
            'damage' => $damage
            /*'se1' => $,
            'se2' => $,
            'se3' => $,
            'se4' => $*/

        ];


        return $statsfromitems;
    }
}

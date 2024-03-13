<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MissionOptionRequest;
use App\Models\UserCharacter;
use App\Models\player_shop;

class PlayerMenusController extends Controller
{
    //Retorna a view da chooseclass mas se já estiver uma class escolhida redireciona para o playerprofile
    public function chooseclass()
    {
        $user_id = Auth::user()->id;
        $class = DB::table('user_characters')->where('id', '=', $user_id)->value('class');
        if ($class != '') {
            return redirect()->route('playerprofile');
        }
        return view('chooseclass');
    }

    //Mostra os mobs possiveis de derrotar nas missoes
    public function missionsmobs()
    {
        $mobs = DB::table('mobsmissions')->get();
        return view('playermissions', ['mobs' => $mobs]);
    }

    //Mostra o resultado do combate nas missoes
    public function returncombatview(MissionOptionRequest $request)
    {

        $optionvalue = $request->option;
        $combatinfo = CombatPVE::combat($optionvalue);

        extract($combatinfo);

        return view(
            'playermissions',
            [
                'class' => "$class",
                'mobimg' => "$mobimg",
                'playermissinghp' => "$playermissinghp",
                'mobmissinghp' => "$mobmissinghp",
            ]
        );
    }
    public function returnshopinfo()
    {
        $user_id = Auth::user()->id;
        $CharInfo = UserCharacter::where('id', '=', $user_id)->get(); 
        $ShopInfo = player_shop::where('user_id', '=', $user_id)->get();


        

        return view(
            'playershop',
            [
                'CharInfo'=>$CharInfo   
            ]
        );
    }



}

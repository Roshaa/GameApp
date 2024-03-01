<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MissionOptionRequest;

class PlayerMenusController extends Controller
{
    //Retorna a view da chooseclass mas se já estiver uma class escolhida redireciona para o playerprofile
    public function chooseclass()
    {
        $user_id = Auth::user()->id;
        $class = DB::table('user_characters')->where('user_id', '=', $user_id)->value('class');
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
            'combatresult',
            [
                'class' => "$class",
                'mobimg' => "$mobimg",
                'playermissinghp' => "$playermissinghp",
                'mobmissinghp' => "$mobmissinghp",
            ]
        );
    }



}

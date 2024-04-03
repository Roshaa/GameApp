@extends('Layouts.app')
@section('pagecontent')

@isset($class)
<div class="flex w-full  bg-no-repeat bg-cover text-white"
style="background-image: url( 'images/playermissionresult.jpg'  );">
        <div class="w-1/12"></div>
        <div class="w-4/12 mx-5 mt-5 justify-center text-center">

            <img class="mx-auto"
                src="@switch($class)
@case('Assassin')
{{ 'images/assassinclass.jpg' }}
@break
@case('Paladin')
{{ 'images/paladinclass.jpg' }}
@break
@case('Warlock')
{{ 'images/warlockclass.jpg' }}
@break
@default    
@endswitch">
            <h2 class="border font-medium p-5 text-2xl mt-3">{{ $playermissinghp }}</h2>


        </div>

        <div class="w-4/12 mt-5 justify-center text-center">

            <img class="mx-auto" src="{{ $mobimg }}" alt="">
            <h2 class="border font-medium p-5 text-2xl mt-3">{{ $mobmissinghp }}</h2>

        </div>
        <div class="w-3/12 mt-5 justify-start font-semibold">
            @isset($combatlog)
            @foreach ($combatlog as $log)
                {{$log}}<br>
            @endforeach
            
            @endisset
            <div class="mt-3 pr-5">
                <p class="text-weight-bold">Item Reward</p>
                <div class="h-12 w-full border-b-2 flex">
                    <img class=""
                        src="
                    @switch($itemgenerated->type)
                    @case('Head')
                        {{ 'images/icons/elf-helmet.svg' }}
                    @break
                
                    @case('Chest')
                        {{ 'images/icons/chest-armor.svg' }}
                    @break
                
                    @case('Gloves')
                        {{ 'images/icons/gloves.svg' }}
                    @break
                
                    @case('Boots')
                        {{ 'images/icons/leg-armor.svg' }}
                    @break
                
                    @case('Weapon')
                        {{ 'images/icons/sword-wound.svg' }}
                    @break
                
                    @case('Ring')
                        {{ 'images/icons/ring.svg' }}
                    @break
                
                    @case('ProfessionTool')
                        {{ 'images/icons/anvil-impact.svg' }}
                    @break
                
                    @default
                @endswitch
                    "
                        alt="">
                    <button disabled class="ml-2 w-full text-left">



                        @if ($itemgenerated->stat1 != '')
                            @switch($class)
                                @case('Assassin')
                                    {{ 'DEX: ' }}
                                @break

                                @case('Paladin')
                                    {{ 'STR: ' }}
                                @break

                                @case('Warlock')
                                    {{ 'INT: ' }}
                                @break
                            @endswitch {{ $itemgenerated->stat1 }}
                        @endif
                        @if ($itemgenerated->stat2 != '')
                            WLP: {{ $itemgenerated->stat2 }}
                        @endif
                        @if ($itemgenerated->stat3 != '')
                            CON: {{ $itemgenerated->stat3 }}
                        @endif
                        @if ($itemgenerated->stat4 != '')
                            EXP: {{ $itemgenerated->stat4 }}
                        @endif
                        @if ($itemgenerated->stat5 != '')
                            RES: {{ $itemgenerated->stat5 }}
                        @endif
                        @if ($itemgenerated->stat6 != '')
                            MAS: {{ $itemgenerated->stat6 }}
                        @endif
                        @if ($itemgenerated->armor != '')
                            AR: {{ $itemgenerated->armor }}
                        @endif
                        @if ($itemgenerated->damage != '')
                            DAM: {{ $itemgenerated->damage }}
                        @endif
                        @if ($itemgenerated->specialeffect1 != '')
                            SE1: {{ $itemgenerated->specialeffect1 }}
                        @endif
                        @if ($itemgenerated->specialeffect2 != '')
                            SE2: {{ $itemgenerated->specialeffect2 }}
                        @endif
                        @if ($itemgenerated->specialeffect3 != '')
                            SE3: {{ $itemgenerated->specialeffect3 }}
                        @endif
                        @if ($itemgenerated->specialeffect4 != '')
                            SE4: {{ $itemgenerated->specialeffect4 }}
                        @endif
                        @if ($itemgenerated->rarity != '')
                            <span class="mr-5 float-end item{{ $itemgenerated->rarity }}">
                                {{ $itemgenerated->rarity }}</span>
                        @endif
                        @if ($itemgenerated->value != '')
                            <span class="mr-5 float-end">Value:
                                {{ $itemgenerated->value }}</span>
                        @endif
                </div>
            </div>
        </div>
        
    </div>
        @endisset

        

@isset($mobs)
<div class="flex w-full bg-opacity-25 bg-no-repeat bg-cover text-white"
style="background-image: url( 'images/campsite.jpg'  );">
    <form action="" method="post" class="flex justify-center w-full mt-10">
        @csrf
        <div class="flex">
            @foreach ($mobs as $mob)
                
                <div class="w-2/6 h-3/6 mx-2 text-center p-10" alt="">
                    <h3 class="mb-2">{{ $mob->MobName }}</h3>
                     <img class="opacity-80" src="{{ $mob->imglink }}">
                    <button type="submit" name="option" value="{{ $mob->id }}"
                        class="p-5 mt-3 border w-full text-1xl">Choose</button>
                        <h2>ao clicar aqui varias vezes submete a form varias vezes</h2>
                </div>
            @endforeach
            
        </div>
    </form>
</div>
@endisset



@endsection
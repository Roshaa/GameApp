@extends('Layouts.app')
@section('pagecontent')


        <div class="w-2/12"></div>
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
        <div class="w-2/12"></div>



@endsection

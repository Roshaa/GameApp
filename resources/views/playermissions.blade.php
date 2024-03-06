@extends('Layouts.app')
@section('pagecontent')

<div class="flex w-full bg-opacity-25 bg-no-repeat bg-cover text-white"
style="background-image: url( 'images/campsite.jpg'  );">
    <form action="combatresult" method="post" class="flex justify-center w-full mt-10">
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

@endsection

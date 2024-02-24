@extends('layouts.app')
@section('pagecontent')
    <form action="" method="POST" class="flex justify-center h-full">
        @csrf
        <div class="h-3/6 mx-10 mt-10 w-1/5">
            <h1 class="text-center text-2xl	mt-3">Assassin</h1>
            <img src="images/assassinclass.jpg" class="mt-3" alt="">
            <div class="text-center mt-5">
                <button value="Assassin" name="Class" type="Submit" class="font-semibold border rounded w-full p-4">Choose</button>
            </div>

        </div>
        <div class="h-3/6 mx-10 mt-10 w-1/5">
            <h1 class="text-center text-2xl	mt-3">Paladin</h1>
            <img src="images/paladinclass.jpg" class="mt-3" alt="">
            <div class="text-center mt-5">
                <button value="Paladin" name="Class" type="Submit" class="font-semibold border rounded w-full p-4">Choose</button>
            </div>
        </div>
        <div class="h-3/6 mx-10 mt-10 w-1/5">
            <h1 class="text-center text-2xl	mt-3">Warlock</h1>
            <img src="images/warlockclass.jpg" class="mt-3" alt="">
            <div class="text-center mt-5">
                <button value="Warlock" name="Class" type="Submit" class="font-semibold border rounded w-full p-4">Choose</button>
            </div>
        </div>
    </form>
@endsection

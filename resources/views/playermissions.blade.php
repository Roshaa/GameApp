@extends('Layouts.app')
@section('pagecontent')
    <form action="combatresult" method="post" class="flex justify-center w-full mt-3">
        @csrf
        <div class="flex">
            @foreach ($mobs as $mob)
                <div class="w-2/6 h-3/6 mx-2 text-center" alt=""> <img src="{{ $mob->imglink }}">
                    <button type="submit" name="option" value="{{ $mob->id }}"
                        class="p-5 mt-3 border w-full text-2xl">{{ $mob->MobName }}</button>
                </div>
            @endforeach
        </div>

    </form>

    @if (session()->has('missionresult'))
        <div>{{ session('missionresult') }}</div>
    @endif
@endsection

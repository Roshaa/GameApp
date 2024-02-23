@extends('Layouts.app')
@section('pagecontent')
    <div class="flex justify-center mt-2">
        <form action="" method="post">
            @csrf
            <button type="submit" name="option" value="1" class="w-24 border mx-2">Option 1</button>
        </form>
        <form action="" method="POST">
            @csrf
            <button type="submit" name="option" value="2" class="w-24 border mx-2">Option 2</button>
        </form>
        <form action="" method="POST">
            @csrf
            <button type="submit" name="option" value="3" class="w-24 border mx-2">Option 3</button>
        </form>
    </div>

    @if (session()->has('missionresult'))
        <div>{{ session('missionresult') }}</div>
    @endif

@endsection

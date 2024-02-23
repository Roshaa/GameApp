@extends('layouts.app')
@section('pagecontent')

<div class="mt-5">

    @foreach ($users as $user)
    {{$user->name}}
    ||
    {{$user->email}}
    ||
    {{$user->id}}
    @endforeach
</div>

@endsection
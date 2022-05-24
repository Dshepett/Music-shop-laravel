@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="card">
        <div class="card-header">
            {{ $user->name }}
        </div>
        <div class="card-body">
            <p>Email: {{$user->email}}</p>
            <a href="{{route('home')}}">
                <button class="btn btn-primary">Назад</button>
            </a>
        </div>
    </div>
@endsection

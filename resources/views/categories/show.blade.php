@extends('layouts.app')

@section('title', 'Категория "'.$category->name.'"')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ $category->name }}
        </div>
        <div class="card-body">
            <p>Описание: {{$category->description}}</p>
            @if($category->parent!='None')
                <p>Родитель: {{$category->parent}}</p>
            @endif
            <a href="{{route('categories.index')}}">
                <button class="btn btn-primary">Назад</button>
            </a>
        </div>
    </div>
@endsection

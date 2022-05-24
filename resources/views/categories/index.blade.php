@extends('layouts.app')

@section('title', 'Категории')

@section('content')
    @if(@isset($user))
        @if($user->role=='admin')
            <a href="{{route('categories.create')}}">
                <button class="btn btn-success">Создать катеорию</button>
            </a>
        @endif
    @endif
    @if(!$categories->isEmpty())
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Родительская категория</th>
            @if(@isset($user))
                @if($user->role=='admin')
                    <th scope="col">Действия</th>
                @endif
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td><a href="/products/category/{{$category->id}}">{{ $category->name }}</a>
                    <a href="{{route('categories.show',$category)}}">
                        <button class="btn btn-default border"><img
                                src="https://img.icons8.com/material-outlined/344/info--v1.png" width="20" height="20">
                        </button>
                    </a></td>
                @if($category->parent!='None')
                    <td>{{ $category->parent  }}</td>
                @else
                    <td>-</td>
                @endif
                @if(@isset($user))
                    @if($user->role=='admin')
                        <td>
                            <a href="{{route('categories.edit',$category)}}">
                                <button class="btn btn-default border"><img
                                        src="https://img.icons8.com/ios-glyphs/344/edit--v1.png" width="20" height="20">
                                </button>
                            </a>
                            <form class="d-inline" method="POST" action="{{route('categories.destroy', $category)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-default border"><img
                                        src="https://img.icons8.com/ios-glyphs/344/filled-trash.png" width="20"
                                        height="w0"></button>
                            </form>
                        </td>
                    @endif
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <h1>Нет категорий</h1>
    @endif
@endsection

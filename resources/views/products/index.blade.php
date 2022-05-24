@extends('layouts.app')

@section('title', 'Карточка товара')

@section('content')
    @if(@isset($user))
        @if($user->role=='admin')
            <a href="{{route('products.create')}}">
                <button class="btn btn-success">Создать товар</button>
            </a>
        @endif
    @endif
    @if(!$products->isEmpty())
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Категория</th>
                <th scope="col">Цена</th>
                @if(@isset($user))
                    @if($user->role=='admin')
                        <th scope="col">Действия</th>
                    @endif
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><a href="{{route('products.show', $product)}}">{{ $product->name }}</a></td>
                    <td>{{ $categories->where('id','==',$product->category_id)->first()->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        @if(@isset($user))
                            @if($user->role=='admin')
                                <a href="{{route('products.edit', $product)}}">
                                    <button class="btn btn-default border"><img
                                            src="https://img.icons8.com/ios-glyphs/344/edit--v1.png" width="20"
                                            height="20">
                                    </button>
                                </a>
                                <form class="d-inline" method="POST" action="{{route('products.destroy', $product)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-default border"><img
                                            src="https://img.icons8.com/ios-glyphs/344/filled-trash.png" width="20"
                                            height="w0"></button>
                                </form>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1>Нет товаров</h1>
    @endif
@endsection

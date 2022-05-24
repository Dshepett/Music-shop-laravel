@extends('layouts.app')

@section('title', 'Карточка товара "'.$product->name.'"')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h1>{{ $product->name }}</h1>
            <a href="{{route('products.index')}}" class="flow-end">
                <button class="btn btn-primary">Назад</button>
            </a>
        </div>
        <div class="card-body d-flex flex-row">
            <div class="mr-5">
                <img src="{{$product->image_url}}" class="img-thumbnail rounded float-start" width="200" height="200">
            </div>
            <div>
                <div class="p-2">
                    <p>Описание: {{$product->description}}</p>
                    <p>Цена: {{$product->price}}</p>
                    <p>Категория: {{$category_name}}</p>
                </div>
                @if(@isset($user))
                    <form method="POST" action="{{ route('orders.store') }}" class="p-2">
                        <h3>Создать заказ</h3>
                        @csrf
                        <div class="mb-3">
                            <label for="price" class="form-label">Количество</label>
                            <input type="number" class="form-control" name="quantity" id="quantity" required>
                            <input type="number" class="d-none" name="product_id" id="product_id"
                                   value="{{$product->id}}">
                        </div>
                        <button type="submit" class="btn btn-success">Создать</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Заказ №'.$order->id)

@section('content')
    <div class="card">
        <div class="card-header">
            {{'Заказ №'.$order->id}}
        </div>
        <div class="card-body">
            <p>Время заказа: {{$order->time_of_order}}</p>
            <p>Товар: <a href="{{route('products.show', $product)}}">{{$product->name}}</a></p>
            <p>Количество товара: {{$order->quantity}}</p>
            <p>Заказал товар: {{$user->name}}</p>
            <p>Стоимость заказа: {{$product->price*$order->quantity}}</p>
            <a href="{{route('orders.index')}}">
                <button class="btn btn-primary">Назад</button>
            </a>
        </div>
    </div>
@endsection

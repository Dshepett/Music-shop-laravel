@extends('layouts.app')

@section('title', 'Заказы')

@section('content')
    @if(!$orders->isEmpty())
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Время заказа</th>
                <th scope="col">Кто заказал</th>
                @if(@isset($user))
                    @if($user->role=='admin')
                        <th scope="col">Действия</th>
                    @endif
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>
                        <a href="{{route('orders.show',$order)}}">
                            {{$order->id}}
                        </a>
                    </td>
                    <td>
                        {{$order->time_of_order}}
                    </td>
                    <td>
                        {{\App\Models\User::all()->where('id','==',$order->user_id)->first()->name}}
                    </td>
                    @if(@isset($user))
                        @if($user->role=='admin')
                            <td>
                                <form class="d-inline" method="POST"
                                      action="{{route('orders.destroy', $order)}}">
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
        <h1>Нет заказов</h1>
    @endif
@endsection

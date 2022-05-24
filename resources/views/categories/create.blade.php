@extends('layouts.app')

@section('title', 'Создание категории')

@section('content')
    <div class="card">
        <div class="card-header">
            Создание категории
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Название категории</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="parent" class="form-label">Родительская категория</label>
                    <select class="form-control" name="parent" id="parent">
                        <option>None</option>
                        @foreach($categories as $category)
                            <option>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>


                <button type="submit" class="btn btn-success">Создать</button>
                <a href="{{route('categories.index')}}">
                    <button type="button" class="btn btn-primary">Отмена</button>
                </a>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Изменение категории')

@section('content')
    <div class="card">
        <div class="card-header">
            Категория
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
            <form method="POST" action="{{route('categories.update', $category)}}">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Название категории</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$category->name}}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{$category->description}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="parent" class="form-label">Артикул</label>
                    <select class="form-control" name="parent" id="parent" value="{{$category->parent}}">
                        <option>None</option>
                        @foreach($categories as $category_element)
                            @if($category_element->name==$category->parent)
                            <option selected>{{$category_element->name}}</option>
                            @else
                                <option>{{$category_element->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Сохранить</button>
                <a href="{{route('categories.index')}}">
                    <button type="button" class="btn btn-primary">Отмена</button>
                </a>
            </form>
        </div>
    </div>
@endsection

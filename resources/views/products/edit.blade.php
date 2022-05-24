@extends('layouts.app')

@section('title', 'Изменение карточки товара')

@section('content')
    <div class="card">
        <div class="card-header">
            Товар
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
            <form method="POST" action="{{route('products.update', $product)}}">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$product->name}}">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Цена</label>
                    <input type="number" class="form-control" name="price" id="price" value="{{$product->price}}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" id="description" name="description"
                              rows="3">{{$product->description}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Категория</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach($categories as $category)
                            @if($category->id==$product->category_id)
                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="image_url" class="form-label">Ссылка на картинку товара</label>
                    <input type="text" class="form-control" name="image_url" id="image_url"
                           value="{{$product->image_url}}">
                </div>

                <button type="submit" class="btn btn-success">Сохранить</button>
                <a href="{{route('products.index')}}">
                    <button type="button" class="btn btn-primary">Отмена</button>
                </a>
            </form>
        </div>
    </div>
@endsection

@extends('admin.index')
@section('content')

@if (Session::has('a'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('a') }}
    </div>
@endif
    <style>
        .category {
            margin-bottom: 20px;
        }
        .title {
            margin-bottom: 10px;
        }
    </style>

        @foreach ($categories as $category)
            {{$category->id}}{{$category->title}}
            @if ($category->categories)
                @foreach ($category->categories as $category)
                   {{$category->id}}-----{{$category->title}}
                @endforeach
            @endif
        @endforeach


    @forelse ($categories as $category)
        <div class="category card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="title card-title">
                    {{$category->title}}
                    </h5>
                <p class="card-text">{{$category->text}}                </p>
                <a href="/category/edit/{{$category->id}}" class="card-link">редактировать</a>
                <a href="/categories/category/delete/{{$category->id}}" class="card-link">удалить</a>
            </div>
        </div>
    @empty
        Данные отсутствуют
    @endforelse

@endsection

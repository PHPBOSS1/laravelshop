@extends('admin.index')
@section('content')

@if (Session::has('a'))
    <div class="alert alert-success" role="alert>
        {{ Session::get('a') }}
    </div>
@endif
    <style>
{{--        .post {--}}
{{--            margin-bottom: 20px;--}}
{{--        }--}}
{{--        .title {--}}
{{--            margin-bottom: 10px;--}}
{{--        }--}}
    </style>
    @forelse ($category as $categor)
        <div class="post">
            <div class="title">
                {{$categor->title}}
            </div>
            <div>
                {{$categor->text}}
                <a href="/category/edit/{{$categor->id}}">редактировать</a>
                <a href="/categories/category/delete/{{$categor->id}}">удалить</a>
            </div>
        </div>
    @empty
        Данные отсутствуют
    @endforelse

@endsection

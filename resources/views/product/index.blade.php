@extends('admin.index')
@section('content')

    @if (Session::has('a'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('a') }}
        </div>
    @endif
    <style>
        .products {
            margin-bottom: 20px;
        }
        .title {
            margin-bottom: 10px;
        }
    </style>

    @foreach ($products as $product)
        {{$product->id}}{{$product->title}}
        @if ($product->categories)
            @foreach ($product->categories as $subproduct)
                {{$subproduct->id}}-----{{$subproduct->title}}
            @endforeach
        @endif
    @endforeach


    @forelse ($products as $product)
        <div class="products card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="title card-title">
                    {{$product->title}}
                </h5>
                <p class="card-text">{{$product->text}}                </p>
                <a href="/category/edit/{{$product->id}}" class="card-link">редактировать</a>
                <a href="/categories/category/delete/{{$product->id}}" class="card-link">удалить</a>
            </div>
        </div>
    @empty
        Данные отсутствуют
    @endforelse

@endsection

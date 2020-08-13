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

{{--    @foreach ($products as $product)--}}
{{--        {{$product->id}}{{$product->title}}--}}
{{--        @if ($product->categories)--}}
{{--            @foreach ($product->categories as $subproduct)--}}
{{--                {{$subproduct->id}}-----{{$subproduct->title}}--}}
{{--            @endforeach--}}
{{--        @endif--}}
{{--    @endforeach--}}



    @forelse ($products as $product)
        <div class="products card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="title card-title">
                    {{$product->title}}
                </h5>
                <p class="card-text">{!! $product->text!!}</p>
                <p class="card-images">
                    @forelse ($product->images as $image)
                        <img src="{{$image->path }} " alt="{{$image->title}}">
                    @empty
                        Нет фотографий
                    @endforelse
                </p>

                <a href="/product/edit/{{$product->id}}" class="card-link">редактировать</a>
                <a href="/products/product/delete/{{$product->id}}" class="card-link">удалить</a>
            </div>
        </div>
    @empty
        <div>Нет товаров</div>
    @endforelse


{{--    @forelse ($products as $product)--}}
{{--        <div class="products card" style="width: 18rem;">--}}
{{--            <div class="card-body">--}}
{{--                <h5 class="title card-title">--}}
{{--                    {{$product->title}}--}}
{{--                </h5>--}}
{{--                <p class="card-text">{!! $product->text!!}</p>--}}
{{--                <p class="card-text"><img src="{!! '/uploads/product_images/'.$product->images !!}" alt="текст"></p>--}}

{{--                <a href="/category/edit/{{$product->id}}" class="card-link">редактировать</a>--}}
{{--                <a href="'/categories/category/delete/'.{{$product->id}}" class="card-link">удалить</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @empty--}}
{{--        Данные отсутствуют--}}
{{--    @endforelse--}}

@endsection

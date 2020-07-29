@extends('admin.index')
@section('content')

<ul>
    @foreach ($categories as $category)
        <li>{{ $category->title }}</li>
        <a href="/category/edit/{{$category->id}}" class="card-link">редактировать</a>
        <a href="/categories/category/delete/{{$category->id}}" class="card-link">удалить</a>
        <ul>
            @foreach ($category->childrenCategories as $childCategory)
                @include('child_category', ['child_category' => $childCategory])
            @endforeach
        </ul>
    @endforeach
</ul>
@endsection


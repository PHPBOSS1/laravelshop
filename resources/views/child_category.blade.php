<li>{{$child_category->text }}</li>
<a href="/category/edit/{{$child_category->id}}" class="card-link">редактировать</a>
<a href="/categories/category/delete/{{$child_category->id}}" class="card-link">удалить</a>
@if ($child_category->categories)
    <ul>
        @foreach ($child_category->categories as $childCategory)
            @include('child_category', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif

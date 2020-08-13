
@if (Session::has('info'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('info') }}
    </div>
@endif
    @extends('admin.index')
    @section('content')
<form action="/categories/category/store" method="POST">
    {{ csrf_field() }}
    <?php
    use Illuminate\Support\MessageBag;
    /** @var MessageBag $errors */
    ?>

    <div class="p-4 mb-2"><h1>Создание категории</h1>
        <div class="form-group"><label for="inputDesription" class="col-xs-2 control-label">Введите описание(desription)</label>
            <div class="col-xs-10">
                <input type="text" name="description" class="form-control" placeholder="введите описание" id="description"></div

            <?  if($errors->first("description") != "") echo "<div class='alert'>".$errors->first("description")."</div>"; ?>
    </div>
    </div>
    <div> <label for="inputKeywords" class="col-xs-2 control-label">Введите keywords</label>
        <div class="col-xs-10">
        <input type="text" name="keywords" placeholder="введите ключевые слова" id="inputKeywords">
    <?  if($errors->first("keywords") != "") echo "<div class='alert'>".$errors->first("keywords")."</div>"; ?>
    </div>
    </div>

    <div> <div class="form-group"><label for="inputtitle" class="col-xs-2 control-label">Введите заголовок</label>
    <div class="col-xs-10">
    <input type="text" name="title" placeholder="введите заголовок" id="title"></div>
    <?  if($errors->first("title") != "") echo "<div class='alert'>".$errors->first("title")."</div>"; ?>
    </div>
    </div>
{{--    {{dd($path)}}--}}

    <div class="form-group">
        <label>Подкатегории</label>
        <select class="form-control input-sm" name="category_id">
            <option value="">--select--</option>
        @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
                @if ($category->categories)
                    @foreach ($category->categories as $category)
                            <option value="{{$category->id}}">-----{{$category->title}}</option>
                        @endforeach
                @endif
            @endforeach
        </select>
    </div>
{{--    <div class="form-group">--}}
{{--        <label>Подкатегории</label>--}}
{{--        <select class="form-control input-sm" name="category_id">--}}
{{--            <option value="">--select--</option>--}}
{{--            @foreach ($child_category->categories as $childCategory)--}}
{{--                <option value="{{$childCategory->id}}">{{$childCategory->title}}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--    </div>--}}
    <div><div class="form-group"><label for="inputslug" class="col-xs-2 control-label">Введите урл страницы</label>
        <div class="col-xs-10">
    <input type="text" name="slug" placeholder="Укажите slug"></div>
    <? if($errors->first("slug") != "") echo "<div class='alert'>".$errors->first("slug")."</div>"; ?>
    </div>
    </div>

    <div><div class="form-group"><label for="inputtextl" class="col-xs-2 control-label">Введите описание категории</label>
        <div class="col-xs-10">
    <textarea rows="10" cols="45" name="text" placeholder="введите пост статьи"></textarea></div>
    <? if($errors->first("text") != "") echo "<div class='alert'>".$errors->first("text")."</div>"; ?>
    </div>
    </div>

    <label for="">Статус</label>
    <select class="form-control" name="published">
        <option value="0">Не опубликовано</option>
        <option value="1">Опубликовано</option>
    </select>
    <input type="submit" value="Отправить">
</form>
@endsection

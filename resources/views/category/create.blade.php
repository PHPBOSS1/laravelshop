
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
                <input type="text" name="desription" class="form-control" placeholder="введите описание" id="desription"></div

            <?  if($errors->first("desription") != "") echo "<div class='alert'>".$errors->first("desription")."</div>"; ?>
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
        <?php if(isset($categories->id)): ?>
        <option value="0" <?php if($categories->published == 0): ?> selected="" <?php endif; ?>>Не опубликовано</option>
        <option value="1" <?php if($categories->published == 1): ?> selected="" <?php endif; ?>>Опубликовано</option>
        <?php else: ?>
        <option value="0">Не опубликовано</option>
        <option value="1">Опубликовано</option>
        <?php endif; ?>
    </select>
    <input type="submit" value="Отправить">
</form>
@endsection

@extends('admin.index')
@section('content')
        @if (Session::has('info'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('info') }}
        </div>
    @endif
    <form action="/products/product/store" method="POST">
        {{ csrf_field() }}
        <?php
        use Illuminate\Support\MessageBag;
        /** @var MessageBag $errors */
        ?>
        <div class="p-4 mb-2"><h1>Создание товара</h1>
            <div class="form-group"><label for="inputDesription" class="col-xs-2 control-label">Введите описание(desription)</label>
                <div class="col-xs-10">
                    <input type="text" name="description" class="form-control" placeholder="введите описание" id="description"></div

                <?  if($errors->first("description") != "") echo "<div class='alert'>".$errors->first("description")."</div>"; ?>
            </div>
        </div>
        <div class="form-group"><label for="inputPrice" class="col-xs-2 control-label">Введите цену</label>
            <div class="col-xs-10">
                <input type="text" name="price" class="form-control" placeholder="введите описание" id="price"></div

            <?  if($errors->first("price") != "") echo "<div class='alert'>".$errors->first("price")."</div>"; ?>
        </div>
        </div>
        <p><input type="file" class="my-pond" name="product_image"/></p>
        <div class="form-group"><label for="inputAuthorized_price" class="col-xs-2 control-label">Введите цену со скидкой</label>
            <div class="col-xs-10">
                <input type="text" name="authorized_price" class="form-control" placeholder="Введите цену со скидкой" id="authorized_price"></div

            <?  if($errors->first("authorized_price") != "") echo "<div class='alert'>".$errors->first("authorized_price")."</div>"; ?>
        </div>
        </div>
        <div><div class="form-group"><label for="inputshort_descriptionl" class="col-xs-2 control-label">Введите короткое описание товара</label>
                <div class="col-xs-10">
                    <textarea rows="10" cols="45" name="short_description" placeholder="Введите короткое описание товара"></textarea></div>
                <? if($errors->first("short_description") != "") echo "<div class='alert'>".$errors->first("short_description")."</div>"; ?>
            </div>
        </div>

{{--product_image--}}
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

{{--        <div class="form-group">--}}
{{--            <label>Подкатегории</label>--}}
{{--            <select class="form-control input-sm" name="category_id">--}}
{{--                <option value="">--select--</option>--}}
{{--                @foreach ($categories as $category)--}}
{{--                    <option value="{{$category->id}}">{{$category->title}}</option>--}}
{{--                    @if ($category->categories)--}}
{{--                        @foreach ($category->categories as $category)--}}
{{--                            <option value="{{$category->id}}">-----{{$category->title}}</option>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
        <div><div class="form-group"><label for="inputslug" class="col-xs-2 control-label">Введите урл страницы</label>
                <div class="col-xs-10">
                    <input type="text" name="slug" placeholder="Укажите slug"></div>
                <? if($errors->first("slug") != "") echo "<div class='alert'>".$errors->first("slug")."</div>"; ?>
            </div>
        </div>

        <div><div class="form-group"><label for="inputtextl" class="col-xs-2 control-label">Введите описание товара</label>
                <div class="col-xs-10">
                    <textarea rows="10" cols="45" name="text" placeholder="введите пост статьи"></textarea></div>
                <? if($errors->first("text") != "") echo "<div class='alert'>".$errors->first("text")."</div>"; ?>
            </div>
        </div>

        <label for="">Статус</label>
        <select class="form-control" name="published">
            <?php if(isset($products->id)): ?>
            <option value="0" <?php if($products->published == 0): ?> selected="" <?php endif; ?>>Не опубликовано</option>
            <option value="1" <?php if($products->published == 1): ?> selected="" <?php endif; ?>>Опубликовано</option>
            <?php else: ?>
            <option value="0">Не опубликовано</option>
            <option value="1">Опубликовано</option>
            <?php endif; ?>
        </select>
        <input type="submit" value="Отправить">
    </form>
        <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'text' );
        </script>
        <script>
            CKEDITOR.replace( 'short_description' );
        </script>


{{--        <!-- include jQuery library -->--}}
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>--}}

{{--        <!-- include FilePond library -->--}}
{{--        <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>--}}

{{--        <!-- include FilePond plugins -->--}}
{{--        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>--}}

{{--        <!-- include FilePond jQuery adapter -->--}}
{{--        <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>--}}

{{--        <script>--}}
{{--            $(function(){--}}

{{--                // First register any plugins--}}
{{--                $.fn.product_image.registerPlugin(FilePondPluginImagePreview);--}}

{{--                // Turn input element into a pond--}}
{{--                $('.my-pond').product_image();--}}

{{--                // Set allowMultiple property to true--}}
{{--                $('.my-pond').product_image('allowMultiple', true);--}}

{{--                // Listen for addfile event--}}
{{--                $('.my-pond').on('FilePond:addfile', function(e) {--}}
{{--                    console.log('file added event', e);--}}
{{--                });--}}

{{--                // Manually add a file using the addfile method--}}
{{--                $('.my-pond').first().product_image('addFile', 'index.html').then(function(file){--}}
{{--                    console.log('file added', file);--}}
{{--                });--}}

{{--            });--}}
{{--        </script>--}}
@endsection

@extends('admin.index')
@section('content')
        @if (Session::has('info'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('info') }}
        </div>
    @endif
    <form action="/products/product/store" enctype="multipart/form-data" method="POST">
        {{ csrf_field() }}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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

        {{--        <p><input type="file" class="my-pond" multiple name="product_image"/></p>--}}
{{--        --}}
{{--        <div class="form-group">--}}
{{--            <label for="img">Выберите файл</label>--}}
{{--            <input id="img" type="file" multiple name="file[]">--}}
{{--        </div>--}}

{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-8">--}}
{{--                <form action="{{route('product')}}" class="dropzone" method="post" enctype="multipart/form-data">@csrf</form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        </div>--}}

        <input type="file"  name="path[]" id="path[]" multiple accept="image/*">
        <div id="for_preview_uploads">
        </div>
        {{--        <div>--}}
{{--            строка ниже--}}
{{--        </div>--}}
        <script>
            function resizeImage(img) {

                const W = parseInt(img.width / 4);
                const H = parseInt(img.height / 4);

                const canvas = document.createElement("canvas");
                canvas.width = W;
                canvas.height = H;

                const ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0, W, H);

                const resizedImg = new Image();
                resizedImg.src = canvas.toDataURL('image/jpeg', 1);
                //document.body.append(resizedImg);
                document.querySelector("#for_preview_uploads").append(resizedImg);

            }

            function handleFiles(e) {

                for (const file of this.files) {

                    const img = document.createElement("img");
                    const reader = new FileReader();

                    reader.addEventListener("load", (e) => {
                        img.addEventListener("load", (e) => {
                            resizeImage(img);
                        });
                        img.src = e.target.result;
                    });

                    reader.readAsDataURL(file);

                }

            }

            const fileInput = document.getElementById("path[]");

            fileInput.addEventListener("change", handleFiles, false);


        </script>

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
<!--        --><?php //dd($categories); ?>

        <div class="form-group">
            <label>Категории</label>
            <select  class="form-control input-sm" name="category_id">
{{--                <!--                --><?php //dd($categories); ?>--}}
                <option selected value="$products->id">--select--</option>
                @foreach ($categories as $firstcategory)
                    <option  value="{{$firstcategory->id}}">{{$firstcategory->title}}</option>

                    @if($firstcategory->categories)
                        @foreach ($firstcategory->categories as $subcategory)
                            <option  value="{{$subcategory->id}}">-{{$subcategory->title}}</option>
                            @if($subcategory->categories)
                                @foreach ($subcategory->categories as $sbcategory)
                                    <option value="{{$sbcategory->id}}">---{{$sbcategory->title}}</option>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </select>
        </div>
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
            <option value="0">Не опубликовано</option>
            <option value="1">Опубликовано</option>
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



        <!-- Scripts -->
{{--        <script src="{{ asset('js/dropzone.js') }}" defer></script>--}}
{{--        <script src="{{ asset('js/1.js') }}" defer></script>--}}
{{--        <script src="{{ asset('js/dashboard.js') }}" defer></script>--}}


        <!-- Styles -->
        <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
@endsection

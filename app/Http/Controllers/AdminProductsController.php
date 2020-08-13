<?php

namespace App\Http\Controllers;

use App\Category;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ImageInt;
use League\Flysystem\File;

class AdminProductsController extends Controller
{

    //

        public function index()
    {
                return view('product.index', [
            'products' => Product::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }


    public function create(Request $request)
    {
        $categories = Category::whereNull('category_id')->with('childrenCategories')->get();

        return view('product.create', compact('categories' ));
    }


    public function store(Request $request)
    {
//        error_reporting(E_ALL);
//        ini_set("display_errors", 1);
        $this->validate($request, [
            'title' => 'required',
            'slug'   =>  'required|unique:products',
            'text'  =>  'required',
            'path.*'  =>  'nullable|image',
        ]);
        $product = new Product();
        $product->title = $request->input('title');
        $product->slug = $request->input('slug');
        $product->text = $request->input('text');
        $product->keywords = $request->input('keywords');
        $product->description = $request->input('description');
        $product->published = $request->input('published');
        $product->category_id = $request->input('category_id');
        $product->price = $request->input('price');
        $product->authorized_price = $request->input('authorized_price');
        $product->short_description = $request->input('short_description');
        $product->save();
        $path =public_path().'/uploads/product_images/';
        $file = $request->file('path');
        foreach ($file as $f) {
            $filename = Str::random(20) .'.' . $f->getClientOriginalExtension() ?: 'png';
            $img = ImageInt::make($f);
            $img->resize(500,500)->save($path . $filename);
            $image = new Image();
            $image->path = '/uploads/product_images/'.$filename;
            $image->title = $request->input('title');
            $image->product_id =  $product->id;
            $image->save();
        }

        return redirect('/product/create')->with('info', 'Данные сохранены');
    }


    public function edit($id)
    {
        $categories = Product::whereNull('category_id')->with('childrenCategories')->get();
        $product = Product::where('id',$id)->first();

        return view('product.edit', compact('categories','product'));

    }



    public function edit_store(Request $request, $id)
    {
//        dd('stop');

        $this->validate($request, [
            'title' => 'required',
            'slug'   =>  'required|unique:products',
            'text'  =>  'required',
            'path.*'  =>  'nullable|image',
        ]);

        $product =  Product::find($id);
        $product->title = $request->input('title');
        $product->slug = $request->input('slug');
        $product->text = $request->input('text');
        $product->keywords = $request->input('keywords');
        $product->description = $request->input('description');
        $product->published = $request->input('published');
        $product->category_id = $request->input('category_id');
        $product->price = $request->input('price');
        $product->authorized_price = $request->input('authorized_price');
        $product->short_description = $request->input('short_description');
        $product->save();
        $path =public_path().'/uploads/product_images/';
        $file = $request->file('path');
        foreach ($file as $f) {
            $filename = Str::random(20) .'.' . $f->getClientOriginalExtension() ?: 'png';
            $img = ImageInt::make($f);
            $img->resize(500,500)->save($path . $filename);
            $image = new Image();
            $image->path = '/uploads/product_images/'.$filename;
            $image->title = $request->input('title');
            $image->product_id =  $product->id;
            $image->save();
        }
        return redirect('/product/edit/'.$product->id)->with('info', 'Данные сохранены');
    }



    public function destroy(Image $image)
    {
        Storage::disk('public/uploads/product_images/')->delete($image->path);
        $image->delete();
        return redirect()->route('product.edit', ['id' => $image->product_id]);
    }
}

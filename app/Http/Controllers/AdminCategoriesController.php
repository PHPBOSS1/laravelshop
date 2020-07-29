<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    //

//    public function index()
//    {
//        //
//        return view('category.index', [
//            'categories' => Category::orderBy('created_at', 'desc')->paginate(10)
//        ]);
//    }

    public function index()
    {
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
        return view('categories', compact('categories'));
    }


//    public function create()
//    {
////        dd(Category::whereNull('category_id')
////            ->with('childrenCategories')
////            ->get());
//        return view('category.create', [
//            'category' => Category::whereNull('category_id')
//                ->with('childrenCategories')
//                ->get()
//        ]);
//
//    }
    public function create()
    {
        $categories = Category::whereNull('category_id')->with('childrenCategories')->get();

        return view('category.create', compact('categories'));
    }


    public function store(Request $request)
    {
//        dd('stop');

        $this->validate($request, [
            'title' => 'required',
            'slug'   =>  'required|unique:categories',
            'text'  =>  'required',
        ]);

        $category = new Category();
        $category->title = $request->input('title');
        $category->slug = $request->input('slug');
        $category->text = $request->input('text');
        $category->keywords = $request->input('keywords');
        $category->description = $request->input('description');
        $category->published = $request->input('published');
        $category->category_id = $request->input('category_id');
        $category->save();
        return redirect('/category/create')->with('info', 'Данные сохранены');
    }

//    public function store(Request $request)
//    {
//        $this->validate($request, [
//            'title' => 'required',
//            'slug'   =>  'required|unique:categories',
//            'text'  =>  'required',
//        ]);
//
//        $category =  Category::create($request->only(['title', 'slug', 'text', 'keywords', 'desription', 'published', 'childrenCategories', 'category_id' ]));
//        return redirect('/category/create')->with('info', 'Данные сохранены');
//    }

//    public function edit($id, $categories)
//    {
//        $categories = Category::whereNull('id','category_id', $id, $categories)->with('childrenCategories')->get();
//
//        return view('category.edit', compact('categories'));
//    }
//    public function edit($id){
//        return view('category.edit', [
//            'categories' => Category::where('id', $id)->first(),
//        ]);
//    }
//    public function edit($id)
//    {
//        //
//        return view('category.edit', [
//            'categories' => Category::where('id',$id)->with('childrenCategories')->whereNull('category_id')->get(),
//        ]);
//
//    }


    public function edit($id)
    {
        $categories = Category::whereNull('category_id')->with('childrenCategories')->get();
        $category = Category::where('id',$id)->first();

        return view('category.edit', compact('categories','category'));

    }



    public function edit_store(Request $request, $id)
    {
//        dd('stop');

        $this->validate($request, [
            'title' => 'required',
            'slug'   =>  "required|unique:categories,slug,$id",
            'text'  =>  'required',
        ]);

        $category =  Category::find($id);
        $category->title = $request->input('title');
        $category->slug = $request->input('slug');
        $category->text = $request->input('text');
        $category->keywords = $request->input('keywords');
        $category->description = $request->input('description');
        $category->published = $request->input('published');
        $category->category_id = $request->input('category_id');
        $category->save();
        return redirect('/category/edit/'.$category->id)->with('info', 'Данные сохранены');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('/categories')->with('a', "Категория номер $id удалёна");
    }


}

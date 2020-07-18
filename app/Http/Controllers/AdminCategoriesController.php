<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    //

    public function index()
    {
        //
        return view('category.index', [
            'category' => Category::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }


    public function create()
    {
        return view('category/create');

    }

    public function store(Request $request)
    {
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
        $category->desription = $request->input('desription');
        $category->published = $request->input('published');
        $category->save();
        return redirect('/category/create')->with('info', 'Данные сохранены');
    }

    public function edit($id){
        return view('category.edit', [
            'category' => Category::where('id', $id)->first(),
        ]);
    }



    public function edit_store(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required',
            'slug'   =>  "required|unique:category,slug,$id",
            'text'  =>  'required',
        ]);
        $category =  Category::find($id);
        $category->title = $request->input('title');
        $category->slug = $request->input('slug');
        $category->text = $request->input('text');
        $category->keywords = $request->input('keywords');
        $category->desription = $request->input('desription');
        $category->published = $request->input('published');
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

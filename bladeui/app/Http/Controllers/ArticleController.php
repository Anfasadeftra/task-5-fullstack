<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Http\Requests\StoreArticlesRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articles = Article::all();
        return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticlesRequest $request)
    {
        //
        $validator = Validator::make($request->all(), [
            "title"     => "required",
            "content"     => "required",
            "image"     => 'file|mimes:png,jpg',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $articles               = new Article();
        $articles->title        = $request->title;
        $articles->content      = $request->content;
        $articles->image        = $request->image;
        $articles->user_id      = Auth::user()->id;
        $articles->category_id  = Auth::user()->categories()->where('user_id', $articles->user_id)->first()->id;
        //$articles->category_id  = 1;
        $articles->save();

       return redirect()->route('articles.index')->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $articles = Article::findOrFail($id);
        return view('articles.edit',compact('articles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            "title"     => "required|unique:articles,title,".$id,
            "content"     => "required|unique:articles,content,".$id,
            "image"     => 'file|mimes:png,jpg'.$id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $articles = Article::findOrFail($id);

        $articles->title         = $request->title;
        $articles->content       = $request->content;
        $articles->image         = $request->image;
        $articles->user_id      = Auth::user()->id;
        $articles->category_id  = Auth::user()->categories()->where('user_id', $articles->user_id)->first()->id;
        $articles->save();

        return redirect()->route('articles.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $articles = Article::findOrFail($id);
        $articles->delete();
        
        return redirect()->back()->with('success', 'Data Deleted Successfully');
    }
}

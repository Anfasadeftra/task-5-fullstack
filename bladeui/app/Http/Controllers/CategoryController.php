<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['categorie']);
    }

    public function index()
    {
        //
        $categories = Category::all();
        return view('categories.index',['categories'=> $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        return view('categories.create', compact('users'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name"     => "required",
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $categories               = new Category();

        $cover              = $request->file('cover');
        if($cover){
            $cover_path     = $cover->store('images/blog', 'public');
            $categories->cover    = $cover_path;
        }
        $categories->name        = $request->name;
        $categories->user_id      = Auth::user()->id;
        $categories->save();

       // $categories->tags()->attach($request->tags);
       return redirect()->route('categories.index')->with('success', 'Data added successfully'); 

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
        $categories = Category::findOrFail($id);
        return view('categories.edit',compact('categories'));
        
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
            "name"     => "required|unique:categories,name,".$id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $categories = Category::findOrFail($id);
        
        $new_cover = $request->file('cover');

        if($new_cover){
            if($categories->cover && file_exists(storage_path('app/public/' . $categories->cover))){
                \Storage::delete('public/'. $categories->cover);
            }

            $new_cover_path = $new_cover->store('images/blog', 'public');

            $categories->cover = $new_cover_path;
        }

        $categories->name         = $request->name;
        $categories->user_id      = Auth::user()->id;
        $categories->save();

        return redirect()->route('categories.index')->with('success', 'Data updated successfully');
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
        $category = Category::findOrFail($id);
        $category->delete();
        
        return redirect()->back()->with('success', 'Data Deleted Successfully');
    }



}

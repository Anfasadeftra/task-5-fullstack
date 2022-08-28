<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Article;



class StoreArticlesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return auth()->user()->can('index', Article::class);
        $articles = Article::all();
        return view('articles.index', ['articles' => $articles]);;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'file|mimes:png,jpg',
            'category_id' => 'exist:categories,id',
            'category' => 'exist:categories,id',
        ];
    }
}

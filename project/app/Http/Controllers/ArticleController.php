<?php

namespace App\Http\Controllers;

use App\Article;
use Crystoline\LaraRestApi\RestApiTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class ArticleController extends Controller
{
    use RestApiTrait;

    public static function getModel(): string
    {
        return Article::class;
    }

    /**
     * @return array
     */
    public static function searchable(): array
    {
        return [
            'title',
            'slug',
            'description'
        ];
    }
    public static function getUniqueFields(): array
    {
       return  ['slug'];
    }

    public static function getValidationRules(): array
    {
        return [
            'title' => 'required',
            'slug' => 'required|unique:articles,slug',
            'description'  => 'required',
            'content'  => 'required'
        ];
    }

    public function beforeDelete(Request $request, Article $article): bool
    {
        $article->ratings()->delete();
    }

    /**
     * @param Request $request
     * @param Article $article
     * @return JsonResponse
     * @throws ValidationException
     */
    public function postRating(Request $request, Article $article){
            $this->validate($request, [
                'rate' => 'required'
            ]);
        return $article->ratings()->create([
            'rate' => $request->input('rate')
        ])? Response::json($article->refresh()): Response::json(['message' => 'Server error'], 500);

    }
}

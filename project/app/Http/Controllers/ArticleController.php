<?php

namespace App\Http\Controllers;

use App\Article;
use Crystoline\LaraRestApi\RestApiTrait;
use Illuminate\Http\Request;

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

        ];
    }
}

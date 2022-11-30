<?php

namespace App\Http\Controllers;

use App\Service\Api;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __invoke(int $id): View
    {
        $posts = Api::call()->getPosts($id);

        return view('posts', compact('posts'));
    }
}

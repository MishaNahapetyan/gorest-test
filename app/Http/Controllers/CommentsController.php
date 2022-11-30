<?php

namespace App\Http\Controllers;

use App\Service\Api;
use Illuminate\View\View;

class CommentsController extends Controller
{
    public function __invoke(int $id): View
    {
        $comments = Api::call()->getPostComments($id);

        return view('comments', compact('comments'));
    }
}

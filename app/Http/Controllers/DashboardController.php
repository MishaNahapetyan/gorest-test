<?php

namespace App\Http\Controllers;

use App\Resources\PostCollection;
use App\Service\Api;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $users = Api::call()->getUsers(request()->get('page'));

        return view('dashboard', compact('users'));
    }
}

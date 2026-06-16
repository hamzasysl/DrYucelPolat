<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormSubmission;
use App\Models\Menu;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users'        => User::count(),
            'posts'        => Post::count(),
            'menus'        => Menu::count(),
            'submissions'  => FormSubmission::count(),
            'recent_leads' => FormSubmission::query()->latest()->take(5)->get(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}

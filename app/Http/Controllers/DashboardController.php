<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementModel;
use App\Models\CommentsModel;
use App\Models\PostsModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = PostsModel::all();
        $comments = CommentsModel::all();
        $announcements = AnnouncementModel::all();
        return view('admin.dashboard', [
            'posts' => $posts,
            'comments' => $comments,
            'announcements' => $announcements
        ]);
    }
}

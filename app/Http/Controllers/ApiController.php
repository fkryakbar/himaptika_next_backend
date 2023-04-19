<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementModel;
use App\Models\CommentsModel;
use App\Models\PostsModel;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private function payload($data, $code = 200, $message = 'success')
    {
        return [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
    public function get_posts(Request $request)
    {
        $posts = PostsModel::latest()->paginate(10);
        if ($request->search) {
            $posts = PostsModel::where('title', 'LIKE', '%' . $request->search . '%')->orWhere('content', 'LIKE', '%' . $request->search . '%')->orWhere('description', 'LIKE', '%' . $request->search . '%')->latest()->paginate(10);
        }
        if ($request->limit) {
            $posts = PostsModel::limit((int)$request->limit)->latest()->get();
        }
        return response()->json($this->payload($posts));
    }

    public function get_random_posts()
    {
        $posts = PostsModel::inRandomOrder()->limit(5)->latest()->get();
        return response()->json($this->payload($posts));
    }

    public function read_post($slug)
    {
        $post = PostsModel::where('slug', $slug)->first();
        if (!$post) {
            return response()->json($this->payload([], 401, 'Not Found'));
        }
        return response()->json($this->payload($post));
    }

    public function comments($slug)
    {
        $comments = CommentsModel::where('post_slug', $slug)->latest()->paginate(10);
        return response()->json($this->payload($comments));
    }

    public function post_comment(Request $request, $slug)
    {
        if (!PostsModel::where('slug', $slug)->first()) {
            return response()->json($this->payload([], 403, 'Post Not Found'));
        }
        if ($request->email && $request->name && $request->comment && $slug) {
            $request->merge(['post_slug' => $slug]);
            CommentsModel::create($request->all());
            return response()->json($this->payload($request->all()));
        }
        return response()->json($this->payload([], 402, 'All field cannot be empty'));
    }
    public function get_announcements()
    {
        $announcements = AnnouncementModel::latest()->get();
        return response()->json($this->payload($announcements));
    }
}

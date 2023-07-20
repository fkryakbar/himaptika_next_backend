<?php

namespace App\Http\Controllers;

use App\Models\PostsModel;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function post_slug($collection)
    {
        $posts = PostsModel::where('collection', $collection)->latest()->get(['id', 'title', 'slug', 'description', 'image_path', 'views', 'created_at', 'updated_at']);
        return response([
            'message' => 'Success',
            'data' => $posts
        ]);
    }

    public function read_post($collection, $slug)
    {
        $post = PostsModel::where('collection', $collection)->where('slug', $slug)->first();
        if ($post) {
            return response([
                'message' => 'Success',
                'data' => $post
            ]);
        }
        return response(['message' => 'Not Found'], 404);
    }

    public function add_views($collection, $slug, Request $request)
    {
        $post = PostsModel::where('slug', $slug)->where('collection', $collection)->select(['id', 'title', 'slug', 'description', 'image_path', 'views', 'created_at', 'updated_at'])->first();
        if ($request->number && $post) {
            $view = (int) $post->views + (int) $request->number;
            $request->merge(['views' => $view]);
            $post->update($request->except(['_token', 'number']));
            return response([
                'message' => 'Success',
                'data' => $post
            ]);
        }
        return response([
            'message' => 'Not Found'
        ], 404);
    }
}

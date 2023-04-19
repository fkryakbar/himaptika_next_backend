<?php

namespace App\Http\Controllers;

use App\Models\PostsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
        $posts = PostsModel::latest()->get();
        return view('admin.posts', [
            'posts' => $posts
        ]);
    }

    public function delete($slug)
    {
        $post = PostsModel::where('slug', $slug)->firstOrFail();
        Storage::delete($post->image_path);
        $post->delete();
        return back()->with('msg', 'Post Deleted');
    }

    public function edit($slug)
    {
        $post = PostsModel::where('slug', $slug)->firstOrFail();
        return view('admin.edit_post', [
            'post' => $post
        ]);
    }

    public function post_edit($slug, Request $request)
    {
        $post = PostsModel::where('slug', $slug)->firstOrFail();
        $image_path = $post->image_path;
        $request->validate([
            'title' => ['required', 'max:150'],
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:300',
            'description' => 'required|max:400',
            'content' => 'required',
        ]);

        if ($request->file('image')) {
            Storage::delete($image_path);
            $image_path = $request->file('image')->store('storage');
        }
        $request->merge(['image_path' => $image_path]);
        $post->update($request->except(['_token', 'image']));
        return back()->with('msg', 'Post Saved');
    }

    public function add_new()
    {
        return view('admin.add_post');
    }
    public function post_add_new(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:150', 'unique:posts'],
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:300',
            'description' => 'required|max:400',
            'content' => 'required',
        ]);
        $image_path = $request->file('image')->store('storage');
        $request->merge([
            'author' => Auth::user()->name,
            'slug' => Str::slug($request->title),
            'views' => 0,
            'image_path' => $image_path
        ]);

        PostsModel::create($request->except(['_token', 'image']));
        return back()->with('msg', 'Post Created');
    }
}

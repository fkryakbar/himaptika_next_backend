<?php

namespace App\Http\Controllers;

use App\Models\CommentsModel;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = CommentsModel::latest()->get();
        return view('admin.comments', [
            'comments' => $comments
        ]);
    }

    public function delete($id)
    {
        $comment = CommentsModel::where('id', $id)->firstOrFail();
        $comment->delete();
        return back()->with('msg', 'Comment Deleted');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementModel;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = AnnouncementModel::latest()->get();
        return view('admin.announcement', [
            'announcements' => $announcements
        ]);
    }

    public function delete($id)
    {
        $announcements = AnnouncementModel::where('id', $id)->firstOrFail();
        $announcements->delete();
        return back()->with('msg', 'Announcement Deleted');
    }

    public function new()
    {
        return view('admin.add_announcement');
    }

    public function post_new(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:100'],
            'link' => ['required'],
        ]);

        AnnouncementModel::create($request->except(['_token']));
        return back()->with('msg', 'Announcement Created');
    }

    public function edit($id)
    {
        $announcement = AnnouncementModel::where('id', $id)->firstOrFail();
        return view('admin.edit_announcement', [
            'announcement' => $announcement
        ]);
    }

    public function post_edit(Request $request, $id)
    {
        $announcement = AnnouncementModel::where('id', $id)->firstOrFail();
        $request->validate([
            'title' => ['required', 'max:100'],
            'link' => ['required'],
        ]);
        $announcement->update($request->except(['_token']));
        return back()->with('msg', 'Announcement Saved');
    }
}

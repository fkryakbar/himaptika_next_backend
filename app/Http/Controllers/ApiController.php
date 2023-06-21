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
            'data' => $this->add_assets_url($data)
        ];
    }

    private function add_assets_url($posts)
    {
        if (count($posts) > 0) {
            foreach ($posts as $post) {
                $post->image_path = env('APP_URL') . '/' . $post->image_path;
            }
            return $posts;
        }
        return [];
    }

    public function all_posts()
    {
        $posts = PostsModel::all(['id', 'title', 'slug', 'description', 'image_path', 'views', 'created_at', 'updated_at']);
        return response()->json($this->payload($posts));
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
        if (count($posts) > 0) {
            return response()->json($this->payload($posts));
        }
        return response()->json($this->payload([], 401, 'Post Not found'));
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
        $post->image_path = env('APP_URL') . '/' . $post->image_path;
        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $post
        ]);
    }

    public function comments($slug)
    {
        $comments = CommentsModel::where('post_slug', $slug)->latest()->paginate(10);
        if (count($comments) > 0) {
            return response()->json($this->payload($comments));
        }
        return response()->json($this->payload([], 404, 'Comments Not Found'));
    }

    public function post_comment(Request $request, $slug)
    {
        if (!PostsModel::where('slug', $slug)->first()) {
            return response()->json($this->payload([], 403, 'Post Not Found'));
        }
        if ($request->email && $request->name && $request->comment && $slug) {
            $request->merge(['post_slug' => $slug]);
            CommentsModel::create($request->all());
            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $request->all()
            ]);
        }
        return response()->json($this->payload([], 402, 'All field cannot be empty'));
    }
    public function get_announcements()
    {
        $announcements = AnnouncementModel::latest()->get();
        if (count($announcements) > 0) {
            return response()->json($this->payload($announcements));
        }
        return response()->json($this->payload([], 404, 'Announcement Not Found'));
    }

    private function curl($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($curl);
        curl_close($curl);
        return json_decode($res, 1);
    }

    public function get_youtube_link()
    {
        $responses = $this->curl('https://www.googleapis.com/youtube/v3/search?key=AIzaSyBaGbmB-4iq7hgRiAw2Ammrd2lBtM_jkeo&channelId=UCyH0YbfXsGONS1qxVLnkUMA&maxResults=1&order=date&part=snippet');
        if (isset($responses["items"][0]['id']['videoId'])) {
            $videoid = $responses["items"][0]['id']['videoId'];
        } else {
            $videoid = 'MxRHKpSucYU';
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => [
                'video_id' => $videoid
            ]
        ]);
    }

    public function views(Request $request, $slug)
    {
        $post = PostsModel::where('slug', $slug)->first();
        if ($request->number && $post) {
            $view = (int) $post->views + (int) $request->number;
            $request->merge(['views' => $view]);
            $post->update($request->except(['_token', 'number']));
            return response()->json($this->payload([$post], 200, 'berhasil menambahkan view'));
        }
        return response()->json($this->payload([], 404, 'Menambahkan view gagal'));
    }
}

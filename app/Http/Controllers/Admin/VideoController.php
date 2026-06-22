<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class VideoController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:video.view', only: ['index', 'show']),
            new Middleware('permission:video.create', only: ['create', 'store']),
            new Middleware('permission:video.edit', only: ['edit', 'update']),
            new Middleware('permission:video.delete', only: ['destroy']),
        ];
    }

    private function getYoutubeEmbedUrl($url)
    {
        if (str_contains($url, 'youtu.be/')) {
            $videoId = basename(parse_url($url, PHP_URL_PATH));
            return "https://www.youtube.com/embed/{$videoId}";
        }

        if (str_contains($url, 'youtube.com/watch')) {
            parse_str(parse_url($url, PHP_URL_QUERY), $query);
            return isset($query['v'])
                ? "https://www.youtube.com/embed/{$query['v']}"
                : $url;
        }

        return $url;
    }

    public function index()
    {
        $videos = Video::latest()->paginate(10);
        return view('admin.video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.video.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'url' => 'required|url',
            'category' => 'nullable|string|max:100',
        ]);

        $data = $request->only(['title', 'description', 'url', 'category']);

        // Auto generate embed URL for YouTube
        if (str_contains($data['url'], 'youtube.com') || str_contains($data['url'], 'youtu.be')) {
            $data['embed_url'] = $this->getYoutubeEmbedUrl($data['url']);
        }

        Video::create($data);

        return redirect()->route('admin.videos.index')
            ->with('success', 'ভিডিও সফলভাবে যোগ করা হয়েছে।');
    }

    public function edit(Video $video)
    {
        return view('admin.video.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'url' => 'required|url',
            'category' => 'nullable|string|max:100',
        ]);

        $data = $request->only(['title', 'description', 'url', 'category']);

        if (str_contains($data['url'], 'youtube.com') || str_contains($data['url'], 'youtu.be')) {
            $data['embed_url'] = $this->getYoutubeEmbedUrl($data['url']);
        }

        $video->update($data);

        return redirect()->route('admin.videos.index')
            ->with('success', 'ভিডিও আপডেট করা হয়েছে।');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('admin.videos.index')
            ->with('success', 'ভিডিও মুছে ফেলা হয়েছে।');
    }
}
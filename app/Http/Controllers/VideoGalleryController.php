<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoGallery;


class VideoGalleryController extends Controller
{
    public function index()
    {
        $videos = VideoGallery::paginate(10);
        return view('dashboard.video_gallery', compact('videos'));
    }

    public function store(Request $request)
    {
        \Log::info($request->all());
        $request->validate([
            'title1' => 'required|string|max:255',
            'video1' => 'required|url',
        ]);

        VideoGallery::create($request->all());

        return redirect()->back()->with('success', 'Video Gallery added successfully.');
    }

    public function edit($id)
    {
        $video = VideoGallery::findOrFail($id);
        return response()->json($video);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title1' => 'required|string|max:255',
            'video1' => 'required|url',
        ]);

        $video = VideoGallery::findOrFail($id);
        $video->update($request->all());

        return redirect()->back()->with('success', 'Video Gallery updated successfully.');
    }

    public function destroy($id)
    {
        VideoGallery::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Video Gallery deleted successfully.');
    }
}

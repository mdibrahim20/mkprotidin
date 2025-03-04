<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ads::paginate(10);
        return view('dashboard.ads', compact('ads'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'required|string',
            'url' => 'nullable|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $ad = new Ads();
        $ad->title = $request->title;
        $ad->position = $request->position;
        $ad->url = $request->url;
        $ad->image = $request->file('image')->store('ads', 'public');
        $ad->save();

        return redirect()->back()->with('success', 'Ad added successfully!');
    }

    public function edit($id)
{
    $ad = Ads::findOrFail($id);
    return response()->json($ad);
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'position' => 'required|string',
            'url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $ad = Ads::findOrFail($id);
        $ad->title = $request->title;
        $ad->position = $request->position;
        $ad->url = $request->url;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($ad->image);
            $ad->image = $request->file('image')->store('ads', 'public');
        }

        $ad->save();

        return redirect()->back()->with('success', 'Ad updated successfully!');
    }

    public function destroy($id)
    {
        $ad = Ads::findOrFail($id);
        Storage::disk('public')->delete($ad->image);
        $ad->delete();

        return redirect()->back()->with('success', 'Ad deleted successfully!');
    }
}

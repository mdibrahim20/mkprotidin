<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::paginate(10);
        return view('dashboard.gallery', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info($request->all());
        $request->validate([
            'title1' => 'required|string|max:255',
            'title2' => 'required|string|max:255',
            'title3' => 'required|string|max:255',
            'image1' => 'required|image|mimes:webp,jpeg,png,jpg,gif,svg,avif|max:5054',
            'image2' => 'required|image|mimes:webp,jpeg,png,jpg,gif,svg,avif|max:5054',
            'image3' => 'required|image|mimes:webp,jpeg,png,jpg,gif,svg,avif|max:5054',
        ]);

        $gallery = new Gallery();
        $gallery->title1 = $request->title1;
        $gallery->title2 = $request->title2;
        $gallery->title3 = $request->title3;

        if ($request->hasFile('image1')) {
            $gallery->image1 = $request->file('image1')->store('galleries', 'public');
        }
        if ($request->hasFile('image2')) {
            $gallery->image2 = $request->file('image2')->store('galleries', 'public');
        }
        if ($request->hasFile('image3')) {
            $gallery->image3 = $request->file('image3')->store('galleries', 'public');
        }

        $gallery->save();

        return redirect()->back()->with('success', 'Gallery added successfully.');
    }

    /**
     * Display the specified resource.
     */
     public function show(string $id)
    {
        // Fetch the specific gallery by ID
        $gallery = Gallery::findOrFail($id);
        $galleryList = Gallery::latest()->take(5)->get();

        // Return the view with the data
        return view('gallery', compact('gallery', 'galleryList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return response()->json($gallery);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'title1' => 'required|string|max:255',
        'title2' => 'nullable|string|max:255',
        'title3' => 'nullable|string|max:255',
        'image1' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif,svg|max:2048',
        'image2' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif,svg|max:2048',
        'image3' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $gallery = Gallery::findOrFail($id);
    $gallery->title1 = $request->title1;
    $gallery->title2 = $request->title2;
    $gallery->title3 = $request->title3;

    if ($request->hasFile('image1')) {
        Storage::disk('public')->delete($gallery->image1);
        $gallery->image1 = $request->file('image1')->store('galleries', 'public');
    }
    if ($request->hasFile('image2')) {
        Storage::disk('public')->delete($gallery->image2);
        $gallery->image2 = $request->file('image2')->store('galleries', 'public');
    }
    if ($request->hasFile('image3')) {
        Storage::disk('public')->delete($gallery->image3);
        $gallery->image3 = $request->file('image3')->store('galleries', 'public');
    }

    $gallery->save();

    return redirect()->back()->with('success', 'Gallery updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        Storage::delete('public/' . $gallery->image1);
        Storage::delete('public/' . $gallery->image2);
        Storage::delete('public/' . $gallery->image3);
        $gallery->delete();

        return redirect()->back()->with('success', 'Gallery deleted successfully.');
    }
}

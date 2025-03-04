<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SEOController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('dashboard.seo', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'meta_keywords' => 'nullable|string',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'canonical_url' => 'nullable|url',
        ]);

        $settings = Setting::first();
        if (!$settings) {
            $settings = new Setting();
        }

        $settings->fill($request->except('og_image'));

        if ($request->hasFile('og_image')) {
            // Delete old image if exists
            if ($settings->og_image) {
                Storage::disk('public')->delete($settings->og_image);
            }

            // Store new image
            $settings->og_image = $request->file('og_image')->store('seo', 'public');
        }

        $settings->save();

        return redirect()->back()->with('success', 'SEO Settings updated successfully!');
    }
}

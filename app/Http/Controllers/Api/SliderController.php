<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        return response()->json(Slider::with('image')->where('is_active', true)->get());
    }

    public function show($id)
    {
        return response()->json(Slider::with('image')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'is_active' => 'boolean',
            'image' => 'required|image|max:2048', // Slider must have image
        ]);

        $slider = Slider::create($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('sliders', 'public');
            $slider->image()->create(['file_path' => $path]);
        }

        return response()->json([
            'message' => 'Slider created successfully',
            'data' => $slider->load('image')
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        if (empty($validated) && !$request->hasFile('image')) {
            return response()->json([
                'message' => 'No data to update. If uploading files via PUT, please use POST with _method=PUT.',
            ], 400);
        }

        $slider->update($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('sliders', 'public');
            if ($slider->image) {
                // Delete old image
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($slider->image->file_path)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($slider->image->file_path);
                }
                $slider->image->update(['file_path' => $path]);
            } else {
                $slider->image()->create(['file_path' => $path]);
            }
        }

        return response()->json([
            'message' => 'Slider updated successfully',
            'data' => $slider->load('image')
        ]);
    }

    public function destroy($id)
    {
        Slider::findOrFail($id)->delete();
        return response()->json(['message' => 'Slider deleted successfully']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        return response()->json(Gallery::with('media')->latest()->get());
    }

    public function show($id)
    {
        return response()->json(Gallery::with('media')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable', // Allow 'images' key
            'images.*' => 'image|max:2048', // Validate items if array
        ]);

        \Illuminate\Support\Facades\Log::info('Gallery store started', ['title' => $validated['title']]);
        $gallery = Gallery::create($validated);

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            \Illuminate\Support\Facades\Log::info('Processing gallery images', ['count' => count($images)]);

            if (!is_array($images)) {
                $images = [$images];
            }

            foreach ($images as $index => $file) {
                \Illuminate\Support\Facades\Log::info("Uploading gallery image $index", ['name' => $file->getClientOriginalName()]);
                $path = $file->store('galleries', 'public');
                $gallery->media()->create(['file_path' => $path]);
            }
        }
        \Illuminate\Support\Facades\Log::info('Gallery store completed');

        return response()->json([
            'message' => 'Gallery created successfully',
            'data' => $gallery->load('media')
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable',
            'images.*' => 'image|max:2048',
        ]);

        if (empty($validated) && !$request->hasFile('images')) {
            return response()->json([
                'message' => 'No data to update. If uploading files via PUT, please use POST with _method=PUT.',
            ], 400);
        }

        $gallery->update($validated);

        if ($request->boolean('replace')) {
            foreach ($gallery->media as $media) {
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($media->file_path)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($media->file_path);
                }
                $media->delete();
            }
        }

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            // Normalize to array if it's a single file
            if (!is_array($images)) {
                $images = [$images];
            }

            foreach ($images as $file) {
                $path = $file->store('galleries', 'public');
                $gallery->media()->create(['file_path' => $path]);
            }
        }

        return response()->json([
            'message' => 'Gallery updated successfully',
            'data' => $gallery->load('media')
        ]);
    }

    public function deleteMedia($id, $mediaId)
    {
        $gallery = Gallery::findOrFail($id);
        $media = $gallery->media()->findOrFail($mediaId);

        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($media->file_path)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($media->file_path);
        }
        $media->delete();

        return response()->json([
            'message' => 'Media deleted successfully',
            'data' => $gallery->load('media')
        ]);
    }

    public function destroy($id)
    {
        Gallery::findOrFail($id)->delete();
        return response()->json(['message' => 'Gallery deleted successfully']);
    }
}

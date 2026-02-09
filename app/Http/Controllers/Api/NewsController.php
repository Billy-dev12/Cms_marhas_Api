<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return response()->json(News::with('image')->where('status', 'published')->latest()->get());
    }

    public function show($id)
    {
        return response()->json(News::with('image')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:news,slug',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|max:2048',
        ]);

        $news = News::create($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            $news->image()->create(['file_path' => $path]);
        }

        return response()->json([
            'message' => 'News created successfully',
            'data' => $news->load('image')
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|unique:news,slug,' . $id,
            'content' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:draft,published',
            'image' => 'nullable|image|max:2048',
        ]);

        if (empty($validated) && !$request->hasFile('image')) {
            return response()->json([
                'message' => 'No data to update. If uploading files via PUT, please use POST with _method=PUT.',
            ], 400);
        }

        $news->update($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');
            if ($news->image) {
                // Delete old image
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($news->image->file_path)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($news->image->file_path);
                }
                $news->image->update(['file_path' => $path]);
            } else {
                $news->image()->create(['file_path' => $path]);
            }
        }

        return response()->json([
            'message' => 'News updated successfully',
            'data' => $news->load('image')
        ]);
    }

    public function destroy($id)
    {
        News::findOrFail($id)->delete();
        return response()->json(['message' => 'News deleted successfully']);
    }
}

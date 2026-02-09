<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        return response()->json(Achievement::with('media')->latest('date_achieved')->get());
    }

    public function show($id)
    {
        return response()->json(Achievement::with('media')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'winner_name' => 'required|string|max:255',
            'rank' => 'required|string|max:255',
            'level' => 'required|in:kecamatan,kabupaten,provinsi,nasional,internasional',
            'date_achieved' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $achievement = Achievement::create($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('achievements', 'public');
            $achievement->image()->create(['file_path' => $path]);
        }

        return response()->json([
            'message' => 'Achievement created successfully',
            'data' => $achievement->load('image')
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $achievement = Achievement::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'winner_name' => 'sometimes|required|string|max:255',
            'rank' => 'sometimes|required|string|max:255',
            'level' => 'sometimes|required|in:kecamatan,kabupaten,provinsi,nasional,internasional',
            'date_achieved' => 'sometimes|required|date',
            'description' => 'sometimes|required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if (empty($validated) && !$request->hasFile('image')) {
            return response()->json([
                'message' => 'No data to update. If uploading files via PUT, please use POST with _method=PUT.',
            ], 400);
        }

        $achievement->update($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('achievements', 'public');
            if ($achievement->image) {
                // Delete old image
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($achievement->image->file_path)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($achievement->image->file_path);
                }
                $achievement->image->update(['file_path' => $path]);
            } else {
                $achievement->image()->create(['file_path' => $path]);
            }
        }

        return response()->json([
            'message' => 'Achievement updated successfully',
            'data' => $achievement->load('image')
        ]);
    }

    public function destroy($id)
    {
        Achievement::findOrFail($id)->delete();
        return response()->json(['message' => 'Achievement deleted successfully']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroProfileController extends Controller
{
    /**
     * Get the active Hero Profile.
     */
    public function index()
    {
        // Fetch active hero with media
        $hero = HeroProfile::where('is_active', true)->with('media')->latest()->first();

        if (!$hero) {
            return response()->json(null);
        }

        $url = null;
        if ($hero->media->isNotEmpty()) {
            $media = $hero->media->first();
            $url = $media->url; // Assumes Media model has url accessor, or use Storage

            // Fallback if url accessor is empty but file_path exists
            if (!$url && $media->file_path) {
                $url = asset('storage/' . $media->file_path);
            }

            // Fix double prefix if handled elsewhere
            if ($media->file_path && (\Illuminate\Support\Str::startsWith($media->file_path, 'http'))) {
                $url = $media->file_path;
            }
        }

        return response()->json([
            'id' => $hero->id,
            'title' => $hero->title,
            'is_active' => $hero->is_active,
            'url' => $url,
            // Keep media for debugging if needed, or remove
            // 'media' => $hero->media 
        ]);
    }

    /**
     * Store or Update the Hero Profile (Singleton-like logic).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:2048',
            'title' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        // Deactivate others if this one is active
        if (isset($validated['is_active']) && $validated['is_active']) {
            HeroProfile::where('is_active', true)->update(['is_active' => false]);
        }

        $hero = HeroProfile::create([
            'title' => $validated['title'] ?? 'Default Hero Profile',
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // Upload Image to Media
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('hero_profiles', 'public');
            $hero->media()->create(['file_path' => $path]);
        }

        return response()->json([
            'message' => 'Hero Profile created successfully',
            'data' => $hero->load('media')
        ], 201);
    }

    /**
     * Update existing.
     */
    public function update(Request $request, $id)
    {
        $hero = HeroProfile::findOrFail($id);

        $validated = $request->validate([
            'image' => 'nullable|image|max:2048',
            'title' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        if (isset($validated['is_active']) && $validated['is_active']) {
            HeroProfile::where('id', '!=', $id)->update(['is_active' => false]);
        }

        $hero->update([
            'title' => $validated['title'] ?? $hero->title,
            'is_active' => $validated['is_active'] ?? $hero->is_active,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('hero_profiles', 'public');

            // Delete old media
            if ($hero->media()->exists()) {
                $oldMedia = $hero->media()->first(); // Assumes single image
                if (Storage::disk('public')->exists($oldMedia->file_path)) {
                    Storage::disk('public')->delete($oldMedia->file_path);
                }
                $oldMedia->delete();
            }

            $hero->media()->create(['file_path' => $path]);
        }

        return response()->json([
            'message' => 'Hero Profile updated successfully',
            'data' => $hero->load('media')
        ]);
    }

    public function destroy($id)
    {
        $hero = HeroProfile::findOrFail($id);

        foreach ($hero->media as $media) {
            if (Storage::disk('public')->exists($media->file_path)) {
                Storage::disk('public')->delete($media->file_path);
            }
            $media->delete();
        }

        $hero->delete();
        return response()->json(['message' => 'Hero Profile deleted']);
    }
}

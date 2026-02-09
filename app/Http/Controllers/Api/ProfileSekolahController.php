<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all profiles of type 'profil'
        // 'profil' here specifically means "Identitas Sekolah" or general profile info
        $profiles = Profile::where('type', 'profil')->with('media')->latest()->get();
        return response()->json($profiles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Force type to 'profil'
        $validated['type'] = 'profil';

        $profile = Profile::create($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profiles', 'public');
            $profile->media()->create(['file_path' => $path]);
        }

        return response()->json([
            'message' => 'Profile Sekolah berhasil dibuat',
            'data' => $profile->load('media')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $profile = Profile::where('type', 'profil')->with('media')->findOrFail($id);
        return response()->json($profile);
    }

    /**
     * Update the specified resource in storage.
     * Note: Use POST method for easier file uploads.
     */
    public function update(Request $request, $id)
    {
        $profile = Profile::where('type', 'profil')->findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $profile->update($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profiles', 'public');

            // Logic: Replace existing image (Single Image for Profile)
            if ($profile->media()->exists()) {
                $oldMedia = $profile->media()->first();
                if (Storage::disk('public')->exists($oldMedia->file_path)) {
                    Storage::disk('public')->delete($oldMedia->file_path);
                }
                $oldMedia->delete();
            }

            $profile->media()->create(['file_path' => $path]);
        }

        return response()->json([
            'message' => 'Profile Sekolah berhasil diperbarui',
            'data' => $profile->load('media')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $profile = Profile::where('type', 'profil')->findOrFail($id);

        // Delete media
        foreach ($profile->media as $media) {
            if (Storage::disk('public')->exists($media->file_path)) {
                Storage::disk('public')->delete($media->file_path);
            }
            $media->delete();
        }

        $profile->delete();

        return response()->json(['message' => 'Profile Sekolah berhasil dihapus']);
    }
}

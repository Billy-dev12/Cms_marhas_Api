<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = Profile::query()->with('media');

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        return response()->json($query->get());
    }

    public function profileSekolah()
    {
        $profile = Profile::where('type', 'profil')->with('media')->first();
        return response()->json($profile);
    }

    public function getByType($type)
    {
        $profiles = Profile::where('type', $type)->with('media')->get();
        return response()->json($profiles);
    }

    public function types()
    {
        // Get unique types from the database
        $types = Profile::select('type')->distinct()->pluck('type');
        return response()->json($types);
    }

    public function show($id)
    {
        return response()->json(Profile::with('media')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:sambutan,sejarah,visi_misi,sarana,kurikulum,kontak,profil,struktur,ekstrakurikuler,mitra',
            'content' => 'required|string',
            'extras' => 'nullable|array',
            'image' => 'nullable|image|max:2048',
        ]);

        $profile = Profile::create($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profiles', 'public');
            $profile->media()->create(['file_path' => $path]);
        }

        return response()->json([
            'message' => 'Profile created successfully',
            'data' => $profile->load('media')
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);

        // Note: For file uploads with PUT, use POST with _method=PUT
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|in:sambutan,sejarah,visi_misi,sarana,kurikulum,kontak,profil,struktur,ekstrakurikuler,mitra',
            'content' => 'sometimes|required|string',
            'extras' => 'nullable|array',
            'image' => 'nullable|image|max:2048',
        ]);

        if (empty($validated) && !$request->hasFile('image')) {
            return response()->json([
                'message' => 'No data to update. If uploading files via PUT, please use POST with _method=PUT.',
            ], 400);
        }

        $profile->update($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profiles', 'public');

            // Logic: Multi-Image (Gallery) vs Single Image
            // Sarana & Ekstrakurikuler are treated as Galleries (Multiple Images)
            $isGalleryType = in_array($profile->type, ['sarana', 'ekstrakurikuler']);

            if ($profile->media()->exists() && !$isGalleryType) {
                // SINGLE IMAGE MODE: Replace the existing one
                $oldMedia = $profile->media()->first();
                if ($oldMedia) {
                    if (\Illuminate\Support\Facades\Storage::disk('public')->exists($oldMedia->file_path)) {
                        \Illuminate\Support\Facades\Storage::disk('public')->delete($oldMedia->file_path);
                    }
                    $oldMedia->update(['file_path' => $path]);
                } else {
                    $profile->media()->create(['file_path' => $path]);
                }
            } else {
                // GALLERY MODE or NO IMAGE EXIST: Just Append/Create
                $profile->media()->create(['file_path' => $path]);
            }
        }

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $profile->load('media')
        ]);
    }

    public function destroy($id)
    {
        Profile::findOrFail($id)->delete();

        return response()->json(['message' => 'Profile deleted successfully']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kejuruan;
use Illuminate\Http\Request;

class KejuruanController extends Controller
{
    public function index()
    {
        return response()->json(Kejuruan::with('media')->get());
    }

    public function show($id)
    {
        return response()->json(Kejuruan::with('media')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|unique:kejuruans,slug',
            'deskripsi' => 'nullable|string',
            'visi_misi' => 'nullable|string',
            'ikon' => 'nullable|image|max:1024', // Allow file upload for icon
            'extras' => 'nullable|array',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('ikon')) {
            $validated['ikon'] = $request->file('ikon')->store('jurusan-icons', 'public');
        }

        $kejuruan = Kejuruan::create($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('kejuruans', 'public');
            $kejuruan->media()->create(['file_path' => $path]);
        }

        return response()->json([
            'message' => 'Kejuruan created successfully',
            'data' => $kejuruan->load('media')
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $kejuruan = Kejuruan::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|unique:kejuruans,slug,' . $id,
            'deskripsi' => 'nullable|string',
            'visi_misi' => 'nullable|string',
            'ikon' => 'nullable|image|max:1024',
            'extras' => 'nullable|array',
            'image' => 'nullable|image|max:2048',
        ]);

        if (empty($validated) && !$request->hasFile('ikon') && !$request->hasFile('image')) {
            return response()->json([
                'message' => 'No data to update. If uploading files via PUT, please use POST with _method=PUT.',
            ], 400);
        }

        if ($request->hasFile('ikon')) {
            // Delete old icon if exists
            if ($kejuruan->ikon && \Illuminate\Support\Facades\Storage::disk('public')->exists($kejuruan->ikon)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($kejuruan->ikon);
            }
            $validated['ikon'] = $request->file('ikon')->store('jurusan-icons', 'public');
        }

        $kejuruan->update($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('kejuruans', 'public');

            // Handle polymorphic media update
            if ($kejuruan->media()->exists()) {
                $media = $kejuruan->media()->first();
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($media->file_path)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($media->file_path);
                }
                $media->update(['file_path' => $path]);
            } else {
                $kejuruan->media()->create(['file_path' => $path]);
            }
        }

        return response()->json([
            'message' => 'Kejuruan updated successfully',
            'data' => $kejuruan->load('media')
        ]);
    }

    public function destroy($id)
    {
        $kejuruan = Kejuruan::findOrFail($id);
        $kejuruan->delete();
        return response()->json(['message' => 'Kejuruan deleted successfully']);
    }
}

<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'file' => 'required|image|max:2048',
                'model_type' => 'required|string|in:profile,kejuruan,news,gallery,achievement,slider',
                'model_id' => 'required|integer',
            ]);

            // Map simple type names to actual Model classes
            $modelMap = [
                'profile' => \App\Models\Profile::class,
                'kejuruan' => \App\Models\Kejuruan::class,
                'news' => \App\Models\News::class,
                'gallery' => \App\Models\Gallery::class,
                'achievement' => \App\Models\Achievement::class,
                'slider' => \App\Models\Slider::class,
            ];

            $modelClass = $modelMap[$validated['model_type']];
            $record = $modelClass::findOrFail($validated['model_id']);

            // Handle File Upload
            $folder = \Illuminate\Support\Str::plural($validated['model_type']); // e.g., 'profiles', 'news'
            $path = $request->file('file')->store($folder, 'public');

            // Check if model has 'media' relationship (morphMany) or 'image' (morphOne)
// Most of your models seem to use 'media' or 'image' which returns a morph relation.
// We need to be careful: does the user want to REPLACE the existing image or ADD to it?
// For Gallery, it's likely ADD. For Profile/Kejuruan, it's likely REPLACE (single image).

            $isSingleImage = in_array($validated['model_type'], ['profile', 'kejuruan', 'news', 'achievement', 'slider']);

            if ($isSingleImage) {
                // Delete old image if exists
                if ($record->media()->exists()) {
                    $oldMedia = $record->media()->first();
                    if (Storage::disk('public')->exists($oldMedia->file_path)) {
                        Storage::disk('public')->delete($oldMedia->file_path);
                    }
                    $oldMedia->delete();
                }
                // Create new
                $media = $record->media()->create(['file_path' => $path]);
            } else {
                // For Gallery (multiple images), just add
                $media = $record->media()->create(['file_path' => $path]);
            }

            return response()->json([
                'message' => 'Image uploaded successfully',
                'data' => $media
            ], 201);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Record not found. Please check your model_id.',
                'error' => 'ModelNotFoundException'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to upload image',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
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
                'model_type' => 'required|string|in:profile,kejuruan,news,gallery,achievement,slider,hero_card,mitra,ekstrakurikuler,modal_slider',
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
                'hero_card' => \App\Models\HeroCard::class,
                'mitra' => \App\Models\Mitra::class,
                'ekstrakurikuler' => \App\Models\Profile::class, // Ekstra is a Profile
                'modal_slider' => \App\Models\ModalSlider::class,
            ];

            $modelClass = $modelMap[$validated['model_type']];
            $record = $modelClass::findOrFail($validated['model_id']);

            // Handle File Upload
            $folder = \Illuminate\Support\Str::plural($validated['model_type']);
            $path = $request->file('file')->store($folder, 'public');

            // Force replace for everything EXCEPT Gallery (which adds)
            // Gallery is strictly for adding multiple images
            $forceReplaceTypes = [
                'profile',
                'kejuruan',
                'news',
                'achievement',
                'slider',
                'hero_card',
                'mitra',
                'ekstrakurikuler',
                'modal_slider'
            ];

            $isSingleImage = in_array($validated['model_type'], $forceReplaceTypes);

            if ($isSingleImage) {
                // Determine relationship name: 'media' (morphMany) vs 'image' (morphOne)
                $relationName = method_exists($record, 'media') ? 'media' : 'image';

                // Get query builder
                $query = $record->{$relationName}();

                // Delete old image(s) if exists
                if ($query->exists()) {
                    // Treat as collection to handle both morphOne and morphMany consistently
                    $oldMedias = $query->get(); // get() works for both One and Many relations builders
                    foreach ($oldMedias as $oldMedia) {
                        if (Storage::disk('public')->exists($oldMedia->file_path)) {
                            Storage::disk('public')->delete($oldMedia->file_path);
                        }
                        $oldMedia->delete();
                    }
                }

                // Create new
                // For morphOne, create() works. For morphMany, create() works.
                $media = $record->{$relationName}()->create(['file_path' => $path]);
            } else {
                // For Gallery (multiple images), just add. Assumes 'morphMany' named 'media'
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
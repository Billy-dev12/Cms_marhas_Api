<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HeroCardController extends Controller
{
    public function index()
    {
        return response()->json(HeroCard::orderBy('order')->get());
    }

    public function show($id)
    {
        return response()->json(HeroCard::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'nullable|string',
            'order' => 'integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $card = HeroCard::create([
            'title' => $validated['title'],
            'link' => $validated['link'] ?? null,
            'order' => $validated['order'] ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('herocards', 'public');
            $card->image()->create([
                'file_path' => 'storage/' . $path
            ]);
        }

        return response()->json([
            'message' => 'Hero Card created successfully',
            'data' => $card->load('image')
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $card = HeroCard::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'link' => 'nullable|string',
            'order' => 'integer',
            'image' => 'nullable|image|max:2048', // Image file upload
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('herocards', 'public');

            // Update or Create Media record
            $card->image()->updateOrCreate(
                [],
                [
                    'file_path' => 'storage/' . $path
                ]
            );
        }

        // Remove image from validated data before updating model (column doesn't exist anymore)
        unset($validated['image']);

        $card->update($validated);

        // Reload to include image relationship
        $card->load('image');

        return response()->json([
            'message' => 'Hero Card updated successfully',
            'data' => $card
        ]);
    }
}

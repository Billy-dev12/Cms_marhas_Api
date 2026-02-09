<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ModalSlider;
use Illuminate\Http\Request;

class ModalSliderController extends Controller
{
    public function index()
    {
        return response()->json(ModalSlider::where('is_active', true)->orderBy('order')->get());
    }

    public function show($id)
    {
        return response()->json(ModalSlider::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:2048',
            'title' => 'nullable|string',
            'order' => 'integer'
        ]);

        $modalSlider = ModalSlider::create([
            'title' => $validated['title'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => true
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('modal-sliders', 'public');
            $modalSlider->image()->create([
                'file_path' => 'storage/' . $path
            ]);
        }

        return response()->json($modalSlider->load('image'), 201);
    }

    public function update(Request $request, $id)
    {
        $modalSlider = ModalSlider::findOrFail($id);

        $validated = $request->validate([
            'image' => 'nullable|image|max:2048',
            'title' => 'nullable|string',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('modal-sliders', 'public');
            $modalSlider->image()->updateOrCreate(
                [],
                [
                    'file_path' => 'storage/' . $path
                ]
            );
        }

        unset($validated['image']); // Remove from direct update
        $modalSlider->update($validated);

        return response()->json($modalSlider->load('image'));
    }

    public function destroy($id)
    {
        ModalSlider::destroy($id);
        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inbox;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index()
    {
        return response()->json(Inbox::latest()->get());
    }

    public function show($id)
    {
        return response()->json(Inbox::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $inbox = Inbox::create($validated);

        return response()->json(['message' => 'Message sent successfully', 'data' => $inbox], 201);
    }

    public function destroy($id)
    {
        Inbox::findOrFail($id)->delete();
        return response()->json(['message' => 'Message deleted successfully']);
    }
}

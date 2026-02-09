<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class EkstrakurikulerController extends Controller
{
    public function index()
    {
        $data = Profile::where('type', 'ekstrakurikuler')->with('media')->get();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = Profile::where('type', 'ekstrakurikuler')->with('media')->findOrFail($id);
        return response()->json($data);
    }
}

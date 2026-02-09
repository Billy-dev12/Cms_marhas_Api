<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    public function index()
    {
        $data = Mitra::with('media')->get();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = Mitra::with('media')->findOrFail($id);
        return response()->json($data);
    }
}

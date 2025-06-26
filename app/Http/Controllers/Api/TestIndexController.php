<?php

namespace App\Http\Controllers\Api;

class TestIndexController
{
    public function home()
    {
        return response()->json(['message' => 'Test index endpoint']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(20);

        return view('logs.index', compact('logs'));
    }
}

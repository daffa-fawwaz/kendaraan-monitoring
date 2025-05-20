<?php

namespace App\Helpers;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class LogHelper
{
    public static function add($action, $description)
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => $description,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Heartbeat;

use App\Http\Controllers\Controller;
use App\Models\Heartbeat;
use Illuminate\Http\Request;

class HeartbeatController extends Controller
{
    public function index()
    {
        return Heartbeat::all();
    }

    public function show(Heartbeat $heartbeat)
    {
        return $heartbeat;
    }

    public function store(Request $request)
    {
        if ($request->validate(['time' => 'numeric|required|between:0,5000.0']))
        {
            $heartbeat = Heartbeat::create([
                'user_id' => $request->user()->id,
                'time' => floatval($request->time),
                'heart_rate' => null,
            ]);

            $heartbeat->computeHeartRate(true);

            return response()->json($heartbeat, 201);
        }
        else
        {
            return response()->json(['error' => 'Invalid time'], 400);
        }
    }
}
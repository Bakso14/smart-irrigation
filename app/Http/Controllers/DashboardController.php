<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SensorNode;

class DashboardController extends Controller
{
    public function index()
    {
        $nodes = SensorNode::orderBy('node')->get();
        return view('dashboard', compact('nodes'));
    }

    public function api()
    {
        $nodes = SensorNode::orderBy('node')->get();
        return response()->json($nodes);
    }
}

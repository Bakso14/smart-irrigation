<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('messages.index', compact('messages'));
    }

    public function api()
    {
        $messages = \App\Models\Message::orderBy('created_at', 'desc')->get();
        return response()->json($messages);
    }
}

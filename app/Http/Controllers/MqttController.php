<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Message;
use App\Models\SensorNode;

class MqttController extends Controller
{
    public function receive(Request $request)
    {
        $data = $request->all();

        // Simpan jika data valid
        \App\Models\Message::create([
            'topic' => "Node {$data['Node']}",
            'message' => "Vbat: {$data['tegangan']} | Ibat: {$data['arus']} | Sensor1: {$data['sensor1']} | Sensor2: {$data['sensor2']} | Sensor3: {$data['sensor3']}"
        ]);


        SensorNode::updateOrCreate(
            ['node' => $data['Node']], // cari berdasarkan Node
            [
                'tegangan' => $data['tegangan'],
                'arus' => $data['arus'],
                'sensor1' => $data['sensor1'],
                'sensor2' => $data['sensor2'],
                'sensor3' => $data['sensor3'],
            ]
        );

        return response()->json(['status' => 'ok']);
    }
    
}

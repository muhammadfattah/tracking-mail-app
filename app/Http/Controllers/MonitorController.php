<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index()
    {
        $mail = new Mail();
        return view('admin.aktivitas', [
            'title'     => 'Aktivitas',
            'aktivitas' => $mail->joinAll()
        ]);
    }

    public function aktivitasData()
    {
        $mail = new Mail();
        $data = $mail->joinAll();
        foreach ($data as $d) {
            $d['string_created_at'] = (string)date("Y-m-d H:i:s", strtotime($d['created_at']));
        }
        return json_encode($data);
    }

    public function userOnline()
    {
        return view('admin.user-online', [
            'title' => 'User Online'
        ]);
    }
}

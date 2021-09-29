<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Mail;
use App\Models\User;
use Illuminate\Http\Request;

class EselonTigaController extends Controller
{
    public function index()
    {
        $mail = new Mail();
        return view('eselontiga.index', [
            'title' => 'Surat Masuk',
            'mails' => $mail->joinFromMail(session('user-data')->id)
        ]);
    }

    public function index2()
    {
        $mail = new Mail();
        return view('eselontiga.terkirim', [
            'title' => 'Surat Terkirim',
            'mails' => $mail->joinToMail(session('user-data')->id)
        ]);
    }

    public function datatable()
    {
        $mail = new Mail();
        $data['surat'] = $mail->joinFromMail(session('user-data')->id);
        foreach ($data['surat'] as $d) {
            $d['string_created_at'] = (string)date("Y-m-d H:i:s", strtotime($d['created_at']));
        }
        $data['token'] = csrf_token();
        return json_encode($data);
    }

    public function datatableTerkirim()
    {
        $mail = new Mail();
        $data['surat'] = $mail->joinToMail(session('user-data')->id);
        foreach ($data['surat'] as $d) {
            $d['string_created_at'] = (string)date("Y-m-d H:i:s", strtotime($d['created_at']));
        }
        $data['token'] = csrf_token();
        return json_encode($data);
    }

    public function kirim()
    {
        return view('eselontiga.create', [
            'title'   => 'Kirim Surat',
            'eselon4' => User::all()->where('role', 'Eselon 4')
        ]);
    }

    public function show($id)
    {
        if (Mail::find($id)->from_id != session('user-data')->id) {
            Mail::where('id', $id)->update([
                'is_read' => 1
            ]);
        }

        $mail = new Mail();
        $data = $mail->joinFromMailById($id);
        $data['string_created_at'] = (string)date("Y-m-d H:i:s", strtotime($data['created_at']));
        return json_encode($data);
    }

    public function store(Request $request)
    {
        if (!$request->validate([
            'to_id'   => 'required',
            'subject' => 'required',
            'message' => 'required',
            'surat'   => 'required|file|mimetypes:application/pdf|mimes:pdf|max:10000',
        ])) {
            return back()->withInput();
        } else {
            $fileName = $request->surat->store('public/files');
            $fileId = File::create([
                'filename' => $fileName
            ])->id;
            Mail::create([
                'from_id'         => session('user-data')->id,
                'to_id'           => $request->to_id,
                'subject'         => $request->subject,
                'message'         => $request->message,
                'file_id'         => $fileId,
                'is_read'         => 0,
                'deleted_in_from' => 0,
                'deleted_in_to'   => 0,
            ]);

            return redirect()->to(url('eselon-tiga/terkirim'))->with('message', [
                'icon'  => 'success',
                'title' => 'Surat',
                'text'  => 'Berhasil dikirim!',
                'to_id' => $request->to_id,
            ]);
        }
    }


    public function destroy($id, $jenis)
    {
        if ($jenis == 'penerima') {
            Mail::where('id', $id)->update([
                'deleted_in_to' => 1
            ]);
        } else {
            Mail::where('id', $id)->update([
                'deleted_in_from' => 1
            ]);
        }
        return back()->with('message', [
            'icon'  => 'success',
            'title' => 'Pesan',
            'text'  => 'Berhasil dihapus!'
        ]);
    }
}

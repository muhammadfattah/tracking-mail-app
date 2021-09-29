<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use App\Models\User;
use Illuminate\Http\Request;

class PranataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mail = new Mail();
        return view('pranata.index', [
            'title' => 'Surat Masuk',
            'mails' => $mail->joinFromMail(session('user-data')->id)
        ]);
    }

    public function index2()
    {
        $mail = new Mail();
        return view('pranata.terkirim', [
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

    public function kirim($id)
    {
        $mail = new Mail();
        $mailData = $mail->joinFromMailById($id);
        return view('pranata.create', [
            'title'     => 'Kirim Surat',
            'konseptor' => User::all()->where('role', 'Konseptor'),
            'mail'      => $mailData
        ]);
    }

    public function store(Request $request)
    {
        if (!$request->validate([
            'to_id'   => 'required',
            'subject' => 'required',
            'message' => 'required',
        ])) {
            return back()->withInput();
        } else {
            Mail::create([
                'from_id'         => session('user-data')->id,
                'to_id'           => $request->to_id,
                'subject'         => $request->subject,
                'message'         => $request->message,
                'file_id'         => $request->file_id,
                'is_read'         => 0,
                'deleted_in_from' => 0,
                'deleted_in_to'   => 0,
            ]);

            return redirect()->to(url('pranata/terkirim'))->with('message', [
                'icon'  => 'success',
                'title' => 'Surat',
                'text'  => 'Berhasil dikirim!',
                'to_id' => $request->to_id,
            ]);
        }
    }
}

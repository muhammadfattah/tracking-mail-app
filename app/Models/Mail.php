<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    protected $table      = 'mail';
    protected $primaryKey = 'id';
    public    $timestamps = true;
    protected $fillable   = ['from_id', 'to_id', 'subject', 'message', 'file_id', 'is_read', 'deleted_in_from', 'deleted_in_to', 'created_at', 'updated_at'];



    public function joinAll()
    {
        return $this
            ->select('mail.*', 'receiver.nama as nama_toUser', 'receiver.role as role_toUser', 'sender.nama as nama_fromUser', 'sender.role as role_fromUser')
            ->join('user as receiver', 'mail.to_id', '=', 'receiver.id')
            ->join('user as sender', 'mail.from_id', '=', 'sender.id')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function joinToMail($id)
    {
        return $this
            ->join('user', 'mail.to_id', '=', 'user.id')
            ->where('mail.from_id', $id)
            ->select('user.nama', 'user.role', 'user.gambar', 'mail.*')
            ->orderBy('is_read', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function joinToMailById($id)
    {
        return $this
            ->join('user', 'mail.to_id', '=', 'user.id')
            ->where('mail.id', $id)
            ->select('user.nama', 'user.role', 'user.gambar', 'mail.*')
            ->get()[0];
    }

    public function joinFromMail($id)
    {
        return $this
            ->join('user', 'mail.from_id', '=', 'user.id')
            ->where('mail.to_id', $id)
            ->select('user.nama', 'user.role', 'user.gambar', 'mail.*')
            ->orderBy('is_read', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function joinFromMailById($id)
    {
        return $this
            ->join('user', 'mail.from_id', '=', 'user.id')
            ->where('mail.id', $id)
            ->select('user.nama', 'user.role', 'user.gambar', 'mail.*')
            ->get()[0];
    }
}

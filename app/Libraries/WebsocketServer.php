<?php

namespace App\Libraries;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebsocketServer implements MessageComponentInterface
{
    protected $clients;
    protected $userOnline = [];
    protected $admin;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->admin = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Koneksi (" . $conn->resourceId . ") terhubung\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $pesan = json_decode($msg);
        if ($pesan->keterangan == 'user online') {
            $userOnlineBaru = [
                'id'         => $pesan->data->id,
                'nama'       => $pesan->data->nama,
                'role'       => $pesan->data->role,
            ];
            $this->userOnline[$from->resourceId] = $userOnlineBaru;
            if ($pesan->data->role == 'Admin') {
                $this->admin->attach($from);
            }
            foreach ($this->admin as $a) {
                $a->send(json_encode([
                    'userOnlineBaru'   => $userOnlineBaru,
                    'daftarUserOnline' => $this->userOnline
                ]));
            }
        } else {
            foreach ($this->clients as $client) {
                if ($from !== $client) {
                    $client->send($msg);
                }
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $userOfflineBaru = $this->userOnline[$conn->resourceId];
        $this->clients->detach($conn);
        unset($this->userOnline[$conn->resourceId]);
        foreach ($this->admin as $a) {
            if ($a === $conn) {
                $this->admin->detach($conn);
            } else {
                $a->send(json_encode([
                    'userOfflineBaru'  => $userOfflineBaru,
                    'daftarUserOnline' => $this->userOnline
                ]));
            }
        }
        echo "Koneksi (" . $conn->resourceId . ") terputus\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}

@extends('layouts.admin')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">{{ $title }}</h1>
    </div>
    <div class="card shadow mb-4 border border-primary" id="card-konten">
        <div class="card-header py-3">
            <small class="m-0 font-weight-bold text-primary text-uppercase"><i class="far fa-fw fa-clock"></i>
                <?= $title ?></small>
        </div>
        <div class="card-body">
            <a href="{{ url('user/create') }}" class=" btn btn-primary btn-sm mb-4 tombol-tambah"><i
                    class="fas fa-fw fa-user-plus"></i> Tambah
                Pengguna</a>
            <div class="table-responsive">
                <table class="table table-sm text-center" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Foto</th>
                            <th>Status Aktif</th>
                            <th>Role</th>
                            <th class="text-nowrap"><i class="fas fa-cog fa-fw"></i></th>
                        </tr>
                    </thead>
                    <tbody class="tbody-table">
                        @if (count($users) <= 1)
                            <tr>
                                <td colspan="7" class="font-weight-bold">Tidak ada data pengguna</td>
                            </tr>
                        @else
                            @foreach ($users as $user)
                                @continue($user->role=='Admin')
                                <tr>
                                    <td class="align-middle">{{ $user->id }}</td>
                                    <td class="align-middle">{{ $user->nama }}</td>
                                    <td class="align-middle">{{ $user->username }}</td>
                                    <td class="align-middle">
                                        <img class="rounded-circle" src="{{ url('') }}/img/{{ $user->gambar }}"
                                            style="height: 60px" />
                                    </td>
                                    <td class="align-middle">
                                        <span class="btn btn-dark btn-sm"><i class="fa fa-key"></i>
                                            @if ($user->is_active == 1) Aktif @else Tidak Aktif @endif </span>
                                    </td>
                                    <td class="align-middle">{{ $user->role }}</td>
                                    <td class="text-nowrap align-middle">
                                        <a href="{{ url('user', [$user->id]) }}/edit" class="btn btn-success btn-sm"><i
                                                class="fas fa-edit"></i> Edit</a>
                                        <form action="{{ url('user', [$user->id]) }}" method="POST"
                                            class="d-inline-block tombol-hapus">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

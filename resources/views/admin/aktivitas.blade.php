@extends('layouts.admin')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">{{ $title }}</h1>
    </div>
    <div class="card shadow mb-4 border border-primary" id="card-konten">
        <div class="card-header py-3">
            <small class="m-0 font-weight-bold text-primary text-uppercase"><i class="far fa-fw fa-clock"></i>
                {{ $title }}</small>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm text-center" id="dataTable">
                    <thead>
                        <tr>
                            <th>Aktivitas</th>
                            <th>Pada</th>
                            <th>Subjek</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-table table-aktivitas-admin" data-url="{{ url('aktivitas-data') }}">
                        @if (count($aktivitas) == 0)
                            <tr>
                                <td colspan="3" class="font-weight-bold">Tidak ada data aktivitas</td>
                            </tr>
                        @else
                            @foreach ($aktivitas as $k)
                                <tr>
                                    <td class="align-middle">
                                        <b class="text-primary">{{ $k->nama_fromUser }} ({{ $k->role_fromUser }})</b> mengirim pesan kepada
                                        <b class="text-danger">({{ $k->role_toUser }}) {{ $k->nama_toUser }}</b>
                                    </td>
                                    <td class="align-middle">{{ $k->created_at }}</td>
                                    <td class="align-middle">{{ $k->subject }}</td>

                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

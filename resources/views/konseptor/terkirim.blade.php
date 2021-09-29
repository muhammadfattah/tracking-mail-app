@extends('layouts.konseptor')
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
                <table class="table table-hover table-sm text-center table-hover" id="dataTable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Kepada</th>
                            <th>Subjek</th>
                            <th>Dibaca</th>
                            <th>Dikirim Pada</th>
                            <th class="text-nowrap"><i class="fas fa-cog fa-fw"></i></th>
                        </tr>
                    </thead>
                    <tbody class="tbody-table surat-terkirim" data-url="{{ url('konseptor/datatable-terkirim') }}">
                        @if (count($mails) == 0)
                            <tr>
                                <td colspan="5" class="font-weight-bold">Tidak ada surat terkirim</td>
                            </tr>
                        @else
                            @foreach ($mails as $mail)
                                @continue($mail->deleted_in_from==1)
                                <tr class="text-dark">
                                    <td class="align-middle text-right"><span class="badge badge-warning">Terkirim</span>
                                    <td class="align-middle">{{ $mail->nama }} ({{ $mail->role }})</td>
                                    <td class="align-middle">{{ $mail->subject }}</td>
                                    <td class="align-middle">
                                        @if ($mail->is_read == 1)
                                            <span class="btn btn-success btn-sm">Telah dibaca</span>
                                        @else
                                            <span class="btn btn-dark btn-sm">Belum dibaca</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $mail->created_at }}</td>
                                    <td class="text-nowrap align-middle">
                                        <button class="btn btn-primary btn-sm tombol-detail"
                                            data-url="{{ url('konseptor', [$mail->id]) }}"><i
                                                class="fa fa-fw fa-info-circle"></i>
                                            Detail</button>
                                        <form action="{{ url('konseptor', [$mail->id, 'pengirim']) }}" method="POST"
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

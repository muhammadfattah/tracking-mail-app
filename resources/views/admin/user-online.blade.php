@extends('layouts.admin')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">{{ $title }}</h1>
    </div>
    <div class="col-md-7">
        <div class="card shadow mb-4 border border-primary" id="card-konten">
            <div class="card-header py-3">
                <small class="m-0 font-weight-bold text-primary text-uppercase"><i class="far fa-fw fa-clock"></i>
                    {{ $title }}</small>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover text-center" id="dataTable">
                        <thead>
                            <tr>
                                <th style="width: 100px">Keterangan</th>
                                <th style="width: 50px">ID</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody class="tbody-table table-user-online">
                            <tr>
                                <td class="d-none">Loading...</td>
                                <td class="d-none">Loading...</td>
                                <td colspan="3" class="font-weight-bold">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

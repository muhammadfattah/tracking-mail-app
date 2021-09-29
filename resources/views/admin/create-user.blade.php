@extends('layouts.admin')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">{{ $title }}</h1>
        <span class="d-none d-inline-block"><a href="{{ url('user') }}">Manajemen User</a> / {{ $title }}</span>
    </div>
    <div class="card shadow mb-4 border border-primary" id="card-konten">
        <div class="card-header py-3">
            <small class="m-0 font-weight-bold text-primary text-uppercase"><i class="far fa-fw fa-clock"></i>
                {{ $title }}</small>
        </div>
        <div class="card-body">
            <form action="{{ url('user') }}" method="POST" class="form-submit">
                <?= csrf_field() ?>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label col-form-label-sm text-right">
                        Nama</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror"
                            id="nama" value="{{ old('nama') }}" name="nama">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label col-form-label-sm text-right">
                        Username</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror"
                            id="username" value="{{ old('username') }}" name="username">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pass" class="col-sm-2 col-form-label col-form-label-sm text-right">
                        Password</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm @error('pass') is-invalid @enderror"
                            id="pass" value="{{ '12345' }}" name="pass">
                        @error('pass')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role" class="col-sm-2 col-form-label col-form-label-sm text-right">Role</label>
                    <div class="col-sm-6">
                        <select class="custom-select custom-select-sm @error('role') is-invalid @enderror paket-laundry"
                            id="role" name="role">
                            <option @if (!old('role')) selected @endif value="">-- Pilih Role --</option>
                            <option @if (old('role') == 'Eselon 3') selected @endif value="Eselon 3">Eselon 3</option>
                            <option @if (old('role') == 'Eselon 4') selected @endif value="Eselon 4">Eselon 4</option>
                            <option @if (old('role') == 'Pranata') selected @endif value="Pranata">Pranata</option>
                            <option @if (old('role') == 'Konseptor') selected @endif value="Konseptor">Konseptor</option>
                        </select>
                        @error('role')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-user-plus"></i> Tambah Pengguna
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.pranata')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">{{ $title }}</h1>
        <span class="d-none d-inline-block"><a href="{{ url('user') }}">Surat Terkirim</a> / {{ $title }}</span>
    </div>
    <div class="card shadow mb-4 border border-primary" id="card-konten">
        <div class="card-header py-3">
            <small class="m-0 font-weight-bold text-primary text-uppercase"><i class="far fa-fw fa-clock"></i>
                {{ $title }}</small>
        </div>
        <div class="card-body">
            <form action="{{ url('konseptor') }}" method="POST" class="form-submit tombol-tambah"
                enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="file_id" value="{{ $mail->file_id }}">
                <div class="form-group row">
                    <label for="to_id" class="col-sm-2 col-form-label col-form-label-sm text-right">Kepada</label>
                    <div class="col-sm-6">
                        <select class="custom-select custom-select-sm @error('to_id') is-invalid @enderror" id="to_id"
                            name="to_id">
                            <option @if (!old('to_id')) selected @endif value="">-- Pilih Tujuan --</option>
                            @foreach ($eselon3 as $s)
                                <option @if (old('to_id') == $s->id) selected @endif value="{{ $s->id }}">{{ $s->nama }}
                                    ({{ $s->role }})
                                </option>
                            @endforeach
                        </select>
                        @error('to_id')
                            <div class=" invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="subject" class="col-sm-2 col-form-label col-form-label-sm text-right">
                        Subjek</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm @error('subject') is-invalid @enderror"
                            id="subject" value="{{ old('subject') }}" name="subject">
                        @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="message" class="col-sm-2 col-form-label col-form-label-sm text-right">Pesan</label>
                    <div class="col-sm-6">
                        <textarea id="textarea" class="form-control form-control-sm @error('message') is-invalid @enderror"
                            id="message" autocomplete="off" name="message">{{ old('subject') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row justify-content-end mt-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-fw fa-file-import"></i> Kirim
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

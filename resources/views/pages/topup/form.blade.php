@extends('layouts.auth')

@section('content')
    <main class="login-form mb-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form action="{{ route('topup.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">Top Up</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Pilih Pengguna</label>
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        <option value="">Pilih Salah Satu</option>
                                        @foreach ($users as $key => $item)
                                            <option value="{{ $item }}">{{ $key }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <p class="text-danger small">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nominal Top Up</label>
                                    <input type="number" name="topup" id="topup" class="form-control" min="1000" placeholder="min: 1000" required>
                                    @error('toptup')
                                        <p class="text-danger small">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('topup.index') }}" class="btn btn-warning">Kembali</a>
                                <button type="submit" class="btn btn-success">Proses Top Up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

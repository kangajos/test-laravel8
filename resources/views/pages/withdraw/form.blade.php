@extends('layouts.auth')

@section('content')
    <main class="login-form mb-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form action="{{ route('withdraw.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">Withdraw</div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Pilih Pengguna</label>
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        <option value="">Pilih Salah Satu</option>
                                        @foreach ($balances as $key => $item)
                                            <option value="{{ $item->user->id }}">
                                                {{ "{$item->user->name} (Rp" . number_format($item->value, 0, ',', '.').")" }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <p class="text-danger small">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nominal Withdraw</label>
                                    <input type="number" name="withdraw" id="withdraw" class="form-control" min="1"
                                        placeholder="min: 1000" required>
                                    @error('withdraw')
                                        <p class="text-danger small">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('withdraw.index') }}" class="btn btn-warning">Kembali</a>
                                <button type="submit" class="btn btn-success">Proses Withdraw</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

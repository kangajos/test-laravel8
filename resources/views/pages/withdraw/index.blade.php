@extends('layouts.auth')

@section('content')
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <p class="card-title">Withdraw</p>
                            <a href="{{ route('withdraw.create') }}" class="btn btn-success">Withdraw Baru</a>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Pengguna</th>
                                        <th>Top Up</th>
                                        <th>Tanggal Proses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdraws as $item)
                                        <tr>
                                            <td>
                                                @if ($item->user)
                                                    {{ $item->user->name }}
                                                @endif
                                            </td>
                                            <td>
                                                Rp{{ number_format($item->value, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                {{ $item->created_at->format('d-m-Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($withdraws->links())
                            <div class="card-footer d-flex justify-content-center">{!! $withdraws->links() !!}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

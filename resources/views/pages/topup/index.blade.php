@extends('layouts.auth')

@section('content')
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-header d-flex justify-content-between">
                            <p class="card-title">Top Up</p>
                            <a href="{{ route('topup.create') }}" class="btn btn-success">Top Up Baru</a>
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
                                    @foreach ($topups as $item)
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
                        @if ($topups->links())
                        <div class="card-footer d-flex justify-content-center">{!! $topups->links() !!}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

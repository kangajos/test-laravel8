@extends('layouts.auth')

@section('content')
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Mutasi</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Pengguna</th>
                                        <th>Value</th>
                                        <th>Tipe</th>
                                        <th>Saldo</th>
                                        <th>Tanggal Proses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mutations as $item)
                                        <tr>
                                            <td>
                                                @if ($item->user)
                                                    {{ $item->user->name }}
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="text-{{ $item->type == 'KREDIT' ? 'success' : 'danger' }} fw-bold">{{ $item->type == 'KREDIT' ? '+' : '-' }}Rp{{ number_format($item->value, 0, ',', '.') }}</span>
                                            </td>
                                            <td class="text-{{ $item->type == 'KREDIT' ? 'success' : 'danger' }} fw-bold">
                                                {{ $item->type }}
                                            </td>
                                            <td>
                                                Rp{{ number_format($item->balance, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                {{ $item->created_at->format('d-m-Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($mutations->links())
                            <div class="card-footer d-flex justify-content-center">{!! $mutations->links() !!}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@extends('layouts.auth')

@section('content')
    <main class="login-form mb-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Soal ke 2</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Masukkan Angka</label>
                                <input type="number" name="angka" id="angka" class="form-control" placeholder="contoh: 4"
                                    required>
                                @error('toptup')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <p class="text-success" id="result"></p>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-success" id="button">Cek Duplikasi Huruf</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        const button = document.querySelector("#button");
        const result = document.querySelector("#result");
        button.addEventListener('click',duplikat)

        function duplikat() {
            const url = "{{ route('beginer.tangga') }}"
            const angka = Number(document.querySelector("#angka").value);
            const data = {
                angka: angka
            }
            if (angka > 2) {
                $.get(url, data, function(data, status) {
                    if (status == "success") {
                        result.innerHTML = data
                        return
                    }
                    result.innerHTML = "Terjadi kesalahan :("
                })
            } else {
                alert("Inputan minimal 3")
            }
        }
    </script>
@endsection

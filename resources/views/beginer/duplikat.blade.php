@extends('layouts.auth')

@section('content')
    <main class="login-form mb-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Soal ke 1</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Masukkan Huruf (A - B)</label>
                                <input type="text" name="abc" id="abc" class="form-control text-uppercase" placeholder="contoh: abcddjdjj"
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
            const url = "{{ route('beginer.duplikat') }}"
            const abc = document.querySelector("#abc").value;
            const data = {
                abc: abc
            }
            if (abc) {
                $.get(url, data, function(data, status) {
                    if (status == "success") {
                        result.innerHTML = data
                        return
                    }
                    result.innerHTML = "Terjadi kesalahan :("
                })
            } else {
                alert("Inputan wajib diisi.")
            }
        }
    </script>
@endsection

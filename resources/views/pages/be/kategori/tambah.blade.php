@extends('layouts.admin')

@section('title', 'Kategori')
@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-header">

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('kategori') }}">Kategori</a></div>
                    <div class="breadcrumb-item">List Kategori</div>
                </div>
            </div>

            <a href="" class="btn btn-sm btn-primary mb-3">
                <i class="fas fa-sm fa-arrow-left"></i>
                Kembali
            </a>

            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('kategori.simpan') }}" method="POST" id="form_simpan">
                        @csrf

                        <div class="form-group">
                            <label for="">Nama:</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukan nama">
                        </div>

                        <button class="btn btn-sm btn-primary" type="submit">
                            Simpan
                        </button>
                    </form>
                </div>
            </div>

        </section>
    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#form_simpan').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'), // Form action URL
                    type: $(this).attr('method'), // Form method (POST)
                    data: formData,
                    dataType: 'json', // Expected response type

                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data ditambah',
                                showConfirmButton: false,
                                toast: true,
                                timer: 1500
                            });

                            setTimeout(function() {
                                window.location.href =
                                    '/dashboard/kategori'; // Replace with your desired URL
                            }, 1500);
                        } else {
                            $.each(response.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                            });
                        }
                    },
                });

            });
        });
    </script>
@endpush

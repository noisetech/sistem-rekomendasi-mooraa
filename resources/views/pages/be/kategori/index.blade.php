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


            <div class="card shadow">
                <div class="card-header">
                    <a href="{{ route('kategori.tambah') }}" class="btn btn-sm btn-primary d-flex align-items-center">
                        <i class="fas fa-sm fa-plus-circle mx-1"></i>Tambah
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable"
                            class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline collapsed"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </section>
    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: 10,
                lengthMenu: [
                    [10, 50, 200, -1],
                    [10, 50, 200, "50"]
                ],

                order: [],
                ajax: {
                    url: "{{ route('kategori.data') }}",
                },
                columns: [{
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]
            });
        });


        $(document).on('click', '.hapus', function(e) {
            let id = $(this).attr('data-id');
            Swal.fire({
                title: 'Hapus?',
                text: "Data telah dihapus tidak bisa di kembalikan!",
                icon: 'warning',
                confirmButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('kategori.hapus') }}",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: data.status,
                                    text: data.message,
                                    title: data.title,
                                    toast: true,
                                    position: 'top-end',
                                    timer: 1500,
                                    showConfirmButton: false,
                                });
                                $('#datatable').DataTable().ajax.reload();
                            }
                        },
                    })
                }
            })
        })
    </script>
@endpush

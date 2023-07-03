@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
    <div class="card shadow">
        <div class="card-header">
            <h4 class="card-title">Data Kategori</h4>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end mb-4">
                <a href="{{ url('kategori.create') }}" class="btn btn-primary">Tambah Data</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Data will be populated dynamically using JavaScript --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(function(){

        $.ajax({
            url : '/api/categories',
            success : function ({data}) {
                let row = '';
                data.map(function (val, index){
                    row += `
                    <tr>
                        <td>${index+1}</td>
                        <td>${val.nama_kategori}</td>
                        <td>${val.deskripsi}</td>
                        <td><img src="/image/${val.gambar}" width="100px"></td>
                        <td>
                            <a data-toggle="modal" href="#modal-form" data-id="${val.id}" class="btn btn-warning">Edit</a>
                            <a href="#" data-id="${val.id}" class="btn btn-danger btn-hapus">Hapus</a>
                        </td>
                    </tr>
                    `;
                });

                $('tbody').append(row);
            }
        });

        $(document).on('click', '.btn-hapus', function(){
            const id = $(this).data('id');
            const token = getCookie('token');

            confirm_dialog = confirm('Apakah anda yakin?');


            if (confirm_dialog) {
                $.ajax({
                    url : `/api/categories/${id}`,
                    method : 'DELETE',
                    success : function (data) {
                        alert('Data berhasil dihapus');
                        location.reload();
                    }
                });
            }
        });
    });
</script>
    
@endpush

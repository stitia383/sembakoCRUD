@extends('template')
@section('content')
@section('title', 'Tambah Barang')
<div class="container-fluid">
    <div class="block-header">
        <h2>Tambah Data Barang</h2>
    </div>
    <div class="card bg-secondery p-4 mr-auto ml-auto mt-3" style="width: 500px">
        <form action="{{ route('sembako.store') }}" method="post">
            @csrf
            <div class="form-group form-float">
                <div class="form-line">
                <label for="name" class="col-4 col-form-label">Nama Barang</label>
                <input type="text" name="name" id="name" class="col-8 form-control" required>
            </div>
        </div>
            <div class="form-group form-float">
                <div class="form-line">
                <label for="stock" class="col-4 col-form-label">Stok Barang(gram)</label>
                <input type="text" name="stock" id="stock" class="col-8 form-control" required>
            </div>
        </div>
            <div class="form-group form-float">
                <div class="form-line">
                <label for="exp" class="col-4 col-form-label">Exp Barang</label>
                <input type="date" name="exp" id="exp" class="col-8 form-control selector" required>
            </div>
        </div>
            <div class="form-group form-float">
                <button type="submit" class="btn btn-primary ml-auto mr-2">Simpan Barang</button>
                <button type="button" class="btn btn-danger mr-auto" id="kosong">Kosongkan Inputan</button>
            </div>
        </form>
    </div>
    @endsection
    @section('select-js')
        <script>
            $(document).ready(function(){
                $('#kosong').click(function(){
                    //alert('saas');
                    $('form #name').val('');
                    $('form #exp').val('');
                });
            })
        </script>
</div>
@endsection

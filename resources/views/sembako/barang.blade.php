@extends('template')
@section('content')
@section('title', 'Barang')
<div class="container-fluid">
<div class="block-header">
</div>
 <!-- Browser Usage -->
    <div class="row clearfix">
        <div class="box-header">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        DATA BARANG
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal Input</th>
                                    <th>Stok(gram)</th>
                                    <th>Expired</th>
                                    <th>Kondisi Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($barang as $barangs)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td class="align-items-center">{{ $barangs->name }}</td>
                                    <td>{{ $barangs->created_at }}</td>
                                    <td>{{ $barangs->stock }}</td>
                                    <td>{{ $barangs->exp }}</td>
                                    <td><div class="btn text-uppercase {{ $barangs->bg_alert }}">{{ $barangs->message }}</div></td>
                                    <td>  <form action="{{ route('sembako.destroy',$barangs->id) }}" class=" d-inline-block" method="post">
                                        @csrf
                                        <a href="{{ route('sembako.edit',[$barangs->id,$item_condition]) }}" class="btn btn-info">Edit</a>
                                          @method('DELETE')
                                            <button type="submit" class="btn btn-danger" >Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

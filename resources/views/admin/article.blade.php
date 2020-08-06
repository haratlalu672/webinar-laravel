@extends('layouts.admin._app')
@section('title','Article')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Artikel</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('alert'))
                    <div class="alert alert-success">
                        {{ session('alert') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary" href="article/create" role="button">Tambah Artikel</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Penulis</th>
                                        <th>Judul</th>
                                        <th>Isi Artikel</th>
                                        <th>Thumbnail</th>
                                        <th>Publikasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no=1
                                    @endphp
                                    @forelse ($articles as $article)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $article->user->name }}</td>
                                        <td>{{ $article->title }}</td>
                                        <td>{{ $article->content }}</td>
                                        <td> <img style="width: 80px; height: 100px;"
                                                src="{{ asset("storage/" . $article->thumbnail) }}"></td>
                                        <td>{{ $article->is_published == 1 ? 'Dipublikasikan' : 'Tidak Dipublikasikan'}}
                                        </td>
                                        <td>
                                            <div>
                                                <a href="article/{{ $article->slug }}/edit" class="badge badge-warning"
                                                    role="button" data-original-title="Edit">Edit</i>
                                                </a>
                                                <form id="delete-user" action="article/{{ $article->slug }}" id="user"
                                                    method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="badge badge-danger delete-confirm"
                                                        onclick="return confirm('Yakin mau dihapus?')">
                                                        Hapus</i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        @empty
                                        <span class="badge badge-danger">Data Belum Ada</span>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
</section>
@endsection
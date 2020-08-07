@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>List Artikel</h2>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <form action="/cari" method="GET">
                @csrf
                <div class="form-group d-flex flex-row">
                    <input type="text" class="form-control" name="search" placeholder="Cari Artikel?"
                        value="{{ old('search') }}">
                    <br>
                    <input type="submit" class="btn btn-primary ml-2 inline" value="Cari">
                </div>
            </form>
        </div>
    </div>
    @if (count($articles))
    @if ($search == null)
    @else
    <div class="alert alert-success" role="alert">Hasil pencarian : <b>{{$search}}</b></div>
    @endif
    <hr>
    @foreach ($articles->sortByDesc('updated_at') as $article)
    <div class="media mt-3">
        <a href="/artikel/{{ $article->slug }}">
            <img src="{{ asset("storage/" . $article->thumbnail) }}" class="mr-3" alt="..."
                style="width: 64px; height: 64px;">
        </a>
        <div class="media-body">
            <h5 class="mt-0"><strong>{{ ucwords($article->title) }}</strong></h5>
            {{ ucfirst(Str::limit($article->content, 100)) }}<a href="/artikel/{{ $article->slug }}">Selengkapnya</a>
            <br>
            <small>{{ Carbon\Carbon::parse($article->updated_at)->diffForHumans() }}</small>
        </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center mt-3">
        <div>
            {{ $articles->links() }}
        </div>
    </div>
    @else
    <div class="alert alert-danger ml-3" role="alert">Oops.. Data <b>{{$cari}}</b> Tidak Ditemukan</div>
    @endif
</div>
@endsection
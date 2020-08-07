@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>{{ ucfirst($article->title) }}</h2>
            <small>
                Penulis {{ ucwords($article->user->name) }}
                &middot;
                {{ $article->updated_at->translatedFormat('d F Y') }}
            </small>
        </div>
    </div>
    <hr>
    <img src="{{ asset("storage/" . $article->thumbnail) }}" class="mr-3" alt="..." style="width: 100%; height: 500px;">
    <hr>
    <p>{!! nl2br($article->content) !!}</p>
</div>
@endsection
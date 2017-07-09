@extends('layouts.app')

@section('title') Home @endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('/css/home/styles.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
    @foreach($blogs as $blog)
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if($blog->image)
                <img src="{{ $blog->image->url }}" width="100%" />
                @endif
                <div class="panel-body">
                    <h3>{{ $blog->title }}</h3>
                    <p>{{ $blog->description  }}</p>
                    <p>Posted by <b><a href="{{ @route('user', $blog->user->id) }}">{{ $blog->user->name }}</a></b> - {{ $blog->created_at->diffForHumans() }}</p>
                    <a href="{{ @route('blog', $blog->slug) }}" class="btn btn-primary">Read full article</a>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

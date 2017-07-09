@extends('layouts.app')

@section('title'){{ $blog->title  }}@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.11.0/styles/tomorrow-night.min.css">
    <style>
        pre{
            padding: 0;
        }
        a.tag{
            border: 2px solid #aaa;
            padding: 10px;
            border-radius: 10px;
            color: #333;
            font-weight: 500;
            text-decoration: none;
            transition: border 0.3s;
        }

        a.tag:hover{
            text-decoration: none;
            border: 2px solid #555;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <h1 align="center">{{ $blog->title }}</h1>
            @if($blog->image)
                <img src="{{ $blog->image->url }}" width="100%">
            @endif

            <h5 style="margin-top: 40px;" >{{ $blog->description  }}</h5>
            <h2>Posted by <b><a href="{{ @route('user', $blog->user->id) }}">{{ $blog->user->name }}</a></b> {{ $blog->created_at->diffForHumans() }}</h2>
            <hr>
            @php
                $bool = false;
            @endphp
            @foreach($blog->tags as $tag)
                @php $bool = true; @endphp
            <a href="{{ @route('tag', $tag->slug) }}" class="tag">{{ $tag->name }}</a>
            @endforeach
            @php
            if($bool){
            echo "<hr>";
            }

            @endphp
            
            <article>
                @markdown($blog->body)
            </article>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.11.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endsection
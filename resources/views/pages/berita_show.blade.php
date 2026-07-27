@extends('layouts.site')
@section('title', $post->title)

@section('content')
<div class="section" style="max-width:900px;">
  <p style="color:#666;">
    {{ $post->category->name }} • {{ optional($post->published_at)->format('d M Y') }}
  </p>

  <h1 style="margin:10px 0 14px;">{{ $post->title }}</h1>

  @if($post->thumbnail)
    <img src="{{ asset('uploads/'.$post->thumbnail) }}" style="width:100%;border-radius:14px;margin-bottom:16px;">
  @endif

  <div style="line-height:1.8;color:#222;">
    {!! nl2br(e($post->content)) !!}
  </div>
</div>
@endsection


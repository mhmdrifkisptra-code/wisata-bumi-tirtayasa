@extends('layouts.site')
@section('title','Berita')

@section('content')
<div class="section">
  <h1>Berita</h1>

  <div class="news-grid" style="margin-top:16px;">
    @foreach($posts as $p)
      <a class="news-item" href="{{ route('berita.show',$p->slug) }}" style="text-decoration:none;color:inherit;">
        <div class="news-thumb"
          style="background:#ddd url('{{ $p->thumbnail ? asset('uploads/'.$p->thumbnail) : '' }}') center/cover no-repeat;">
        </div>

        <div class="news-body">
          <div class="news-date">{{ optional($p->published_at)->format('d M Y') }}</div>
          <div class="news-title">{{ $p->title }}</div>
          <div class="news-excerpt">{{ $p->excerpt }}</div>
        </div>
      </a>
    @endforeach
  </div>

  <div style="margin-top:16px;">
    {{ $posts->links() }}
  </div>
</div>
@endsection

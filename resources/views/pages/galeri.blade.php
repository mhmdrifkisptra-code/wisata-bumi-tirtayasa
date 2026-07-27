@extends('layouts.site')

@section('title','Galeri')

@section('content')
<div class="section">
  <h1>Galeri</h1>

  <div class="gallery-grid" style="margin-top:16px;">
    @foreach($items as $g)
      <div class="gallery-item">
        <img src="{{ asset('storage/'.$g->image) }}" alt="{{ $g->title }}">
        <div class="gallery-caption">
          <strong>{{ $g->title }}</strong>
          <div style="color:#666;font-size:13px;">
            {{ $g->description }}
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div style="margin-top:16px;">
    {{ $items->links() }}
  </div>
</div>
@endsection

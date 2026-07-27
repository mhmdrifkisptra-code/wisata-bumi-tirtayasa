@extends('layouts.site')

@section('title', $page->title)

@section('content')
<section class="py-5" style="background: linear-gradient(to bottom, #f8fafc, #ffffff); min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="text-center mb-4">
                    </span>
                    <h1 class="fw-bold mb-3">{{ $page->title }}</h1>
                    <p class="text-muted mb-0">
                        Informasi resmi untuk pengunjung Wisata Bumi Tirtayasa.
                    </p>
                </div>

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div style="height: 6px; background: linear-gradient(90deg, #000000, #000000);"></div>

                   <div class="dynamic-content">

    @if($page->slug == 'aturan')
        @php
            $rules = preg_split('/\r\n|\r|\n/', $page->content);
        @endphp

        <ul class="list-unstyled">
            @foreach($rules as $rule)
                @if(trim($rule) !== '')
                    <li class="d-flex align-items-start mb-3">
                        <span style="
                            width:10px;
                            height:10px;
                            background:#000000;
                            border-radius:50%;
                            display:inline-block;
                            margin-top:8px;
                            margin-right:12px;
                            flex-shrink:0;
                        "></span>

                        <span style="
                            font-size:16px;
                            line-height:1.8;
                            color:#334155;
                        ">
                            {{ trim($rule) }}
                        </span>
                    </li>
                @endif
            @endforeach
        </ul>

    @else

        {!! nl2br(e($page->content)) !!}

    @endif

</div>

                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="btn btn-success px-4 py-2 rounded-pill">
                        Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

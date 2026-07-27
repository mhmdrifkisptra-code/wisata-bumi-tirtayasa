@extends('layouts.site')
@section('title','Pembayaran Tiket')

@section('content')

<style>
  .pay-wrap{max-width:980px;margin:0 auto;padding:28px 16px 40px;}
  .pay-hero{
    position:relative;border-radius:18px;overflow:hidden;
    background:linear-gradient(135deg,#0ea5e9, #22c55e);
    padding:26px 22px;color:#fff;
    box-shadow:0 18px 40px rgba(0,0,0,.12);
  }
  .pay-hero::after{
    content:"";position:absolute;inset:-60px -80px auto auto;
    width:220px;height:220px;border-radius:50%;
    background:rgba(255,255,255,.18);
    filter:blur(0);
  }
  .pay-hero h1{margin:0;font-size:34px;letter-spacing:.2px}
  .pay-hero p{margin:8px 0 0;opacity:.92;max-width:620px}

  .pay-grid{display:grid;grid-template-columns:1.2fr .8fr;gap:18px;margin-top:18px;}
  @media (max-width:900px){.pay-grid{grid-template-columns:1fr}}

  .card{
    background:#fff;border:1px solid #eef2f7;border-radius:16px;
    box-shadow:0 12px 26px rgba(0,0,0,.06);
    overflow:hidden;
  }
  .card-h{padding:16px 18px;border-bottom:1px solid #f1f5f9}
  .card-h h3{margin:0;font-size:18px}
  .card-b{padding:16px 18px}

  .row{display:flex;justify-content:space-between;gap:14px;padding:12px 12px;border-radius:12px;background:#f8fafc;margin-bottom:10px;border:1px solid #eef2f7}
  .row .k{color:#64748b}
  .row .v{font-weight:700}
  .badge{
    display:inline-flex;align-items:center;gap:8px;
    padding:8px 10px;border-radius:999px;font-size:12px;font-weight:700;
    background:#fff; color:#0f172a;border:1px solid rgba(255,255,255,.35)
  }
  .dot{width:9px;height:9px;border-radius:50%}
  .dot.pending{background:#f59e0b}
  .dot.paid{background:#22c55e}
  .dot.cancelled{background:#ef4444}

  .items{margin:0;padding:0;list-style:none;display:flex;flex-direction:column;gap:10px}
  .item{
    display:flex;justify-content:space-between;gap:14px;
    padding:12px 12px;border-radius:12px;border:1px solid #eef2f7;background:#fff;
  }
  .item .name{font-weight:700}
  .item .meta{color:#64748b;font-size:13px;margin-top:2px}
  .item .price{font-weight:800}

  .pay-cta{
    padding:16px 18px;border-top:1px solid #f1f5f9;background:#fbfdff;
    display:flex;flex-direction:column;gap:10px
  }
  .btn-pay{
    appearance:none;border:none;cursor:pointer;
    width:100%;
    padding:14px 16px;border-radius:14px;
    font-weight:800;font-size:16px;color:#fff;
    background:linear-gradient(135deg,#16a34a,#0ea5e9);
    box-shadow:0 14px 26px rgba(14,165,233,.18);
    display:inline-flex;align-items:center;justify-content:center;gap:10px;
    transition:.18s transform ease,.18s filter ease;
  }
  .btn-pay:hover{transform:translateY(-1px);filter:brightness(1.02)}
  .btn-pay:active{transform:translateY(0)}
  .btn-secondary{
    width:100%;text-align:center;display:inline-block;
    padding:12px 14px;border-radius:14px;font-weight:700;
    border:1px solid #e2e8f0;background:#fff;color:#0f172a;
    text-decoration:none
  }
  .hint{font-size:13px;color:#64748b;line-height:1.45;margin:0}
  .mono{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono","Courier New", monospace}
</style>

<div class="pay-wrap">
  <div class="pay-hero">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:14px;flex-wrap:wrap">
      <div>
        <h1>Pembayaran Tiket</h1>
        <p>Silakan lanjutkan pembayaran. Setelah klik <b>Bayar</b>, pilih metode <b>QRIS</b> pada popup Midtrans.</p>
      </div>

      @php
        $st = $booking->status ?? 'pending';
        $dot = $st === 'paid' ? 'paid' : ($st === 'cancelled' ? 'cancelled' : 'pending');
        $label = strtoupper($st);
      @endphp

      <div class="badge">
        <span class="dot {{ $dot }}"></span>
        Status: {{ $label }}
      </div>
    </div>
  </div>

  <div class="pay-grid">

    {{-- KIRI: RINGKASAN --}}
    <div class="card">
      <div class="card-h">
        <h3>Ringkasan Pesanan</h3>
      </div>
      <div class="card-b">
        <div class="row">
          <div class="k">Kode Booking</div>
          <div class="v mono">{{ $booking->code }}</div>
        </div>

        <div class="row">
          <div class="k">Tanggal Kunjungan</div>
          <div class="v">{{ $booking->visit_date }}</div>
        </div>

        <div class="row">
          <div class="k">Total</div>
          <div class="v">Rp {{ number_format($booking->total, 0, ',', '.') }}</div>
        </div>

        <p class="hint" style="margin-top:10px">
          Simpan kode booking di atas. Kode ini dipakai untuk pengecekan/konfirmasi pembayaran.
        </p>
      </div>

      <div class="pay-cta">
        @if(($booking->status ?? 'pending') === 'paid')
          <div class="row" style="margin:0">
            <div class="k">Pembayaran</div>
            <div class="v" style="color:#16a34a">LUNAS</div>
          </div>
          <a class="btn-secondary" href="{{ route('tiket') }}">Kembali ke Tiket</a>
        @else
          <button id="pay-button" class="btn-pay" type="button">
            💳 Bayar Sekarang (QRIS)
          </button>
          <p class="hint">
            Setelah popup muncul: pilih <b>QRIS</b> → scan QR → selesai.
          </p>
          <a class="btn-secondary" href="{{ route('tiket') }}">Kembali</a>
        @endif
      </div>
    </div>

    {{-- KANAN: INFO TAMBAHAN --}}
    <div class="card">
      <div class="card-h">
        <h3>Petunjuk</h3>
      </div>
      <div class="card-b">
        <ol style="margin:0;padding-left:18px;color:#334155;line-height:1.7">
          <li>Klik tombol <b>Bayar Sekarang (QRIS)</b>.</li>
          <li>Pilih metode <b>QRIS</b> di Midtrans.</li>
          <li>Scan QR menggunakan aplikasi e-wallet/banking.</li>
          <li>Setelah sukses, status akan berubah menjadi <b>PAID</b> (nanti kita buat otomatis lewat callback Midtrans).</li>
        </ol>

        <div style="margin-top:14px;padding:12px;border-radius:12px;background:#f8fafc;border:1px solid #eef2f7">
          <div style="font-weight:800;margin-bottom:6px">Catatan</div>
          <div class="hint">
            Jika popup tidak muncul, pastikan browser tidak memblokir pop-up.
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

{{-- Midtrans Snap (SANDBOX) --}}
<script
  src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="{{ config('services.midtrans.client_key') }}">
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('pay-button');
    if(!btn) return;

    btn.addEventListener('click', function () {
      @if(!empty($booking->snap_token))
        window.snap.pay(@json($booking->snap_token), {
          onSuccess: function(result){ console.log('success', result); window.location.reload(); },
          onPending: function(result){ console.log('pending', result); },
          onError: function(result){ console.log('error', result); alert('Pembayaran gagal / dibatalkan. Coba lagi.'); },
          onClose: function(){ console.log('customer closed'); }
        });
      @else
        alert('Snap token belum tersedia. Coba refresh halaman.');
      @endif
    });
  });
</script>

@endsection

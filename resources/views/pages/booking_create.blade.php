@extends('layouts.site')
@section('title','Pesan Tiket')

@section('content')

<style>
  .bk-wrap{max-width:1100px;margin:0 auto;padding:24px 16px 44px;}
  .bk-hero{
    border-radius:18px; overflow:hidden;
    background:linear-gradient(135deg,#0ea5e9,#22c55e);
    color:#fff; padding:22px 20px;
    box-shadow:0 18px 40px rgba(0,0,0,.12);
    position:relative;
  }
  .bk-hero:after{
    content:""; position:absolute; right:-60px; top:-60px;
    width:200px;height:200px;border-radius:50%;
    background:rgba(255,255,255,.18);
  }
  .bk-hero h1{margin:0;font-size:34px}
  .bk-hero p{margin:8px 0 0;opacity:.92;max-width:700px}

  .bk-grid{display:grid;grid-template-columns:1.25fr .75fr;gap:18px;margin-top:18px;}
  @media (max-width:980px){.bk-grid{grid-template-columns:1fr}}

  .card{
    background:#fff;border:1px solid #eef2f7;border-radius:16px;
    box-shadow:0 12px 26px rgba(0,0,0,.06);
    overflow:hidden;
  }
  .card-h{padding:16px 18px;border-bottom:1px solid #f1f5f9}
  .card-h h3{margin:0;font-size:18px}
  .card-b{padding:16px 18px}

  .field{display:flex;flex-direction:column;gap:8px}
  .label{font-weight:800;color:#0f172a}
  .input{
    width:100%; padding:12px 12px; border-radius:12px;
    border:1px solid #e2e8f0; outline:none; background:#fff;
  }
  .input:focus{border-color:#0ea5e9; box-shadow:0 0 0 4px rgba(14,165,233,.12)}

  .tickets{display:grid;grid-template-columns:repeat(2, minmax(0, 1fr));gap:14px;margin-top:12px}
  @media (max-width:760px){.tickets{grid-template-columns:1fr}}

  .t-card{
    border:1px solid #eef2f7;background:#fff;border-radius:14px;
    padding:14px 14px;
    box-shadow:0 10px 18px rgba(0,0,0,.04);
  }

  .t-name{
  font-weight:900;
  font-size:16px;
  margin:0;
  color:#0f172a;

  /* tambahan biar card sejajar */
  min-height:40px;
  line-height:20px;
}

.t-price{
  font-weight:900;
  color:#0ea5e9;
  white-space: nowrap;   /* ✅ biar Rp dan angka tidak turun baris */
}

  .t-top{display:flex;align-items:flex-start;justify-content:space-between;gap:12px}
  .t-muted{color:#64748b;font-size:13px;margin-top:4px}

  .stepper{
    margin-top:12px;
    display:flex;align-items:center;justify-content:space-between;gap:10px;
    background:#f8fafc;border:1px solid #eef2f7;border-radius:12px;
    padding:10px;
  }
  .btn-step{
    width:40px;height:40px;border-radius:12px;
    border:1px solid #e2e8f0;background:#fff;cursor:pointer;
    font-size:18px;font-weight:900;color:#0f172a;
  }
  .btn-step:active{transform:translateY(1px)}
  .qty{
    width:70px;text-align:center;
    padding:10px 10px;border-radius:10px;border:1px solid #e2e8f0;
    font-weight:800;
  }
  .hint{font-size:13px;color:#64748b;margin:0;line-height:1.5}

  .summary-row{
    display:flex;justify-content:space-between;gap:12px;
    padding:12px;border-radius:12px;background:#f8fafc;border:1px solid #eef2f7;
    margin-bottom:10px;
  }
  .summary-row .k{color:#64748b}
  .summary-row .v{font-weight:900}
  .total{
    font-size:20px;font-weight:1000;color:#0f172a;
  }
  .btn-primary{
    width:100%;
    padding:14px 16px;border-radius:14px;border:none;cursor:pointer;
    font-weight:900;font-size:16px;color:#fff;
    background:linear-gradient(135deg,#16a34a,#0ea5e9);
    box-shadow:0 14px 26px rgba(14,165,233,.18);
    display:flex;align-items:center;justify-content:center;gap:10px;
  }
  .btn-primary:hover{filter:brightness(1.02)}
  .err{
    padding:12px;border-radius:12px;background:#fff1f2;border:1px solid #fecdd3;color:#9f1239;
    margin-bottom:12px;
  }
</style>

<div class="bk-wrap">

  <div class="bk-hero">
    <h1>Pesan Tiket</h1>
    <p>Pilih tanggal kunjungan dan jumlah tiket.</p>
  </div>

  <form method="POST" action="{{ route('booking.store') }}">
    @csrf

    <div class="bk-grid">

      {{-- KIRI: FORM --}}
      <div class="card">
        <div class="card-h">
          <h3>Detail Kunjungan</h3>
        </div>
        <div class="card-b">

          @if ($errors->any())
            <div class="err">
              <b>Periksa lagi:</b>
              <ul style="margin:8px 0 0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <div class="field" style="max-width:420px">
            <div class="label">Tanggal Kunjungan</div>
            <input
              type="date"
              name="visit_date"
              class="input"
              value="{{ old('visit_date', date('Y-m-d')) }}"
              required
            >
            <p class="hint">Pilih tanggal kamu akan datang.</p>
          </div>

          <div style="margin-top:18px" class="label">Pilih Tiket</div>
          <p class="hint" style="margin-top:6px">Atur jumlah tiket dengan tombol + / -.</p>

          <div class="tickets">
            @foreach($tickets as $t)
              @php
                $oldQty = old('tickets.'.$t->id, 0);
              @endphp

              <div class="t-card" data-price="{{ (int)$t->price }}">
                <div class="t-top">
                  <div>
                    <p class="t-name">{{ $t->name }}</p>
                    <div class="t-muted">Tersedia</div>
                  </div>
                  <div class="t-price">Rp {{ number_format($t->price, 0, ',', '.') }}</div>
                </div>

                <div class="stepper">
                  <button type="button" class="btn-step js-dec">−</button>

                  <input
                    class="qty js-qty"
                    type="number"
                    min="0"
                    name="tickets[{{ $t->id }}]"
                    value="{{ $oldQty }}"
                  >

                  <button type="button" class="btn-step js-inc">+</button>
                </div>

                <p class="hint" style="margin-top:10px">
                  Subtotal: <b class="js-sub">Rp 0</b>
                </p>
              </div>
            @endforeach
          </div>

        </div>
      </div>

      {{-- KANAN: RINGKASAN --}}
      <div class="card">
        <div class="card-h">
          <h3>Ringkasan</h3>
        </div>
        <div class="card-b">
          <div class="summary-row">
            <div class="k">Tanggal</div>
            <div class="v" id="sum-date">-</div>
          </div>

          <div class="summary-row">
            <div class="k">Total Tiket</div>
            <div class="v" id="sum-qty">0</div>
          </div>

          <div class="summary-row" style="margin-bottom:14px">
            <div class="k">Total Bayar</div>
            <div class="v total" id="sum-total">Rp 0</div>
          </div>

          <button class="btn-primary" type="submit">
            🧾 Lanjut Pembayaran
          </button>

          <p class="hint" style="margin-top:10px">
            Silahkan klik lanjut, untuk melakukan pembayaran.
          </p>
        </div>
      </div>

    </div>
  </form>
</div>

<script>
  function rupiah(n){
    n = Number(n||0);
    return 'Rp ' + n.toLocaleString('id-ID');
  }

  function recalc(){
    let total = 0;
    let qtySum = 0;

    document.querySelectorAll('.t-card').forEach(card => {
      const price = Number(card.dataset.price || 0);
      const qtyInput = card.querySelector('.js-qty');
      let qty = Number(qtyInput.value || 0);
      if (qty < 0) qty = 0;

      const sub = price * qty;
      card.querySelector('.js-sub').textContent = rupiah(sub);

      total += sub;
      qtySum += qty;
    });

    const dateEl = document.querySelector('input[name="visit_date"]');
    const dateVal = dateEl ? dateEl.value : '-';

    document.getElementById('sum-date').textContent = dateVal || '-';
    document.getElementById('sum-qty').textContent = qtySum;
    document.getElementById('sum-total').textContent = rupiah(total);
  }

  document.addEventListener('DOMContentLoaded', () => {
    // stepper
    document.querySelectorAll('.t-card').forEach(card => {
      const qtyInput = card.querySelector('.js-qty');
      const inc = card.querySelector('.js-inc');
      const dec = card.querySelector('.js-dec');

      inc.addEventListener('click', () => {
        qtyInput.value = Number(qtyInput.value || 0) + 1;
        recalc();
      });

      dec.addEventListener('click', () => {
        qtyInput.value = Math.max(0, Number(qtyInput.value || 0) - 1);
        recalc();
      });

      qtyInput.addEventListener('input', recalc);
    });

    const dateEl = document.querySelector('input[name="visit_date"]');
    if (dateEl) dateEl.addEventListener('input', recalc);

    recalc();
  });
</script>

@endsection

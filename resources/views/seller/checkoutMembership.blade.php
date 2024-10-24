@extends('template.MasterDesain')

@section('title', 'Dashboard')

@section('sidebar')

    @include('seller.template.sidebar')

@endsection

@section('navbar')
    @include('seller.template.navbar')
@endsection


@section('content')
<div class="content-wrapper">
    <div class="container py-5">
        <h2 class="fw-bold text-center mb-4">Konfirmasi Pembelian Paket</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header">Detail Pembelian</h5>
                    <div class="card-body">



                        <div class="detail-row">
                            <div class="card text-center h-100">
                                <div class="card-header " style="background-color: #898063;color: white">
                                    <h3 style="color: white">{{$data['paket']}} </h3>
                                </div>
                                <div class="card-body">
                                    <br>
                                    <h5 class="card-title">Rp {{$data['harga']}}</h5>
                                    <p>{{$data['hemat']}}</p>
                                    <input type="text" name="paket" id="" value="paket3" hidden >
                                </div>
                                <div class="card-footer">
                                    <button class="btn  w-100" id="pay-button" style="background-color: #567f5c; color: white">Checkout</button>

                                </div>
                            </div>
                        </div>






                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
    </script>
    <script>

        let data = @json($data);
        let donation = @json($pembayaran);
        @if ($pembayaran)
            document.getElementById('pay-button').addEventListener('click', function() {
                snap.pay('{{ $pembayaran->snap_token }}', {
                    onSuccess: function(result) {
                        $.ajax({
                        url: '{{ route('checkout') }}', // URL ke route untuk update membership
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            paymentResult: result,
                            paket: data.harga, // Data paket yang dipilih
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                window.location.href = '{{ url('/seller') }}'; // Redirect ke dashboard
                            } else {
                                alert('Pembayaran berhasil, tapi ada masalah dalam pembaruan membership.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat memperbarui membership.');
                        }
                    });
                    },
                    onPending: function(result) {
                        alert("waiting your payment!");
                        console.log(result);
                    },
                    onError: function(result) {

                    },
                    onClose: function(){
                        alert('kemu menututp popup tanpa menyelesaikan pembayaran');
                    }
                });
            });
        @endif
    </script>
@endsection

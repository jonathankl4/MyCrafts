@extends('welcome')


@section('content')


<div>

    <div>
        <p>code ={{$data->code}} </p>
        <p>email ={{$data->email}} </p>
        <p>amount ={{$data->amount}} </p>
        <p>note ={{$data->note}} </p>
    </div>
    <button id="pay-button">
        BAYAR SEKARANG
    </button>
</div>
@endsection



@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
      // SnapToken acquired from previous step
      snap.pay('{{ $data->snap_token }}', {
        // Optional
        onSuccess: function(result){
          /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onPending: function(result){
          /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onError: function(result){
          /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        }
      });
    };
  </script>
@endsection

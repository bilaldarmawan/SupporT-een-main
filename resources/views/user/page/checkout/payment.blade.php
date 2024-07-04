@extends('user.layout.index')

@section('content')
<div class="container mt-5">
    <h2>{{ $title }}</h2>
    <div id="payment-button"></div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script type="text/javascript">
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result) {
            window.location.href = '{{ route('checkout.finish') }}';
        },
        onPending: function(result) {
            window.location.href = '{{ route('checkout.unfinish') }}';
        },
        onError: function(result) {
            window.location.href = '{{ route('checkout.error') }}';
        }
    });
</script>
@endsection

@extends('welcome')

@section('content')
<main class="py-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 col-12">
                <h2 class="fs-5 py-4 text-center">
                    Integrasi Midtrans dengan Laravel
                </h2>
                <div class="card border rounded shadow">
                    <div class="card-body">
                        <form id="donation-form">
                            <div class="row mb-3">
                                <div class="col-md-6 mb-2">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" id="amount" name="amount" value="{{ old('amount') }}" class="form-control @error('amount') is-invalid @enderror" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="note" class="form-label">Note</label>
                                    <textarea name="note" id="note" cols="30" rows="5" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" id="pay-button">Pay</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
        <script type="text/javascript">
            $('#pay-button').click(function (event) {
            event.preventDefault();

            $.post("{{ route('donation.pay') }}", {
                _method: 'POST',
                _token: '{{ csrf_token() }}',
                name: $('#name').val(),
                email: $('#email').val(),
                amount: $('#amount').val(),
                note: $('#note').val()
            }
            );
            });
        </script>
@endsection

@extends("dashboard")

@section('title', "Каса")

@section("dashboard-data")

    <div class="row">
        <div class="col-6">
        </div>
    </div>
    <div class="row overflow-auto">
        <div class="col-8">
            <div class="card w-100 border-rounded p-4">
                <h5 class="fw-bold text-center">Підтвердження операції</h5>
                <hr>
                <div class="row">
                    <div class="col-4 text-center">
                        <div class="d-flex flex-column justify-content-center my-3">
                            {{ $from_currency }}
                        </div>
                        <div class="d-flex flex-column justify-content-center my-3">
                            {{ $from_amount }}
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <form action="{{ route("refresh-exchange") }}" method="POST" id="exchange_form">
                            @csrf
                            <input value="{{ $point_id }}" name="point_id" hidden required>
                            <input value="{{ $from_currency_id }}" name="from_currency" hidden required>
                            <input value="{{ $from_amount }}" name="from_amount" hidden required>
                            <input value="{{ $to_currency_id }}" name="to_currency" hidden required>
                            <input value="{{ $to_amount }}" name="to_amount" hidden required>
                            <input value="{{ $rate }}" name="rate" required>
                        </form>
                    </div>
                    <div class="col-4 text-center">
                        <div class="d-flex flex-column justify-content-center my-3">
                            {{ $to_currency }}
                        </div>
                        <div class="d-flex flex-column justify-content-center my-3">
                            {{ $to_amount }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 text-center">
                        <a href="{{ route("exchange") }}" class="button danger mx-3">
                            <i class="fa-solid fa-times me-2"></i>
                            Скасувати
                        </a>
                    </div>
                    <div class="col-4 text-center">
                        <button type="submit" class="button mx-3" form="exchange_form">
                            <i class="fa-solid fa-refresh me-2"></i>
                            Оновити
                        </button>
                    </div>
                    <div class="col-4 text-center">
                        <form action="{{ route("cash-exchange") }}" method="POST">
                            @csrf
                            <input value="{{ $point_id }}" name="point_id" hidden required>
                            <input value="{{ $from_currency_id }}" name="from_currency" hidden required>
                            <input value="{{ $from_amount }}" name="from_amount" hidden required>
                            <input value="{{ $to_currency_id }}" name="to_currency" hidden required>
                            <input value="{{ $to_amount }}" name="to_amount" hidden required>
                            <input value="{{ $rate }}" name="rate" hidden required>
                            <button class="button success mx-3">
                                <i class="fa-solid fa-money-bill-wave me-2"></i>
                                Підтвердити
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

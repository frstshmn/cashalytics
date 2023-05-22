@extends("dashboard")

@section('title', "Каса")

@section("dashboard-data")

@if(isset($message))
    <div class="alert alert-{{$type}} alert-dismissible fade show" role="alert">
        {{ $message }}
    </div>
@endif

<div class="row">
    <div class="col-6">
        <h2 class="fw-bold">{{ $point->title }}</h2>
    </div>
</div>
<div class="row overflow-auto">
    <div class="col-8">
        <div class="card w-100 border-rounded p-4">
            <h5 class="fw-bold">Нова операція</h5>
            <div class="d-flex flex-column justify-content-center my-3">
                <form class="d-flex flex-column mt-3" action="{{ route("confirm-exchange") }}" method="GET">
                    @csrf
                    <input value="{{ $point->id }}" name="point_id" hidden required>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <input type="number" class="input" placeholder="Сума" name="amount" required>
                        <select class="select rounded-corner" aria-label="Small select" name="from_currency_id" required>
                            <option selected>Валюта</option>
                            @foreach($point->availableCurrencies() as $currency)
                                <option value="{{ $currency->currency->id }}">{{ $currency->currency->code }}</option>
                            @endforeach
                        </select>

                        <span><i class="fa-solid fa-arrow-right"></i></span>

                        <select class="select rounded-corner" aria-label="Small select" name="to_currency_id" required>
                            <option selected>Валюта</option>
                            @foreach($point->availableCurrencies() as $currency)
                                <option value="{{ $currency->currency->id }}">{{ $currency->currency->code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="button mx-3">
                        <i class="fa-solid fa-money-bill-wave me-2"></i>
                        Обмін
                    </button>
                </form>
                <hr>

                <form class="d-flex mt-3" action="{{ route("cash-income") }}" method="POST">
                    @csrf
                    <input type="number" class="input" placeholder="Сума" name="amount" required>
                    <input value="{{ $point->id }}" name="point_id" hidden required>
                    <select class="select rounded-corner" aria-label="Small select" name="currency_id" required>
                        <option selected>Валюта</option>
                        @foreach($point->availableCurrencies() as $currency)
                            <option value="{{ $currency->currency->id }}">{{ $currency->currency->code }}</option>
                        @endforeach
                    </select>
                    <button class="button success mx-3" type="submit">
                        <i class="fa-solid fa-plus me-2"></i>
                        Підкріплення
                    </button>
                </form>

                <form class="d-flex mt-3" action="{{ route("cash-withdraw") }}" method="POST">
                    @csrf
                    <input type="number" class="input" placeholder="Сума" name="amount" required>
                    <input value="{{ $point->id }}" name="point_id" hidden required>
                    <select class="select rounded-corner" aria-label="Small select" name="currency_id" required>
                        <option selected>Валюта</option>
                        @foreach($point->availableCurrencies() as $currency)
                            <option value="{{ $currency->currency->id }}">{{ $currency->currency->code }}</option>
                        @endforeach
                    </select>
                    <button class="button danger mx-3" type="submit">
                        <i class="fa-solid fa-minus me-2"></i>
                        Інкасація
                    </button>
                </form>

            </div>
        </div>

        <div class="card w-100 border-rounded">
            <h5 class="fw-bold p-4 pb-3">Останні операції</h5>

{{--            <div class="filters d-flex justify-content-between background-dark p-4">--}}
{{--                <div class="d-flex">--}}
{{--                    <div class="d-flex flex-column me-2">--}}
{{--                        <label class="text-white pb-1 text-center">Купили</label>--}}
{{--                        <select class="select rounded-corner" aria-label="Small select">--}}
{{--                            <option selected="">Всі валюти ▿</option>--}}
{{--                            <option value="1">UAH</option>--}}
{{--                            <option value="2">USD</option>--}}
{{--                            <option value="3">EUR</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <div class="d-flex flex-column ms-2">--}}
{{--                        <label class="text-white pb-1 text-center">Продали</label>--}}
{{--                        <select class="select rounded-corner" aria-label="Small select">--}}
{{--                            <option selected="">Всі валюти ▿</option>--}}
{{--                            <option value="1">UAH</option>--}}
{{--                            <option value="2">USD</option>--}}
{{--                            <option value="3">EUR</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <a class="button h-100 my-auto" href=""><i class="fa-solid fa-magnifying-glass me-2"></i> Застосувати </a>--}}
{{--            </div>--}}
            <div class="operations d-flex flex-column p-4">
                @foreach($operations as $operation)
                    <div class="operation d-flex justify-content-between">
                        <div>
                            @if(isset($operation->income_currency_id))
                                <span class="color-success me-5">+{{ $operation->income_amount }} {{ $operation->getCurrencyCode($operation->income_currency_id) }}</span>
                            @endif

                            @if(isset($operation->outcome_currency_id))
                                <span class="color-danger">-{{ $operation->outcome_amount }} {{ $operation->getCurrencyCode($operation->outcome_currency_id) }}</span>
                            @endif

                            <span class="text-black-50">{{ $operation->rate }}</span>
                        </div>
                        <span class="color-muted">{{ $operation->created_at }}</span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <div class="col-4">
        <div class="card w-100 border-rounded p-4 py-5">
            <table class="text-center">
                <thead>
                <tr>
                    <th>Купівля</th>
                    <th>Валюта</th>
                    <th>Продаж</th>
                </tr>
                </thead>
                <tbody class="rates">
                @foreach( $point->rates as $rate)
                    <tr>
                        <td>{{ $rate->buy_price }}</td> <td>{{ str_replace("/", " / ", $rate->pair->title) }}</td> <td>{{ $rate->sell_price }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card w-100 border-rounded p-4">
            <h5 class="fw-bold">Каса</h5>
            <table class="text-center table table-striped">
                <thead>
                <tr>
                    <th>Валюта</th>
                    <th>Наявність</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $point->cash as $cash)
                    <tr>
                        <td>{{ $cash->currency->code }}</td> <td>{{ $cash->amount }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@extends("dashboard")

@section('title', "Операції")

@section("dashboard-data")

    @if(isset($message))
        <div class="alert alert-{{$type}} alert-dismissible fade show" role="alert">
            {{ $message }}
        </div>
    @endif

    <div class="row">
        <div class="col-6">
            <h2 class="fw-bold">Операції пункту {{ $point->title }}</h2>
        </div>
    </div>
    <div class="row overflow-auto">
        <div class="col-12 operations">
            <div class="card w-100 border-rounded p-4 mb-4">
                <form class="row" action="{{ route("operations") }}" method="GET">
                    @csrf
                    <div class="col-3">
                        <div class="card card-dark border-rounded p-3">
                            <div class="card-header">
                                <h5 class="fw-bold text-white">Купівля</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <input type="number" class="input bg-white w-100" placeholder="Від" name="income_amount_min" value="{{ $filter["income_amount_min"] }}">
                                </div>
                                <select class="select rounded-corner w-100 mb-3" aria-label="Small select" name="income_currency_id" required>
                                    <option selected>Валюта</option>
                                    @foreach($point->availableCurrencies() as $currency)
                                        <option value="{{ $currency->currency->id }}">{{ $currency->currency->code }}</option>
                                    @endforeach
                                </select>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <input type="number" class="input bg-white w-100" placeholder="До" name="income_amount_max" value="{{ $filter["income_amount_max"] }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-dark border-rounded p-3">
                            <div class="card-header">
                                <h5 class="fw-bold text-white">Продаж</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <input type="number" class="input bg-white w-100" placeholder="Від" name="{{ $filter["outcome_amount_min"] }}">
                                </div>
                                <select class="select rounded-corner w-100 mb-3" aria-label="Small select" name="outcome_currency_id" required>
                                    <option selected>Валюта</option>
                                    @foreach($point->availableCurrencies() as $currency)
                                        <option value="{{ $currency->currency->id }}">{{ $currency->currency->code }}</option>
                                    @endforeach
                                </select>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <input type="number" class="input bg-white w-100" placeholder="До" name="{{ $filter["outcome_amount_max"] }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-dark border-rounded p-3">
                            <div class="card-header">
                                <h5 class="fw-bold text-white">Курс</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <input type="number" class="input bg-white w-100" placeholder="Значення" name="{{ $filter["rate"] }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card card-dark border-rounded p-3">
                            <div class="card-header">
                                <h5 class="fw-bold text-white">Дата</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <input type="date" class="input bg-white" name="date_time" value="{{ $filter["date_time"] }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="button mt-3">
                            <i class="fa-solid fa-search me-2"></i>
                            Застосувати
                        </button>
                        <a href="{{ route("operations") }}" class="button mt-3">
                            <i class="fa-solid fa-brush me-2"></i>
                            Очистити
                        </a>
                    </div>
                </form>
            </div>
            <div class="card w-100 border-rounded p-4">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">+</th>
                        <th scope="col">-</th>
                        <th scope="col">Курс</th>
                        <th scope="col">Дата</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($operations as $operation)
                        <tr>
                            <td>
                                @if(isset($operation->income_currency_id))
                                    <span class="color-success">+{{ $operation->income_amount }}</span>
                                    <span class="color-success">{{ $operation->getCurrencyCode($operation->income_currency_id) }}</span>
                                @endif
                            </td>
                            <td>
                                @if(isset($operation->outcome_currency_id))
                                    <span class="color-danger">-{{ $operation->outcome_amount }}</span>
                                    <span class="color-danger">{{ $operation->getCurrencyCode($operation->outcome_currency_id) }}</span>
                                @endif
                            </td>
                            <td>{{ $operation->rate }}</td>
                            <td>{{ $operation->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
            </div>
        </div>
    </div>

@endsection

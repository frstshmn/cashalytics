@extends("dashboard")

@section('title', "Курси")


@section("dashboard-data")

    <div class="row">
        <div class="col-6">
            <h2 class="fw-bold">Курси</h2>
        </div>
    </div>
    <div class="row overflow-auto">
        <div class="col-12">
            <div class="row">
                <div class="col-6">
                    <form method="POST" action="/rates">
                        @csrf
                        <div class="card w-100 border-rounded p-4 py-5">
                            <div class="rates-editor">
                                <div class="rates-editor-header">
                                    <span>Купівля</span>
                                    <span>Валюта</span>
                                    <span>Продаж</span>
                                </div>
                                <div class="rates-editor-body">
                                    @foreach( $currency_pairs as $currency_pair )
                                        <div class="rates-editor-row">
                                            <input type="checkbox" name="pairs[]" value="{{$currency_pair->id}}" hidden checked>
                                            <span><input class="input border-0 rate-input" name="buy-{{$currency_pair->id}}" type="number" value="0.00" step="0.001"></span>
                                            <span class="h5">{{$currency_pair->title}}</span>
                                            <span><input class="input border-0 rate-input" name="sell-{{$currency_pair->id}}" type="number" value="0.00" step="0.001"></span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <p class="text-muted mt-5 px-4"><small>Оберіть пункти, до яких застосувати курси</small></p>
                            <div class="d-flex px-4">
                                <div class="button select-all small me-2" id="check_all_points"><i class="fa-solid fa-check-double"></i> Вибрати всі</div>
                                <div class="button select-clear small" id="clear_all_points"><i class="fa-solid fa-broom"></i> Очистити</div>
                            </div>
                            <div class="rate-points mt-3 px-4 ms-3">
                                @foreach( $points as $point )
                                    <div class="rate-point d-inline">
                                        <input id="point_{{$point->id}}" type="checkbox" name="points[]" value="{{$point->id}}">
                                        <label for="point_{{$point->id}}">{{$point->title}}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex px-4 mt-5 mx-auto">
                                <button class="button select-all me-2"><i class="fa-solid fa-check" type="submit"></i> Застосувати</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <div class="card card-dark border-rounded p-5 currency-pairs-add">
                        <h5 class="fw-bold text-white pb-3">Додати валютну пару</h5>
                        <form action="/currency-pairs" method="POST">
                            @csrf
                            <div class="d-flex align-items-center mb-3">
                                <div class="select">
                                    <select class="input" name="currency_1" required>
                                        <option disabled selected>Валюта 1</option>
                                        @foreach( $currencies as $currency )
                                            <option value="{{$currency->id}}">{{$currency->code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <i class="fa-solid fa-arrow-right-arrow-left text-white ms-1"></i>
                                <div class="ms-3 select">
                                    <select class="input" name="currency_2" required>
                                        <option disabled selected>Валюта 2</option>
                                        @foreach( $currencies as $currency )
                                            <option value="{{$currency->id}}">{{$currency->code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input class="input fw-bold" name="title" placeholder="Заголовок">
                            <button class="button success ms-3" type="submit"><i class="fa-solid fa-plus me-2"></i>Додати</button>
                            <p class="text-muted mt-3 mb-0"><small>У полі заголовку можна вказати назву валютної пари, яка буде відображатись в системі</small></p>
                        </form>

                    </div>
                    <div class="card border-rounded p-5">
                        <h5 class="fw-bold">Валютні пари</h5>
                        <p class="text-muted mb-3 mt-0"><small>Змінити назву валютної пари можна зразу у полі назви, не забудьте зберегти зміни</small></p>
                        <table>
                            <thead>
                            <tr>
                                <th>Назва</th>
                                <th>Пара</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $currency_pairs as $currency_pair )
                                <tr>
                                    <td>
                                        <form action="/currency-pairs/{{$currency_pair->id}}" method="POST" class="changeable">
                                            @csrf @method("PUT")
                                            <input class="editable" name="title" value="{{ $currency_pair->title }}" data-original="{{ $currency_pair->title }}">
                                            <button type="submit" class="button-outline"><i class="fa-solid fa-floppy-disk"></i></button>
                                        </form>
                                    </td>
{{--                                    <td>{{$currency_pair->getCurrencies()[0]->code}} / {{$currency_pair->getCurrencies()[1]->code}}</td>--}}
                                    <td>
                                        <form action="/currency-pairs/{{$currency_pair->id}}" method="POST" class="confirmation" data-confirmation='Ви дійсно хочете видалити пару "{{$currency_pair->title}}"'>
                                            @csrf @method("DELETE")
                                            <button type="submit" class="button-outline danger"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

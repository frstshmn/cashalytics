@extends("dashboard")

@section('title', 'Загальна')

@section("dashboard-data")

<div class="row">
    <div class="col-12 d-flex justify-content-between">
        <h2 class="fw-bold m-0">Загальне</h2>
        <div>
            <form method="GET">
                <span>з</span>
                <input type="date" name="date_from" value="@php echo(date("Y-m-d", strtotime("-1 month"))) @endphp">
                <span>по</span>
                <input type="date" name="date_to" value="@php echo(date("Y-m-d")) @endphp">
                <button class="button" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>
</div>
<div class="row overflow-auto">
    <div class="col-6">
        <div class="row">
            <div class="col-6">
                <div class="card border-rounded p-4">
                    <h5 class="fw-bold">Загальний дохід</h5>
                    <p class="color-success">545000</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card w-100 border-rounded p-4">
                    <h5 class="fw-bold">Середній курс</h5>
                    <table class="text-center mt-3">
                        <thead>
                        <tr>
                            <th>Валюта</th>
                            <th>Купівля</th>
                            <th>Продаж</th>
                        </tr>
                        </thead>
                        <tbody class="">
                        <tr>
                            <td>USD 🇺🇸</td><td>35.50</td><td>35.60</td>
                        </tr>
                        <tr>
                            <td>EUR 🇪🇺</td><td>35.50</td><td>35.60</td>
                        </tr>
                        <tr>
                            <td>PLN 🇵🇱</td><td>35.50</td><td>35.60</td>
                        </tr>
                        <tr>
                            <td>CZK 🇨🇿</td><td>35.50</td><td>35.60</td>
                        </tr>
                        <tr>
                            <td>GBP 🇬🇧</td><td>35.50</td><td>35.60</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card w-100 border-rounded p-4">

        </div>
    </div>
</div>

@endsection

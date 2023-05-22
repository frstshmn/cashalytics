@extends("dashboard")

@section('title', 'Пункти')

@section("dashboard-data")

    <div class="row">
        <div class="col-6">
            <h2 class="fw-bold">Пункти</h2>
        </div>
    </div>
    <div class="row overflow-auto">
        <div class="col-12">
            <div class="row points">
                @foreach( $points as $point )
                    <div class="col-4">
                        <div class="card border-rounded my-4">
                            <div class="card-top background-dark text-white p-4">
                                <div class="h4 fw-bold">{{ $point->title }}</div>
                                <div class="text-white-50">Група: {{ $point->group->title }}</div>
                                @if( $point->is_open == 1 )
                                    <span class="color-success fw-bold">Відкрито</span>
                                @else
                                    <span class="color-danger fw-bold">Закрито</span>
                                @endif
                            </div>
                            <div class="card-bottom">
                                @if ($point->employee_id)
                                    <div class="d-flex align-items-center justify-content-between px-4 py-2">
                                        <span class="cashier" data-letter="{{ strtoupper(substr($point->employee->first_name, 0, 1)) }}">
                                            {{ $point->employee->last_name }} {{ $point->employee->first_name }}
                                        </span>
                                        @if ($point->employee_id == Auth::user()->id)
                                            <form method="POST" action="{{ route("point-logout") }}">
                                                @csrf
                                                <input type="text" name="point_id" hidden value="{{ $point->id }}">
                                                <button class="button-outline danger" type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
                                            </form>
                                        @endif
                                    </div>

                                @else
                                    <form method="POST" class="d-flex p-4" action="{{ route("point-login") }}">
                                        @csrf
                                        <input class="input-pincode" type="password" maxlength="4" name="pincode" placeholder="Пін-код">
                                        <input type="text" name="point_id" hidden value="{{ $point->id }}">
                                        <input class="button" type="submit" value="Почати зміну">
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@extends("dashboard")

@section('title', 'Пункти')

@section("dashboard-data")

    <div class="row">
        <div class="col-6">
            <h2 class="fw-bold">Пункти</h2>
        </div>
    </div>
    <div class="row overflow-auto">
        <div class="col-12 text-center">
            <button type="button" class="button m-3" data-bs-toggle="modal" data-bs-target="#createNewPoint"><i class="fa-solid fa-plus me-2"></i><i class="fa-solid fa-building-columns me-3"></i> Створити новий пункт </button>
            <button type="button" class="button m-3" data-bs-toggle="modal" data-bs-target="#createNewGroup"><i class="fa-solid fa-plus me-2"></i><i class="fa-solid fa-folder me-3"></i> Створити новy групу </button>
        </div>
        <div class="col-12">
            <table class="w-100 points">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Назва</th>
                        <th>Статус</th>
                        <th>Працівник</th>
                        <th>Група</th>
                        <th>Пін-код</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $points as $point )
                        <tr>
                            <td>{{ $point->id }}</td>
                            <td>{{ $point->title }}</td>
                            @if( $point->status == 1 )
                                <td><span class="color-success fw-bold">Відкрито</span></td>
                            @else
                                <td><span class="color-danger fw-bold">Закрито</span></td>
                            @endif
                            <td>
                            <span class="cashier" data-letter="{{ strtoupper(substr($point->employee->name, 0, 1)) }}">
                                {{ $point->employee->name }}
                            </span>
                            </td>
                            <td>{{ $point->group->title }}</td>
                            <td>
                            <span class="pincode">
                                <input type="password" value="{{ $point->pincode }}" disabled>
                                <i class="fa-regular fa-eye"></i>
                            </span>

                            </td>
                            <td><a href="/points/{{ $point->id }}" class="button-outline"><i class="fa-solid fa-sliders"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('modals')

    <div class="modal vh-100" id="createNewPoint" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog my-0 py-5 modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Новий пункт</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="/points">
                    @csrf
                    <div class="modal-body p-5">
                        <label class="label">Назва пункту <small class="text-muted">(обов'язково)</small></label>
                        <small class="label-hint">Назви можуть повторюватись</small>
                        <input class="input" type="text" name="point_name" required >

                        <label class="label">Пін-код</label>
                        <small class="label-hint">Його можна змінити в майбутньому</small>
                        <input class="input" type="text" name="pincode">

                        <label class="label">Група</label>
                        <small class="label-hint">За замовчуванням пункт не належить до жодної з груп</small>
                        <div class="select">
                            <select class="input" name="group_id">
                                <option value="0">Без групи</option>
                                @foreach( $point_groups as $point_group )
                                    <option value="{{ $point_group->id }}">{{ $point_group->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label class="label">Коментар</label>
                        <small class="label-hint">Для нотатків</small>
                        <input class="input" type="text" name="comment">
                    </div>
                    <div class="modal-footer d-flex justify-content-center pb-0 pt-4">
                        <button type="reset" class="button background-dark me-4"><i class="fa-solid fa-broom me-2"></i>Очистити</button>
                        <button type="submit" class="button background-success ms-4"><i class="fa-solid fa-plus me-2"></i>Створити</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal vh-100" id="createNewGroup" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog my-0 py-5 modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Нова група</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="/pointgroups">
                    @csrf
                    <div class="modal-body p-5">
                        <label class="label">Назва групи <small class="text-muted">(обов'язково)</small></label>
                        <input class="input" type="text" name="group_name" required>

                        <label class="label">Коментар</label>
                        <input class="input" type="text" name="comment">
                    </div>
                    <div class="modal-footer d-flex justify-content-center pb-0 pt-4">
                        <button type="reset" class="button background-dark me-4"><i class="fa-solid fa-broom me-2"></i>Очистити</button>
                        <button type="submit" class="button background-success ms-4"><i class="fa-solid fa-plus me-2"></i>Створити</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

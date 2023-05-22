@extends("dashboard")

@section('title', $point->title)

@section("dashboard-data")

    <form action="/points/{{ $point->id }}" method="POST" class="confirmation changeable" data-confirmation="Ви дійсно хочете зберегти зміни?">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <h2 class="fw-bold"><input class="editable fw-bold" name="point_name" value="{{ $point->title }}" data-original="{{ $point->title }}"><i class="fa-regular fa-pen-to-square h5"></i></h2>
                <small class="text-muted">Востаннє оновлено {{ date("H:i:s, d.m.y", strtotime( $point->updated_at )) }}</small>
            </div>
        </div>
        <div class="row overflow-auto">
            <div class="card border-rounded card-dark p-5 text-white">
                <div class="row">
                    <div class="col-6">
                        <label class="label">Група</label>
                        <small class="label-hint">За замовчуванням пункт не належить до жодної з груп</small>
                        <div class="select">
                            <select class="input" name="group_id" data-original="{{$point->group_id}}">
                                @foreach( $point_groups as $point_group )
                                    @if ($point_group->id == $point->group_id)
                                        <option value="{{ $point_group->id }}" selected>{{ $point_group->title }}</option>
                                    @else
                                        <option value="{{ $point_group->id }}">{{ $point_group->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <label class="label">Працівник</label>
                        <small class="label-hint">Використовуйте лише в крайніх випадках, це впливає на аналітику</small>
                        <div class="select">
                            <select class="input" name="employee_id" data-original="{{$point->employee_id}}">
                                @foreach( $users as $user )
                                    @if ($user->id == $point->employee_id)
                                        <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <label class="label">Статус</label>
                        <small class="label-hint">Активуючи цей перемикач ви впливаєте на статистику роботи пункту</small>
                        <div class="switch">
                            <input type="checkbox" id="statusSwitch" name="status" data-original="{{$point->status}}"
                            @if ($point->status)
                                checked
                            @endif value="status">
                            <label for="statusSwitch">
                                <p>Закрито</p><p>Відкрито</p>
                            </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="label">Пін-код</label>
                        <small class="label-hint">Використовується касиром для входу в панель керування операціями</small>
                        <input class="input fw-bold" name="pincode" value="{{ $point->pincode }}" data-original="{{ $point->pincode }}">
                    </div>
                </div>

                <span class="d-inline">
                    <button class="button mt-5" type="submit"><i class="fa-regular fa-floppy-disk me-2"></i>Зберегти</button>
                    <small class="small color-warning ms-3 changes-hint" style="display:none;"><span class="badge background-warning rounded-pill">*зміни виділені кольором</span></small>
                </span>
            </div>

        </div>
    </form>
@endsection

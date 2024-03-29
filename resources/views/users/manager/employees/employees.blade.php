@extends("dashboard")

@section('title', "Персонал")

@section("dashboard-data")

    @if(isset($message))
        <div class="alert alert-{{$type}} alert-dismissible fade show" role="alert">
            {{ $message }}
        </div>
    @endif

    <div class="row">
        <div class="col-6">
            <h2 class="fw-bold">Персонал</h2>
        </div>
    </div>
    <div class="row overflow-auto">
        <div class="col-12">
            <div class="row">
                <div class="col-6">
                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills user-list me-3" role="tablist" aria-orientation="vertical">
                            @foreach($users as $user)
                                <button class="user-list-item d-flex align-items-center" id="user-{{$user->id}}-tab" data-bs-toggle="pill" href="#user-{{$user->id}}" role="tab" aria-controls="user-{{$user->id}}" aria-selected="true">
                                    <span class="cashier" data-letter="{{ strtoupper(substr($user->last_name, 0, 1)) }}"></span>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">{{ $user->last_name }} {{ $user->first_name }}</span>
                                        <span class="text-muted small"><small>Менеджер</small></span>
                                    </div>
                                </button>
                            @endforeach
                                <button type="button" class="button m-3 text-center" data-bs-toggle="modal" data-bs-target="#createNewUser">
                                    <i class="fa-solid fa-plus me-2"></i>
                                    <i class="fa-solid fa-building-columns me-3"></i>
                                    Додати працівника
                                </button>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="tab-content">
                        @foreach($users as $user)
                            <div class="tab-pane fade single-user card border-rounded p-5" id="user-{{$user->id}}" role="tabpanel" aria-labelledby="user-{{$user->id}}-tab">
                                <div class="user-title d-flex align-items-start">
                                    <span class="cashier" data-letter="{{ strtoupper(substr($user->last_name, 0, 1)) }}"></span>
                                    <div class="ms-5">
                                        <h2 class="fw-bold mt-3">{{ $user->last_name }} {{ $user->first_name }}</h2>
                                        <p class="text-muted mt-2"><small>{{$user->email}}</small></p>
                                    </div>
                                </div>
                                <div class="user-labels d-flex ">
                                    <div class="user-label small px-3 py-2 m-3 fw-bold background-dark text-white border-rounded">
{{--                                        {{ $user->user_type()->title }}--}}
                                    </div>
                                    <div class="user-label small px-3 py-2 m-3 fw-bold background-dark text-white border-rounded">
{{--                                        {{ $user->user_group()->title }}--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('modals')

    <div class="modal vh-100" id="createNewUser" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog my-0 py-5 modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Новий працівник</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="/employees">
                    @csrf
                    <div class="modal-body p-5">
                        <label class="label">Прізвище</label>
                        <small class="label-hint">Обовʼязково</small>
                        <input class="input" type="text" name="last_name" required>

                        <label class="label">Ім'я</label>
                        <small class="label-hint">Обовʼязково</small>
                        <input class="input" type="text" name="first_name" required>

                        <label class="label">Електронна адреса</label>
                        <input class="input" type="email" name="email">

                        <label class="label">Номер телефону</label>
                        <input class="input" type="text" name="phone" maxlength="13">

                        <label class="label">Пароль</label>
                        <input class="input" type="password" name="password">

                        <label class="label">Тип</label>
                        <small class="label-hint">Не надавайте права адміністратора будь-кому</small>
                        <div class="select">
                            <select class="input" name="group_id">
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label class="label">Група відповідальності</label>
                        <small class="label-hint">Користувач матиме доступ до роботи лише з вказаною групою</small>
                        <div class="select">
                            <select class="input" name="type_id">
                                @foreach($user_types as $user_type)
                                    <option value="{{$user_type->id}}">{{$user_type->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label class="label">Відповідальна особа</label>
                        <small class="label-hint">Відповідальний </small>
                        <div class="select">
                            <select class="input" name="responsible_id">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->last_name}} {{$user->first_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <label class="label">Коментар</label>
                        <small class="label-hint">Для нотатків</small>
                        <input class="input" type="text" name="comments">
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

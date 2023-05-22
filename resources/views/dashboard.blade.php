@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-1 vh-100 p-3 pe-0 layer-3 position-absolute" id="sidebar_wrapper">
                <div class="sidebar hidden">
                    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
                    <div class="card card-dark h-100 w-100 border-rounded p-5 d-flex flex-column justify-content-between">
                        <div class="sidebar-wrapper">
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <h6 class="fw-black text-white m-0 d-flex item-to-hide logo">
                                    <i class="fa-solid fa-fish-fins me-2 logo-img"></i>
                                    <span class="logo-text item-to-hide">Cashalytics</span>
                                </h6>
                                <h3 class="m-0 ms-5 text-white cross item-to-hide" onclick="toggleSidebar()"><i class="fa-solid fa-xmark"></i></h3>
                                <h6 class="m-0 text-white open" onclick="toggleSidebar()"><i class="fa-solid fa-angle-right"></i></h6>
                            </div>
                            <div class="sidebar-items">
                                @if(Auth::user()->type_id == '1')
                                    @include('users.manager.sidebar')
                                @else
                                    @include('users.cashier.sidebar')
                                @endif
                            </div>
                        </div>

                        <div class="sidebar-footer text-center">
                            <button class="button-outline danger mx-3"><i class="fa-solid fa-arrow-right-from-bracket"></i> Вийти </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overlay layer-2" onclick="toggleSidebar()"></div>
            <div class="offset-1 col-11 p-3 vh-100 layer-1" id="dashboard_wrapper">
                <div class="card h-100 w-100 border-rounded p-5">
                    @yield('dashboard-data')
                </div>
            </div>
        </div>
    </div>

    @yield('modals')

    <div class="modal vh-100" id="confirmActionModal" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog my-0 py-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ви дійсно хочете</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer d-flex justify-content-center pb-0 pt-4">
                    <button class="button danger"><i class="fa-regular fa-circle-xmark me-2"></i>Ні</button>
                    <button class="button success"><i class="fa-regular fa-circle-check me-2"></i>Так</button>
                </div>
            </div>
        </div>
    </div>

@endsection

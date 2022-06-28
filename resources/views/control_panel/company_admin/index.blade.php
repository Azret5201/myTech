@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Header title</h3>
                <ul class="nav nav-pills card-header-pills">

                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="#">
                            {!! \App\Enum\Icons::SETTINGS() !!}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima
                    neque pariatur perferendis sed suscipit velit vitae voluptatem.</p>
            </div>
        </div>
        <!-- Content here -->
    </div>
@endsection

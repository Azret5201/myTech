
@extends('layouts.control_panel.master')

@section('content')
<form class="form account-details-form ajax" action="{{ route('change.password') }}" method="post" autocomplete="off">
    @csrf
    @method('put')
    <div class="form-group mb-6">
        <label for="name">ФИО</label>
        <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
               class="form-control form-control-md">
    </div>

    <div class="form-group mb-6">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
               class="form-control form-control-md disabled">
    </div>

    <h4 class="title title-password ls-25 font-weight-bold">Смена пароля</h4>
    <div class="form-group">
        <label class="text-dark" for="current_password">Введите текущий пароль</label>
        <input type="password" class="form-control  @error('password') is-invalid @enderror form-control-md"
               id="current_password" name="current_password" >
        @error('current_password')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
    <div class="form-group">
        <label class="text-dark" for="new-password">Введите новый пароль</label>
        <input type="password" class="form-control form-control-md @error('password') is-invalid @enderror"
               id="new-password" name="password">

        @error('password')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
    <div class="form-group mb-10">
        <label class="text-dark" for="conf-password">Подвердите новый пароль</label>
        <input type="password" class="form-control form-control-md @error('confirm_password') is-invalid @enderror required"
               id="conf-password" name="confirm_password">
        @error('confirm_password')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Сохранить</button>
</form>
@endsection

@extends('layouts.control_panel.login')

@section('content')
    <div class="col col-login mx-auto">
        <form class="card card-md ajax" action="{{route('company.auth.login.post')}}" method="post"
              autocomplete="off">

            <div class="card-body">
                <h2 class="card-title text-center mb-4">Войдите в ваш аккаунт</h2>
                <div class="mb-3">
                    <label class="form-label" for="login">E-mail адрес</label>
                    <input name="login" type="text" class="form-control" placeholder="Ваш email">
                </div>
                <div class="mb-2">
                    <label class="form-label" for="password">Пароль</label>
                    <input name="password" type="password" class="form-control" placeholder="Ваш пароль">
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Войти</button>
                </div>
            </div>
        </form>
    </div>
@endsection


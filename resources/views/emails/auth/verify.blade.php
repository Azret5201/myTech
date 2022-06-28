@component('mail::message')

Hello {{ $user->name }}

@component('mail::button', ['url' => route('verify.email', $user->code)])
Click here t verify your email
@endcomponent
<p>or copy</p>
<a href="{{ route('verify.email', $user->code) }}">{{ route('verify.email', $user->code) }}</a>
<p>or put code {{ $user->code }}</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
Dear {{ $user->name }},


<br />
  {!! $data['message'] !!}</p>

{{ config('app.name') }}
@endcomponent
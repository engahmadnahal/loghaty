@component('mail::message')

# Welcome to Loghaty

Hello Mr. {{$admin->name}}, congratulations you have been registered in my language system and this is your login information
<br>
<br>
Email : <b>{{$admin->email}}</b>
<br>
Password : <b>{{$password}}</b>

Thanks,<br>
{{ config('app.name') }}
@endcomponent

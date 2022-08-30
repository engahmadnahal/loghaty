@component('mail::message')
# Hello sir, this email contains your password reset code The code is valid for 1 hour only 

This code using to reset password when forgot your password 
<br>
# Code : {{$code}}

#If you didn't do anything and I'm not responsible for sending this email please don't do anything
<br>
Thanks 
<br>
<br>
{{ config('app.name') }}
@endcomponent



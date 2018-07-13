@component('mail::message')
# Welcome to MyLife Application

Thank you for signing up. Here is your login informaion:

- Email: {{ $email }}
- Password: {{ $password }}


Thanks,<br>
{{ config('app.name') }}
@endcomponent

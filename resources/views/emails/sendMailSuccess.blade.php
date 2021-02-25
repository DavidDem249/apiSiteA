@component('mail::message')
# Introduction

{{ $data['name'] }}

{{ $data['firstname'] }} 

{{ $data['email'] }}

{{ $data['profession'] }}


@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

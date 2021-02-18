@component('mail::message')
# Introduction

{{ $data['message'] }}

{{ $data['nom'] }} - {{ $data['prenom'] }} - {{ $data['phone'] }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

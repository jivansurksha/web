@component('mail::message')
# Introduction

Welcome Message.

@component('mail::button', ['url' => "#"])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

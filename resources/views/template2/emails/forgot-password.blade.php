@component('mail::message')  {{-- ← Perhatikan namespace ini --}}
# Reset Password

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

@endcomponent
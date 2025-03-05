@component('mail::message')
# New Contact Form Submission

**From:** {{ $data['name'] }} ({{ $data['email'] }})

**Subject:** {{ $data['subject'] }}

**Message:**
{{ $data['message'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

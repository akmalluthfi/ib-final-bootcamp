@component('mail::message')
    <h2>Hello!</h2>
    <p>We have data instructions for you, please check.</p>
    <div>Regards,</div>
    <div>Team 2 - Inosoft Bootcamp</div>

    @slot('subcopy')
        If you're having trouble with the attachment we send, copy and paste the URL below into your web browser:
        {{ $url }}
    @endslot
@endcomponent

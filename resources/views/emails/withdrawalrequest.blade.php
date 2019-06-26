@component('mail::message')


    Hello, we have received your withdrawal application..Kindly be informed that we would process it asap and give you a feedback <br>
    Request Type: {{ $amount }}<br>
    Amount Needed: {{ $paymentMode }}<br>
    You are receiving this mail because you made a request on our website.<br>

    If this action was not done by you, kindly disregard this mail<br>


    Your Request was Successful<br>

    @component('mail::button', ['url' => 'http://localhost:8000'])
        Return to Site
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent

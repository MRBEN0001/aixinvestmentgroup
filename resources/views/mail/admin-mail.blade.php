<x-mail::message>
    # Subject: {{$data['subject']}}

    Details Below:

    Beneficiary: {{$data['name']}}
    Amount: {{$data['roi']}}
    Coin: {{$data['coin']}}

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
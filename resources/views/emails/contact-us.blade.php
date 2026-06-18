<x-mail::message>
# Hello, you have got a query!

<h3>First Name: {{ $data['firstname'] }} </h3>
<h3>Second Name: {{ $data['lastname'] }} </h3>
<h3>Email: {{ $data['email'] }} </h3>
<h3>Subject: {{ $data['subject'] }} </h3>
<h3>Message: {{ $data['message'] }} </h3>

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

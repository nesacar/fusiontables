@component('mail::message')
# Poruka sa sajta fusiontables.rs

Ime: {{ $message->name }} <br>
Email: {{ $message->email }} <br>
@if(!empty($message->phone))
Phone: {{ $message->phone }} <br>
@endif
Poruka: {{ $message->message }} <br><br>

Hvala,<br>
fusiontables.rs
@endcomponent

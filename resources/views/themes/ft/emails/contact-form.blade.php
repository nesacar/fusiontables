@component('mail::message')
# Poruka sa sajta fusiontables.rs

Ime: {{ $message->name }} <br>
Email: {{ $message->email }} <br>
@if(!empty($message->phone))
Telefon: {{ $message->phone }} <br>
@endif
Profil: {{ $message->profile }} <br>
Poruka: {{ $message->message }} <br><br>

Hvala,<br>
fusiontables.rs
@endcomponent

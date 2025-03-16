<x-mail::message>
# Réinitialisation du mot de passe

Cliquez sur le bouton ci-dessous pour réinitialiser votre mot de passe.

@component('mail::button', ['url' => $url])
Réinitialiser mon mot de passe
@endcomponent

Ce lien expirera dans 60 minutes.

Cordialement,<br>
Parking

<br><br>
<img src="{{ asset('parking.png') }}" style="width: 100px;">
</x-mail::message>
@component('mail::message')
# Utworzono konto użytkownika

Login: {{ $user->email }}
<br>
Hasło: {{ $password }}

@component('mail::button', ['url' => route('user.show', $user->id)])
Otwórz profil konta
@endcomponent

Z wyrazami szacunku,
<br>
Administrator serwisu EmployeesDir
@endcomponent

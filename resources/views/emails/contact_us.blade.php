@component('mail::message')
 Dear Admin,
  You have new message from {{ $contact_us['email'] }}
<br />
<p>
    type: {{ $contact_us['type']}}</p>
</p>
<p>
    country: {{ $contact_us['country']}}</p>
</p>
<p>
    first name: {{ $contact_us['first_name']}}</p>
</p>
<p>
    last name: {{ $contact_us['last_name']}}</p>
</p>
<p>email: {{ $contact_us['email'] }}</p>

<p>phone: {{ $contact_us['phone'] }}</p>


<p>message: {{ $contact_us['message'] }}</p>

{{ config('app.name') }} @endcomponent
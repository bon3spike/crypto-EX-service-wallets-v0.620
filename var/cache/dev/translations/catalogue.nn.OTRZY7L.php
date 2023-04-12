<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('nn', array (
  'security' => 
  array (
    'An authentication exception occurred.' => 'Innlogginga har feila.',
    'Authentication credentials could not be found.' => 'Innloggingsinformasjonen vart ikkje funnen.',
    'Authentication request could not be processed due to a system problem.' => 'Innlogginga vart ikkje fullført på grunn av ein systemfeil.',
    'Invalid credentials.' => 'Ugyldig innloggingsinformasjon.',
    'Cookie has already been used by someone else.' => 'Informasjonskapselen er allereie brukt av ein annan brukar.',
    'Not privileged to request the resource.' => 'Du har ikkje åtgang til å be om denne ressursen.',
    'Invalid CSRF token.' => 'Ugyldig CSRF-teikn.',
    'No authentication provider found to support the authentication token.' => 'Fann ingen innloggingstilbydar som støttar dette innloggingsteiknet.',
    'No session available, it either timed out or cookies are not enabled.' => 'Ingen sesjon tilgjengeleg. Sesjonen er anten ikkje lenger gyldig, eller informasjonskapslar er ikkje skrudd på i nettlesaren.',
    'No token could be found.' => 'Fann ingen innloggingsteikn.',
    'Username could not be found.' => 'Fann ikkje brukarnamnet.',
    'Account has expired.' => 'Brukarkontoen er utgjengen.',
    'Credentials have expired.' => 'Innloggingsinformasjonen er utgjengen.',
    'Account is disabled.' => 'Brukarkontoen er sperra.',
    'Account is locked.' => 'Brukarkontoen er sperra.',
    'Too many failed login attempts, please try again later.' => 'For mange innloggingsforsøk har feila, prøv igjen seinare.',
    'Invalid or expired login link.' => 'Innloggingslenka er ugyldig eller utgjengen.',
    'Too many failed login attempts, please try again in %minutes% minute.' => 'For mange mislykkede påloggingsforsøk, prøv igjen om %minutes% minutt.',
    'Too many failed login attempts, please try again in %minutes% minutes.' => 'For mange mislykkede påloggingsforsøk, prøv igjen om %minutes% minutter.',
  ),
));

$catalogueNo = new MessageCatalogue('no', array (
  'security' => 
  array (
    'An authentication exception occurred.' => 'En autentiseringsfeil har skjedd.',
    'Authentication credentials could not be found.' => 'Påloggingsinformasjonen kunne ikke bli funnet.',
    'Authentication request could not be processed due to a system problem.' => 'Autentiserings forespørselen kunne ikke bli prosessert grunnet en system feil.',
    'Invalid credentials.' => 'Ugyldig påloggingsinformasjon.',
    'Cookie has already been used by someone else.' => 'Cookie har allerede blitt brukt av noen andre.',
    'Not privileged to request the resource.' => 'Ingen tilgang til å be om gitt ressurs.',
    'Invalid CSRF token.' => 'Ugyldig CSRF token.',
    'No authentication provider found to support the authentication token.' => 'Ingen autentiserings tilbyder funnet som støtter gitt autentiserings token.',
    'No session available, it either timed out or cookies are not enabled.' => 'Ingen sesjon tilgjengelig, sesjonen er enten utløpt eller cookies ikke skrudd på.',
    'No token could be found.' => 'Ingen token kunne bli funnet.',
    'Username could not be found.' => 'Brukernavn kunne ikke bli funnet.',
    'Account has expired.' => 'Brukerkonto har utgått.',
    'Credentials have expired.' => 'Påloggingsinformasjon har utløpt.',
    'Account is disabled.' => 'Brukerkonto er deaktivert.',
    'Account is locked.' => 'Brukerkonto er sperret.',
    'Too many failed login attempts, please try again later.' => 'For mange mislykkede påloggingsforsøk. Prøv igjen senere.',
    'Invalid or expired login link.' => 'Ugyldig eller utløpt påloggingskobling.',
    'Too many failed login attempts, please try again in %minutes% minute.' => 'For mange mislykkede påloggingsforsøk, prøv igjen om %minutes% minutt.',
    'Too many failed login attempts, please try again in %minutes% minutes.' => 'For mange mislykkede påloggingsforsøk, prøv igjen om %minutes% minutter.',
  ),
));
$catalogue->addFallbackCatalogue($catalogueNo);
$catalogueEn = new MessageCatalogue('en', array (
  'security' => 
  array (
    'An authentication exception occurred.' => 'An authentication exception occurred.',
    'Authentication credentials could not be found.' => 'Authentication credentials could not be found.',
    'Authentication request could not be processed due to a system problem.' => 'Authentication request could not be processed due to a system problem.',
    'Invalid credentials.' => 'Invalid credentials.',
    'Cookie has already been used by someone else.' => 'Cookie has already been used by someone else.',
    'Not privileged to request the resource.' => 'Not privileged to request the resource.',
    'Invalid CSRF token.' => 'Invalid CSRF token.',
    'No authentication provider found to support the authentication token.' => 'No authentication provider found to support the authentication token.',
    'No session available, it either timed out or cookies are not enabled.' => 'No session available, it either timed out or cookies are not enabled.',
    'No token could be found.' => 'No token could be found.',
    'Username could not be found.' => 'Username could not be found.',
    'Account has expired.' => 'Account has expired.',
    'Credentials have expired.' => 'Credentials have expired.',
    'Account is disabled.' => 'Account is disabled.',
    'Account is locked.' => 'Account is locked.',
    'Too many failed login attempts, please try again later.' => 'Too many failed login attempts, please try again later.',
    'Invalid or expired login link.' => 'Invalid or expired login link.',
    'Too many failed login attempts, please try again in %minutes% minute.' => 'Too many failed login attempts, please try again in %minutes% minute.',
    'Too many failed login attempts, please try again in %minutes% minutes.' => 'Too many failed login attempts, please try again in %minutes% minutes.',
  ),
));
$catalogueNo->addFallbackCatalogue($catalogueEn);

return $catalogue;

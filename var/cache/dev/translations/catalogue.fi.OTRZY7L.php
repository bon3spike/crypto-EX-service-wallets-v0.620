<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('fi', array (
  'security' => 
  array (
    'An authentication exception occurred.' => 'Autentikointi poikkeus tapahtui.',
    'Authentication credentials could not be found.' => 'Autentikoinnin tunnistetietoja ei löydetty.',
    'Authentication request could not be processed due to a system problem.' => 'Autentikointipyyntöä ei voitu käsitellä järjestelmäongelman vuoksi.',
    'Invalid credentials.' => 'Virheelliset tunnistetiedot.',
    'Cookie has already been used by someone else.' => 'Eväste on jo jonkin muun käytössä.',
    'Not privileged to request the resource.' => 'Ei oikeutta resurssiin.',
    'Invalid CSRF token.' => 'Virheellinen CSRF tunnus.',
    'No authentication provider found to support the authentication token.' => 'Autentikointi tunnukselle ei löydetty tuettua autentikointi tarjoajaa.',
    'No session available, it either timed out or cookies are not enabled.' => 'Sessio ei ole saatavilla, se on joko vanhentunut tai evästeet eivät ole käytössä.',
    'No token could be found.' => 'Tunnusta ei löytynyt.',
    'Username could not be found.' => 'Käyttäjätunnusta ei löydetty.',
    'Account has expired.' => 'Tili on vanhentunut.',
    'Credentials have expired.' => 'Tunnistetiedot ovat vanhentuneet.',
    'Account is disabled.' => 'Tili on poistettu käytöstä.',
    'Account is locked.' => 'Tili on lukittu.',
    'Too many failed login attempts, please try again later.' => 'Liian monta epäonnistunutta kirjautumisyritystä, yritä myöhemmin uudelleen.',
    'Invalid or expired login link.' => 'Virheellinen tai vanhentunut kirjautumislinkki.',
    'Too many failed login attempts, please try again in %minutes% minute.' => 'Liian monta epäonnistunutta kirjautumisyritystä, yritä uudelleen %minutes% minuutin kuluttua.',
    'Too many failed login attempts, please try again in %minutes% minutes.' => 'Liian monta epäonnistunutta kirjautumisyritystä, yritä uudelleen %minutes% minuutin kuluttua.',
  ),
));

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
$catalogue->addFallbackCatalogue($catalogueEn);

return $catalogue;

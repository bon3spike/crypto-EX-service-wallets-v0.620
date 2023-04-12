<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('hr', array (
  'security' => 
  array (
    'An authentication exception occurred.' => 'Dogodila se autentifikacijske iznimka.',
    'Authentication credentials could not be found.' => 'Autentifikacijski podaci nisu pronađeni.',
    'Authentication request could not be processed due to a system problem.' => 'Autentifikacijski zahtjev nije moguće provesti uslijed sistemskog problema.',
    'Invalid credentials.' => 'Neispravni akreditacijski podaci.',
    'Cookie has already been used by someone else.' => 'Cookie je već netko drugi iskoristio.',
    'Not privileged to request the resource.' => 'Nemate privilegije zahtijevati resurs.',
    'Invalid CSRF token.' => 'Neispravan CSRF token.',
    'No authentication provider found to support the authentication token.' => 'Nije pronađen autentifikacijski provider koji bi podržao autentifikacijski token.',
    'No session available, it either timed out or cookies are not enabled.' => 'Sesija nije dostupna, ili je istekla ili cookies nisu omogućeni.',
    'No token could be found.' => 'Token nije pronađen.',
    'Username could not be found.' => 'Korisničko ime nije pronađeno.',
    'Account has expired.' => 'Račun je isteko.',
    'Credentials have expired.' => 'Akreditacijski podaci su istekli.',
    'Account is disabled.' => 'Račun je onemogućen.',
    'Account is locked.' => 'Račun je zaključan.',
    'Too many failed login attempts, please try again later.' => 'Previše neuspjelih pokušaja prijave, molim pokušajte ponovo kasnije.',
    'Invalid or expired login link.' => 'Link za prijavu je isteako ili je neispravan.',
    'Too many failed login attempts, please try again in %minutes% minute.' => 'Previše neuspjelih pokušaja prijave, molim pokušajte ponovo za %minutes% minutu.',
    'Too many failed login attempts, please try again in %minutes% minutes.' => 'Previše neuspjelih pokušaja prijave, molim pokušajte ponovo za %minutes% minutu.|Previše neuspjelih pokušaja prijave, molim pokušajte ponovo za %minutes% minute.|Previše neuspjelih pokušaja prijave, molim pokušajte ponovo za %minutes% minuta.',
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

<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('af', array (
  'security' => 
  array (
    'An authentication exception occurred.' => '\'n Verifikasie probleem het voorgekom.',
    'Authentication credentials could not be found.' => 'Verifikasiebewyse kon nie gevind word nie.',
    'Authentication request could not be processed due to a system problem.' => 'Verifikasieversoek kon weens \'n stelselprobleem nie verwerk word nie.',
    'Invalid credentials.' => 'Ongedige verifikasiebewyse.',
    'Cookie has already been used by someone else.' => 'Die koekie is alreeds deur iemand anders gebruik.',
    'Not privileged to request the resource.' => 'Nie bevoorreg om die hulpbron aan te vra nie.',
    'Invalid CSRF token.' => 'Ongeldige CSRF-teken.',
    'No authentication provider found to support the authentication token.' => 'Geen verifikasieverskaffer is gevind wat die verifikasietoken kan ondersteun nie.',
    'No session available, it either timed out or cookies are not enabled.' => 'Geen sessie is beskikbaar, die het verval of koekies is nie geaktiveer nie.',
    'No token could be found.' => 'Geen teken kon gevind word nie.',
    'Username could not be found.' => 'Gebruikersnaam kon nie gevind word nie.',
    'Account has expired.' => 'Rekening het verval.',
    'Credentials have expired.' => 'Verifikasiebewyse het verval.',
    'Account is disabled.' => 'Rekening is deaktiveer.',
    'Account is locked.' => 'Rekening is gesluit.',
    'Too many failed login attempts, please try again later.' => 'Te veel mislukte aanmeldpogings, probeer asseblief later weer.',
    'Invalid or expired login link.' => 'Ongeldige of vervalde aanmeldskakel.',
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

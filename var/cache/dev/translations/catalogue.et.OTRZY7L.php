<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('et', array (
  'security' => 
  array (
    'An authentication exception occurred.' => 'Autentimisel juhtus ootamatu viga.',
    'Authentication credentials could not be found.' => 'Autentimisandmeid ei leitud.',
    'Authentication request could not be processed due to a system problem.' => 'Autentimispäring ei õnnestunud süsteemi probleemi tõttu.',
    'Invalid credentials.' => 'Vigased autentimisandmed.',
    'Cookie has already been used by someone else.' => 'Küpsis on juba kellegi teise poolt kasutuses.',
    'Not privileged to request the resource.' => 'Ressursi pärimiseks pole piisavalt õiguseid.',
    'Invalid CSRF token.' => 'Vigane CSRF märgis.',
    'No authentication provider found to support the authentication token.' => 'Ei leitud sobivat autentimismeetodit, mis toetaks autentimismärgist.',
    'No session available, it either timed out or cookies are not enabled.' => 'Seanss puudub, see on kas aegunud või pole küpsised lubatud.',
    'No token could be found.' => 'Identsustõendit ei leitud.',
    'Username could not be found.' => 'Kasutajanime ei leitud.',
    'Account has expired.' => 'Kasutajakonto on aegunud.',
    'Credentials have expired.' => 'Autentimistunnused on aegunud.',
    'Account is disabled.' => 'Kasutajakonto on keelatud.',
    'Account is locked.' => 'Kasutajakonto on lukustatud.',
    'Too many failed login attempts, please try again later.' => 'Liiga palju ebaõnnestunud autentimise katseid, palun proovi hiljem uuesti.',
    'Invalid or expired login link.' => 'Vigane või aegunud sisselogimise link.',
    'Too many failed login attempts, please try again in %minutes% minute.' => 'Liiga palju ebaõnnestunud autentimise katseid, palun proovi uuesti %minutes% minuti pärast.',
    'Too many failed login attempts, please try again in %minutes% minutes.' => 'Liiga palju ebaõnnestunud autentimise katseid, palun proovi uuesti %minutes% minuti pärast.',
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

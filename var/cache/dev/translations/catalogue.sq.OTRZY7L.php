<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('sq', array (
  'security' => 
  array (
    'An authentication exception occurred.' => 'Ndodhi një problem në autentikim.',
    'Authentication credentials could not be found.' => 'Kredencialet e autentikimit nuk mund të gjendeshin.',
    'Authentication request could not be processed due to a system problem.' => 'Kërkesa për autentikim nuk mund të përpunohej për shkak të një problemi në sistem.',
    'Invalid credentials.' => 'Kredenciale të pavlefshme.',
    'Cookie has already been used by someone else.' => 'Cookie është përdorur tashmë nga dikush tjetër.',
    'Not privileged to request the resource.' => 'Nuk është i privilegjuar të kërkojë burimin.',
    'Invalid CSRF token.' => 'Identifikues i pavlefshëm CSRF.',
    'No authentication provider found to support the authentication token.' => 'Asnjë ofrues i vërtetimit nuk u gjet që të mbështesë simbolin e vërtetimit.',
    'No session available, it either timed out or cookies are not enabled.' => 'Nuk ka asnjë sesion të vlefshëm, i ka skaduar koha ose cookies nuk janë aktivizuar.',
    'No token could be found.' => 'Asnjë simbol identifikimi nuk mund të gjendej.',
    'Username could not be found.' => 'Emri i përdoruesit nuk mund të gjendej.',
    'Account has expired.' => 'Llogaria ka skaduar.',
    'Credentials have expired.' => 'Kredencialet kanë skaduar.',
    'Account is disabled.' => 'Llogaria është çaktivizuar.',
    'Account is locked.' => 'Llogaria është e kyçur.',
    'Too many failed login attempts, please try again later.' => 'Shumë përpjekje të dështuara autentikimi, provo përsëri më vonë.',
    'Invalid or expired login link.' => 'Link hyrje i pavlefshëm ose i skaduar.',
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

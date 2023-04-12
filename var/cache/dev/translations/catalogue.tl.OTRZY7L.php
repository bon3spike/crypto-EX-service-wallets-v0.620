<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('tl', array (
  'security' => 
  array (
    'An authentication exception occurred.' => 'Nagkaroon ng isang pagbubukod sa pagpapatotoo.',
    'Authentication credentials could not be found.' => 'Hindi matagpuan ang mga kredensyal ng pagpapatotoo.',
    'Authentication request could not be processed due to a system problem.' => 'Ang kahilingan sa pagpapatotoo ay hindi naproseso dahil sa isang problema sa system.',
    'Invalid credentials.' => 'Di-wastong mga kredensyal.',
    'Cookie has already been used by someone else.' => 'Ang Cookie ay ginamit na ng ibang tao.',
    'Not privileged to request the resource.' => 'Walang pribilehiyo upang humingi ng mga bagong mapagkukunan.',
    'Invalid CSRF token.' => 'Di-wastong token ng CSRF.',
    'No authentication provider found to support the authentication token.' => 'Walang nahanap na provider ng pagpapatotoo upang suportahan ang token ng pagpapatotoo.',
    'No session available, it either timed out or cookies are not enabled.' => 'Walang magagamit na session, alinman sa nag-time out o ang cookies ay hindi pinagana.',
    'No token could be found.' => 'Walang makitang token.',
    'Username could not be found.' => 'Hindi makita ang username.',
    'Account has expired.' => 'Nag-expire na ang account.',
    'Credentials have expired.' => 'Nag-expire na ang mga kredensyal.',
    'Account is disabled.' => 'Ang account ay hindi pinagana.',
    'Account is locked.' => 'Ang account ay naka-lock.',
    'Too many failed login attempts, please try again later.' => 'Napakaraming nabigong mga pagtatangka sa pag-login, mangyaring subukang muli sa ibang pagkakataon.',
    'Invalid or expired login link.' => 'Inbalido o nagexpire na ang link para makapaglogin.',
    'Too many failed login attempts, please try again in %minutes% minute.' => 'Napakaraming nabigong mga pagtatangka sa pag-login, pakisubukan ulit sa% minuto% minuto.',
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

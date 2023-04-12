<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('hy', array (
  'security' => 
  array (
    'An authentication exception occurred.' => 'Նույնականացման սխալ։',
    'Authentication credentials could not be found.' => 'Նույնականացման տվյալները չեն գտնվել։',
    'Authentication request could not be processed due to a system problem.' => 'Համակարգային սխալ՝ նույնականացման հացրման պրոցեսինգի ժամանակ։',
    'Invalid credentials.' => 'Սխալ մուտքային տվյալներ',
    'Cookie has already been used by someone else.' => 'Cookie-ն արդեն օգտագործվում է ուրիշի կողմից։',
    'Not privileged to request the resource.' => 'Ռեսուրսի հարցման համար չկա թույլատվություն։',
    'Invalid CSRF token.' => 'Անվավեր CSRF թոքեն։',
    'No authentication provider found to support the authentication token.' => 'Նույնականացման ոչ մի մատակարար չի գտնվել, որ աջակցի նույնականացման թոքենը։',
    'No session available, it either timed out or cookies are not enabled.' => 'Հասանելի սեսիա չկա, կամ այն սպառվել է կամ cookie-ները անջատված են:',
    'No token could be found.' => 'Թոքենը չի գտնվել։',
    'Username could not be found.' => 'Օգտանունը չի գտնվել։',
    'Account has expired.' => 'Հաշիվը ժամկետանց է։',
    'Credentials have expired.' => 'Մուտքային տվյալները ժամկետանց են։',
    'Account is disabled.' => 'Հաշիվը դեկատիվացված է։',
    'Account is locked.' => 'Հաշիվն արգելափակված է։',
    'Too many failed login attempts, please try again later.' => 'Չափից շատ մուտքի փորձեր, խնդրում ենք փորձել մի փոքր ուշ',
    'Invalid or expired login link.' => 'Անվավեր կամ ժամկետանց մուտքի հղում։',
    'Too many failed login attempts, please try again in %minutes% minute.' => 'Մուտքի չափազանց շատ անհաջող փորձեր: Խնդրում ենք կրկին փորձել %minutes րոպե:',
    'Too many failed login attempts, please try again in %minutes% minutes.' => 'Մուտքի չափազանց շատ անհաջող փորձեր: Խնդրում ենք կրկին փորձել %minutes րոպե:',
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

<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('ur', array (
  'security' => 
  array (
    'An authentication exception occurred.' => 'ایک تصدیقي خرابی پیش آگئی ۓ',
    'Authentication credentials could not be found.' => 'درج کردھ ریکارڈ نہیں مل سکا',
    'Authentication request could not be processed due to a system problem.' => 'سسٹم کی خرابی کی وجہ سے تصدیق کی درخواست پر کارروائی نہیں ہو سکی',
    'Invalid credentials.' => 'غلط ڈیٹا',
    'Cookie has already been used by someone else.' => 'کوکی پہلے ہی کسی اور کے ذریعہ استعمال ہو چکی ہے',
    'Not privileged to request the resource.' => 'وسائل کی درخواست کرنے کا اختیار نہیں ہے',
    'Invalid CSRF token.' => 'ٹوکن غلط ہے CSRF',
    'No authentication provider found to support the authentication token.' => 'تصدیقی ٹوکن کو سپورٹ کرنے کے لیے کوئی تصدیقی کنندہ نہیں ملا',
    'No session available, it either timed out or cookies are not enabled.' => 'کوئی سیشن دستیاب نہیں ہے، یا تو اس کا وقت ختم ہو گیا ہے یا کوکیز فعال نہیں ہیں',
    'No token could be found.' => 'کوئی ٹوکن نہیں مل سکا',
    'Username could not be found.' => 'يوذر نہیں مل سکا',
    'Account has expired.' => 'اکاؤنٹ کی میعاد ختم ہو گئی ہے',
    'Credentials have expired.' => 'اسناد کی میعاد ختم ہو چکی ہے',
    'Account is disabled.' => 'اکاؤنٹ بند کر دیا گیا ہے',
    'Account is locked.' => 'اکاؤنٹ لاک ہے',
    'Too many failed login attempts, please try again later.' => 'لاگ ان کی بہت زیادہ ناکام کوششیں ہو چکی ہیں، براۓ کرم بعد میں دوبارہ کوشش کریں',
    'Invalid or expired login link.' => 'غلط یا ختم شدھ لاگ ان لنک',
    'Too many failed login attempts, please try again in %minutes% minute.' => 'منٹ باد %minutes% لاگ ان کی بہت زیادہ ناکام کوششیں ہو چکی ہیں، براۓ کرم دوبارھ کوشيش کريں ',
    'Too many failed login attempts, please try again in %minutes% minutes.' => 'منٹ باد %minutes% لاگ ان کی بہت زیادہ ناکام کوششیں ہو چکی ہیں، براۓ کرم دوبارھ کوشيش کريں ',
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

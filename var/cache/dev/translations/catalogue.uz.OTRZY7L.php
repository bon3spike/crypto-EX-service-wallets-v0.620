<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('uz', array (
  'security' => 
  array (
    'An authentication exception occurred.' => 'Autentifikatsiyada xatolik.',
    'Authentication credentials could not be found.' => 'Autentifikatsiya ma\'lumotlari topilmadi.',
    'Authentication request could not be processed due to a system problem.' => 'Tizimdagi muammo tufayli autentifikatsiya so\'rovi bajarilmadi.',
    'Invalid credentials.' => 'Noto\'g\'ri ma\'lumot.',
    'Cookie has already been used by someone else.' => 'Cookie faylini allaqachon kimdir ishlatgan.',
    'Not privileged to request the resource.' => 'Sizda ushbu manbani talab qilishga ruxsat yo\'q..',
    'Invalid CSRF token.' => 'Noto\'g\'ri CSRF belgisi.',
    'No authentication provider found to support the authentication token.' => 'Haqiqiylikni tasdiqlovchi belgini qo\'llab-quvvatlovchi biron bir autentifikatsiya provayderi topilmadi.',
    'No session available, it either timed out or cookies are not enabled.' => 'Sessiya topilmadi, muddati tugamadi yoki cookie-fayllar yoqilmagan.',
    'No token could be found.' => 'To\'ken topilmadi.',
    'Username could not be found.' => 'Foydalanuvchi nomi topilmadi.',
    'Account has expired.' => 'Akkunt muddati tugagan.',
    'Credentials have expired.' => 'Autentifikatsiya ma\'lumotlari muddati tugagan.',
    'Account is disabled.' => 'Akkunt o\'chirilgan.',
    'Account is locked.' => 'Akkunt bloklangan.',
    'Too many failed login attempts, please try again later.' => 'Kirish urinishlari muvaffaqiyatsiz tugadi, keyinroq qayta urinib ko\'ring.',
    'Invalid or expired login link.' => 'Kirish havolasi yaroqsiz yoki muddati tugagan.',
    'Too many failed login attempts, please try again in %minutes% minute.' => 'Kirish uchun muvaffaqiyatsiz urinishlar, %minutes% daqiqadan so\'ng qayta urinib ko\'ring.',
    'Too many failed login attempts, please try again in %minutes% minutes.' => 'Kirish uchun muvaffaqiyatsiz urinishlar, %minutes% daqiqadan so\'ng qayta urinib ko\'ring.',
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

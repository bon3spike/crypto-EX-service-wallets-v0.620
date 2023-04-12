<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('he', array (
  'security' => 
  array (
    'An authentication exception occurred.' => 'שגיאה באימות',
    'Authentication credentials could not be found.' => 'פרטי זיהוי לא נמצאו.',
    'Authentication request could not be processed due to a system problem.' => 'לא ניתן היה לעבד את בקשת אימות בגלל בעיית מערכת.',
    'Invalid credentials.' => 'שם משתמש או סיסמא שגויים.',
    'Cookie has already been used by someone else.' => 'עוגיה כבר שומשה.',
    'Not privileged to request the resource.' => 'אין הרשאה מתאימה.',
    'Invalid CSRF token.' => 'אסימון CSRF לא חוקי.',
    'No authentication provider found to support the authentication token.' => 'לא נמצא ספק אימות המתאימה לבקשה.',
    'No session available, it either timed out or cookies are not enabled.' => 'אין סיישן זמין, או שתם הזמן הקצוב או העוגיות אינן מופעלות.',
    'No token could be found.' => 'הטוקן לא נמצא.',
    'Username could not be found.' => 'שם משתמש לא נמצא.',
    'Account has expired.' => 'החשבון פג תוקף.',
    'Credentials have expired.' => 'פרטי התחברות פקעו תוקף.',
    'Account is disabled.' => 'החשבון מבוטל.',
    'Account is locked.' => 'החשבון נעול.',
    'Too many failed login attempts, please try again later.' => 'יותר מדי ניסיונות כניסה כושלים, אנא נסה שוב מאוחר יותר.',
    'Invalid or expired login link.' => 'קישור כניסה לא חוקי או שפג תוקפו.',
    'Too many failed login attempts, please try again in %minutes% minute.' => 'יותר מדי ניסיונות כניסה כושלים, אנא נסה שוב בוד %minutes% דקה.',
    'Too many failed login attempts, please try again in %minutes% minutes.' => 'יותר מדי ניסיונות כניסה כושלים, אנא נסה שוב בוד %minutes% דקות.',
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

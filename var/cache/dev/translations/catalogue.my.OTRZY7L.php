<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('my', array (
  'security' => 
  array (
    'An authentication exception occurred.' => 'အသုံးပြုခွင့် ခြွင်းချက်တစ်ခုဖြစ်သွားသည်။',
    'Authentication credentials could not be found.' => 'အသုံးပြုခွင့် အထောက်အထားများ ရှာမတွေ့ပါ။',
    'Authentication request could not be processed due to a system problem.' => 'System ပြဿနာအခက်အခဲရှိ နေပါသဖြင့် အသုံးပြုခွင့်တောင်းဆိုချက်ကို ဆောင်ရွက်၍မရ နိုင်ပါ။',
    'Invalid credentials.' => 'သင့်လျှော်သော် အထောက်အထားမဟုတ်ပါ။',
    'Cookie has already been used by someone else.' => 'Cookie ကို တစ်စုံတစ်ယောက်မှ အသုံးပြုပြီးဖြစ်သည်။',
    'Not privileged to request the resource.' => 'အရင်းအမြစ်ကိုတောင်းဆိုရန်အခွင့်ထူးမရပါ။',
    'Invalid CSRF token.' => 'သင့်လျှော်သော် CSRF token မဟုတ်ပါ။',
    'No authentication provider found to support the authentication token.' => 'အထောက်အထားစိစစ်ခြင်းသင်္ကေတကိုပံ့ပိုးရန် မည်သည့်အထောက်အထားစိစစ်ရေး ၀န်ဆောင်မှုမှမတွေ့ပါ။',
    'No session available, it either timed out or cookies are not enabled.' => 'Session မအားလပ်ပါ။ Session အချိန်ကုန်သွားခြင်း (သို့မဟုတ်) cookies များကိုဖွင့်ထားခြင်းမရှိပါ။',
    'No token could be found.' => 'Toke  ရှာမတွေ့ပါ။',
    'Username could not be found.' => 'အသုံးပြုသူအမည် ရှာဖွေတွေ့ရှိချင်းမရှိပါ။',
    'Account has expired.' => 'အကောင့် သက်တမ်းကုန်လွန်သွားပါပြီ။',
    'Credentials have expired.' => 'အထောက်အထားသက်တန်း ကုန်လွန်သွားပါပြီ။',
    'Account is disabled.' => 'အကောင့်ပိတ်ထားပါသည်။',
    'Account is locked.' => 'အကောင့် လောခ်ကျသွားပါပြီ။',
    'Too many failed login attempts, please try again later.' => 'Login ၀င်ရန်ကြိုးစားမှုများလွန်းပါသည်၊ ကျေးဇူးပြု၍ နောက်မှထပ်ကြိုးစားပါ။',
    'Invalid or expired login link.' => 'မသင့်လျှော်သော် (သို့မဟုတ်) သက်တန်းကုန်သော login link ဖြစ်ပါသည်။',
    'Too many failed login attempts, please try again in %minutes% minute.' => 'Too many failed login attempts, please try again in %minutes% minute.',
    'Too many failed login attempts, please try again in %minutes% minutes.' => 'Login ၀င်ရန်ကြိုးစားမှုများလွန်းပါသည်၊ ကျေးဇူးပြု၍ နောက် %minutes% မှထပ်မံကြိုးစားပါ။',
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

<?php


//ENTER THESE VALUES BY YOURSELF OR USE ANOTHER VARIABLES TO LINK THEM

// ----------------- Merchant Details --------------------------
//Your wallet number   (ZainCash IT will provide it for you)
$msisdn = 9647835077893;

//Secret   (ZainCash IT will provide it for you)
$secret = '$2y$10$hBbAZo2GfSSvyqAyV2SaqOfYewgYpfR1O19gIh4SqyGWdmySZYPuS';

//Merchant ID   (ZainCash IT will provide it for you)
$merchantid = '5ffacf6612b5777c6d44266f';

//Test credentials or Production credentials (true=production , false=test)
$production_cred = false;

//Language 'ar'=Arabic     'en'=english
$language = 'en';

ini_set('precision', 15);
return [
    'zain_msisdn' => env('ZAIN_MSISDN', ''),
    'zain_secret' => env('ZAIN_SECRET', ''),
    'zain_merchantid' => env('ZAIN_MERCHANT_ID', ''),
];

<?php

return [
    'product' => env('LICENSE_PRODUCT', 'onlymlm-bagisto'),
    'private_key' => env('LICENSE_SIGNING_PRIVATE_KEY'),
    'public_key' => env('LICENSE_SIGNING_PUBLIC_KEY'),
    'grace_days' => (int) env('LICENSE_GRACE_DAYS', 7),
];

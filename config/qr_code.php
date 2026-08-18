<?php

return [
    'providers' => [
        SimpleSoftwareIO\QrCode\QrCodeServiceProvider::class,
    ],
    'aliases' => [
        'QrCode' => SimpleSoftwareIO\QrCode\Facades\QrCode::class,
    ],
];


?>
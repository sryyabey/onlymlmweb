<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('license:keys {--write : Write keys directly to the local .env file}', function () {
    $keypair = sodium_crypto_sign_keypair();
    $privateKey = base64_encode(sodium_crypto_sign_secretkey($keypair));
    $publicKey = base64_encode(sodium_crypto_sign_publickey($keypair));

    if ($this->option('write')) {
        $path = base_path('.env');
        $environment = file_get_contents($path);

        foreach (['LICENSE_SIGNING_PRIVATE_KEY' => $privateKey, 'LICENSE_SIGNING_PUBLIC_KEY' => $publicKey] as $name => $value) {
            $line = $name.'='.$value;
            $environment = preg_match('/^'.preg_quote($name, '/').'=.*/m', $environment)
                ? preg_replace('/^'.preg_quote($name, '/').'=.*/m', $line, $environment)
                : rtrim($environment).PHP_EOL.$line.PHP_EOL;
        }

        file_put_contents($path, $environment, LOCK_EX);
        $this->info('Signing keys were written to .env. Run php artisan config:clear.');

        return;
    }

    $this->line('LICENSE_SIGNING_PRIVATE_KEY='.$privateKey);
    $this->line('LICENSE_SIGNING_PUBLIC_KEY='.$publicKey);
    $this->warn('Store the private key only on the onlymlm.com license server.');
})->purpose('Generate an Ed25519 key pair for license documents');

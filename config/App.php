<?php

namespace Config;

class App
{
    public static array $middlewareAliases = [
        'user' => \App\Middleware\UserAuthenticate::class,
        'tattooist' => \App\Middleware\TattooistAuthenticate::class,
    ];
}

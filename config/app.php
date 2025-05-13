<?php

return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Клас пользователя
    'identity' => \Model\User::class,
    //Классы для middleware
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
        'isAdmin' => \Middlewares\AdminMiddleware::class,
    ],
    'validators' => [
        'required' => \vendor\stefan0802\validator\Validators\RequireValidator::class,
        'unique' => Validators\UniqueValidator::class,
        'number' => Validators\NumberValidator::class,
        'avatar' => Validators\AvatarValidator::class,
        'password' => Validators\PasswordValidator::class,
    ],
    'routeAppMiddleware' => [
        'csrf' => \Middlewares\CSRFMiddleware::class,
        'trim' => \Middlewares\TrimMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
    ],
];
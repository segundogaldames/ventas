<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'email'    => 'El campo :attribute debe ser una dirección de correo válida.',
    'min'      => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'attributes' => [
        'email'    => 'correo electrónico',
        'password' => 'contraseña',
    ],
    'custom' => [
        'precio_venta' => [
            'gte' => 'El precio de venta no puede ser menor que el precio de compra.',
        ],
        'stock_maximo' => [
            'gte' => 'El stock máximo no puede ser menor que el stock mínimo.',
        ],
    ],
];

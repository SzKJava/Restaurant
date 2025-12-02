<?php

return [
    "required" => "A(z) :attribute mező nem lehet üres.",
    "alpha_num" => "A(z) :attribute mező csak betű és szám lehet",
    "unique" => "A(z) :attribute már létezik.",
    "min" => "A(z) :attribute mező túl kevés karaktert tartalmaz.",
    "max" => "A(z) :attribute mező túl sok karaktert tartalmaz.",
    "email" => "A(z) :attribute mező formátuma nem megfelelő",
    'password' => [
        'letters' => 'The :attribute mezőnek legalább egy karatert tartalmaznia kell',
        'mixed' => 'The :attribute mezőnek legalább egy kis és nagy betűt tartalmaznia kell',
        'numbers' => 'The :attribute mezőnek legalább egy számot tartalmaznia kell.',
        'symbols' => 'The :attribute mezőnek legalább egy különleges karatert tartalmaznia kell',
        //'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'confirmed' => 'The :attribute mező nem egyezik.',
];
<?php

session_start();

namespace App\Drinks;

// Functions for any project
require 'functions/core/form/core.php';
require 'functions/core/file.php';
require 'functions/core/html/generators.php';

// We have custom validators written in:
require 'functions/app/form/validators.php';

$form = [
    'fields' => [
        'drink_name' => [
            'type' => 'text',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Enter Drink Name',
                    'class' => '',
                ]
            ],
            'validators' => [
                'validate_not_empty',
//                'validate_drink_not_exists',
            ]
        ],
        'drink_image' => [
            'type' => 'url',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Upload Drink Picture',
                    'class' => '',
                ]
            ],
        ],
        'amount_ml' => [
            'type' => 'int',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Drink Capacity',
                    'class' => '',
                ]
            ],
        ],
        'abarot' => [
            'type' => 'int',
            'extra' => [
                'attr' => [
                    'placeholder' => 'Drink Abarot',
                    'class' => '',
                ]
            ],
        ],
    ],
    'buttons' => [
        'create' => [
            'text' => 'Create',
        ],
    ],
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail'
    ]
];

function form_success($filtered_input, &$form) {
    $array_drinks = file_to_array('./data/drinks.json');
    $filtered_input['drinks'] = [];
    $array_drinks[] = $filtered_input;
    array_to_file($array_drinks, './data/drinks.json');

    $form['message'] = "Gėrimas {$filtered_input['drink_name']} sėkmingai sukurtas!";
}

function form_fail($filtered_input, &$form) {
    $form['message'] = 'Klaida!';
}

$filtered_input = get_filtered_input($form);
if (!empty($filtered_input)) {
    $form_success = validate_form($filtered_input, $form);

    if (!$form_success) {
        $display_fail_anim = true;
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create Drink</title>
    </head>
    <body>

        <?php if ($display_fail_anim ?? false): ?>  
            <div id="fail-anim" class="start"></div>  
        <?php endif; ?>

    </body>
</html>





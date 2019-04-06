<?php

return [
    'name' => 'Invoice',
    'description' => 'Invoice',
    'attributes' => [
        'number' => [
            'label' => 'Number'
        ],
        'country' => [
            'label' => 'Country'
        ],
        'locale' => [
            'label' => 'Locale'
        ],
        'currency' => [
            'label' => 'Currency'
        ],
        'type_id' => [
            'label' => 'Invoice Type'
        ],
        'sender_id' => [
            'label' => 'Who emitted the invoice'
        ],
        'recipient_id' => [
            'label' => 'To whom is directed this invoice'
        ]
    ],
    'tabs' => [
        'containers' => 'Containers',
        'items' => 'Items'
    ]
];
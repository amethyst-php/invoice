<?php

return [
    'name' => 'Fattura',
    'description' => 'Fattura',
    'attributes' => [
        'number' => [
            'label' => 'Numero'
        ],
        'country' => [
            'label' => 'Nazione'
        ],
        'locale' => [
            'label' => 'Locale'
        ],
        'currency' => [
            'label' => 'Valuta'
        ],
        'type_id' => [
            'label' => 'Tipologia Fattura'
        ],
        'sender_id' => [
            'label' => 'Chi ha emesso la fattura'
        ],
        'recipient_id' => [
            'label' => 'A chi è indirizzata la fattura'
        ]
    ],
    'tabs' => [
        'containers' => 'Raggruppamenti',
        'items' => 'Elementi'
    ]
];
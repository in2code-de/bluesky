<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'Bluesky plugin',
    'description' => 'Show bluesky feed of an author in TYPO3 frontend.',
    'category' => 'plugin',
    'version' => '1.4.1',
    'author' => 'Alex Kellner',
    'author_email' => 'alexander.kellner@in2code.de',
    'author_company' => 'in2code.de',
    'state' => 'stable',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];

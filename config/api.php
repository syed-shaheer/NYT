<?php

return [
    'nyt' => [
        'base_url' => 'https://api.nytimes.com/svc/books/v3',
        'endpoints' => [
            'best_sellers' => '/lists/best-sellers/history.json', // Ensure this key exists
            // Add more endpoints here as needed
        ],
    ],
    // Add more API configurations here (e.g., 'times', 'other_source')
];
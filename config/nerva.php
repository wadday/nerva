<?php

return [
    'pulse' => [
        'length' => env('PULSE_LENGTH', 10), // in seconds
        'upload_media_directory' => env('PULSE_MEDIA_DIRECTORY', 'pulse_media'),
    ],
];

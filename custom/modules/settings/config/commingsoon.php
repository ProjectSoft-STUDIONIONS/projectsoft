<?php

return [
    'caption' => 'CommingSoon',
    'introtext' => 'Сайт в разработке',
    'settings' => [
        'cs_color' => [
            'caption' => 'Цвет текста',
            'type'  => 'custom_tv:rgbcolor',
            'note'  => 'Цвет текста',
            'default_text' => 'rgba(255,255,266,1)',
        ],
        'cs_bgcolor' => [
            'caption' => 'Наложение цвета на общий фон',
            'type'  => 'custom_tv:rgbcolor',
            'note'  => 'Наложение цвета на общий фон',
            'default_text' => 'rgba(0,0,0,0.1)',
        ],
        'cs_bgcolor_clock' => [
            'caption' => 'Наложение цвета на часы',
            'type'  => 'custom_tv:rgbcolor',
            'note'  => 'Наложение цвета на часы',
            'default_text' => 'rgba(255,255,255,0.1)',
        ],
        'cs_background' => [
            'caption' => 'Изображение фона',
            'type'  => 'image',
            'note'  => 'Изображение фона',
            'default_text' => 'assets/templates/comingsoon/images/default.jpg',
        ],
    ],
];

<?php

return [
	'caption'  => 'Общие настройки',
	'introtext' => '',
	'settings' => [
		'homeslider'=> [
			"caption"=>'Ресурсы для слайдера на главной',
			'type'=> 'custom_tv:selector',
			'note'=>'<style>
				div.Tokenize ul.TokensContainer,
				div.Tokenize ul.TokensContainer > li {
					display: flex;
					text-align: left;
				}
				div.Tokenize ul.TokensContainer {
					flex-direction: column;
					justify-content: flex-start;
				}
				div.Tokenize ul.TokensContainer > li{
					white-space: normal;
					flex-direction: row-reverse;
					justify-content: space-between;
				}
				div.Tokenize ul.TokensContainer > li,
				div.Tokenize ul.TokensContainer > li span {
					flex: 1;
				}
				div.Tokenize ul.TokensContainer li.Token a.Close {
					color: red;
				}
			</style>'
		],
		'display_events' => [
			'caption' => 'Количество записей<br>СОБЫТИЯ',
			'type' => 'number',
			'default_text'=> '12',
			'note' => 'Количество записей, которые будут отображаться на странице СОБЫТИЯ'
		],
		'display_advance' => [
			'caption' => 'Количество записей<br>ДОСТИЖЕНИЯ',
			'type' => 'number',
			'default_text'=> '12',
			'note' => 'Количество записей, которые будут отображаться на странице ДОСТИЖЕНИЯ'
		],
		'display_lession' => [
			'caption' => 'Количество записей<br>МЕТОДИЧЕСКАЯ КОПИЛКА',
			'type' => 'number',
			'default_text'=> '12',
			'note' => 'Количество записей, которые будут отображаться на странице МЕТОДИЧЕСКАЯ КОПИЛКА'
		],
		'display_father' => [
			'caption' => 'Количество записей<br>ДЛЯ РОДИТЕЛЕЙ',
			'type' => 'number',
			'default_text'=> '12',
			'note' => 'Количество записей, которые будут отображаться на странице ДЛЯ РОДИТЕЛЕЙ'
		]
	],
];

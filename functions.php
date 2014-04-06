<?php

/**
 * Вывод массива в виде дерева
 * @param array $array
 * @return void
 */
function pre()
{
	if (!headers_sent()) header('Content-type:text/html; charset=utf-8');

	$is_cli = php_sapi_name() == 'cli';

	echo(!$is_cli ? '<pre>' : '');

	foreach (func_get_args() as $arr)
	{
		print_r($arr);
		if (!is_array($arr) && !is_object($arr)) echo(!$is_cli ? '<br />' : "\n");
	}

	echo(!$is_cli ? '</pre>' : '');
}

/**
 * Вывод массива в виде дерева и прекращение работы скрипта
 * @param array $array
 * @return void
 */
function pred()
{
	if (!headers_sent()) header('Content-type:text/html; charset=utf-8');

	$is_cli = php_sapi_name() == 'cli';

	echo(!$is_cli ? '<pre>' : '');

	foreach (func_get_args() as $arr)
	{
		print_r($arr);
		if (!is_array($arr) && !is_object($arr)) echo(!$is_cli ? '<br />' : "\n");
	}

	die(!$is_cli ? '</pre>' : '');
}

/**
 * Вывод данных с помощью функции var_dump
 * @param array $array
 * @return void
 */
function vre()
{
	if (!headers_sent()) header('Content-type:text/html; charset=utf-8');

	echo('<pre>');
	$args = func_get_args();
	if (count($args) > 1)
	{
		$data = $args;
	}
	elseif (count($args) == 1)
	{
		$data = $args[0];
	}
	else
	{
		$data = null;
	}
	var_dump($data);
	echo('</pre>');
}

/**
 * Вывод данных с помощью функции var_dump и прекращение раоты скрипта
 * @param array $array
 * @return void
 */
function vred()
{
	if (!headers_sent()) header('Content-type:text/html; charset=utf-8');
	
	echo('<pre>');
	$args = func_get_args();
	if (count($args) > 1)
	{
		$data = $args;
	}
	elseif (count($args) == 1)
	{
		$data = $args[0];
	}
	else
	{
		$data = null;
	}
	var_dump($data);
	die('</pre>');
}

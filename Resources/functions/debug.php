<?php

use DebugFunctions\Dumper;

/**
 * Вывести debug информацию
 * @param array $array
 * @return void
 */
function pre()
{
	if (!headers_sent()) {
		header('Content-type:text/html; charset=utf-8');
	}

	(new Dumper)->dump(func_get_args());
}

/**
 * Вывести debug информацию и прекратить работу скрипта
 * @param array $array
 * @return void
 */
function pred()
{
	if (!headers_sent()) {
		header('Content-type:text/html; charset=utf-8');
	}

	(new Dumper)->dump(func_get_args());
	die;
}

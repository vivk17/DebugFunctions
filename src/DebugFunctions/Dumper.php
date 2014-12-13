<?php

namespace DebugFunctions;

use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

/**
 * Класс реализующий стандартный dump с переопределенным обработчиком.
 * Переопределенный обработчик снимает ограничение на уровень вложености.
 */
class Dumper
{
	private $_handler;

	/**
	 * Вывести debug информацию
	 * @param array $arg_list
	 * @return \DebugFunctions\Dumper
	 */
	public function dump(array $arg_list)
	{
		return $this->_initHandler()
			->_dumpByArgList($arg_list);
	}

	/**
	 * Установить обработчик
	 * @param \callable $callable
	 * @return \DebugFunctions\Dumper
	 * @throws \InvalidArgumentException
	 */
    public function setHandler($callable)
    {
        if (null !== $callable && !is_callable($callable, true)) {
            throw new \InvalidArgumentException('Invalid PHP callback.');
        }

        $this->_handler = $callable;

        return $this;
    }

	/**
	 * Инициализировать обработчик
	 * @return \DebugFunctions\Dumper
	 */
	protected function _initHandler()
	{
		if (null === $this->_handler) {
			$this->_handler = function ($var) {
				$cloner = new VarCloner();
				$cloner->setMaxItems(-1);
				$dumper = 'cli' === PHP_SAPI ? new CliDumper() : new HtmlDumper();
				$dumper->dump($cloner->cloneVar($var));
			};
		}

		VarDumper::setHandler($this->_handler);

		return $this;
	}

	/**
	 * Вывести debug информацию по списку переменных
	 * @param array $arg_list
	 * @return \DebugFunctions\Dumper
	 */
	protected function _dumpByArgList(array $arg_list)
	{
		foreach ($arg_list as $var) {
			VarDumper::dump($var);
		}

		return $this;
	}
}
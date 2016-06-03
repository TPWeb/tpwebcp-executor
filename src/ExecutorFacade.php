<?php
namespace TPWeb\TPWebCP\Executor;

use Illuminate\Support\Facades\Facade;

/**
 *
 * PHP Executor Library for TPWebCP
 *
 * @version    1.0.0
 * @package    tpweb/tpwebcp-executor
 * @copyright  Copyright (c) 2016 Made I.T. (http://www.madeit.be) - TPWeb.org (http://www.tpweb.org)
 * @author     Made I.T. <info@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class ExecutorFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'executor';
	}
}
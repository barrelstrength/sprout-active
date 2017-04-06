<?php
namespace barrelstrength\sproutactive\services;

use craft\base\Component;

class Api extends Component
{
	/**
	 * @var Utilities
	 */
	public $utilities;

	public function init()
	{
		$this->utilities = new Utilities();
	}
}
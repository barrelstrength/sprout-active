<?php
namespace barrelstrength\sproutactive;

use Craft;
use craft\base\Plugin;
use barrelstrength\sproutactive\twig\TwigExtensions;

class SproutActive extends Plugin
{
	/**
	 * Enable use of SproutNotes::$plugin-> in place of Craft::$app->
	 *
	 * @var \barrelstrength\sproutactive\services\Api
	 */
	public static $api;

	public function init()
	{
		parent::init();

		self::$api = $this->get('api');

		Craft::$app->view->twig->addExtension(new TwigExtensions());
	}
}

<?php

namespace barrelstrength\sproutactive;

use Craft;
use craft\base\Plugin;
use barrelstrength\sproutactive\services\App;
use barrelstrength\sproutactive\web\twig\TwigExtensions;

class SproutActive extends Plugin
{
    /**
     * Enable use of SproutActive::$app-> in place of Craft::$app->
     *
     * @var App
     */
    public static $app;

    public function init()
    {
        parent::init();

        self::$app = $this->get('app');

        Craft::$app->view->twig->addExtension(new TwigExtensions());
    }
}

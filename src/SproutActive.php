<?php
/**
 * @link https://sprout.barrelstrengthdesign.com
 * @copyright Copyright (c) Barrel Strength Design LLC
 * @license MIT
 */

namespace barrelstrength\sproutactive;

use barrelstrength\sproutactive\services\App;
use barrelstrength\sproutactive\web\twig\TwigExtensions;
use Craft;
use craft\base\Plugin;
use yii\base\InvalidConfigException;

class SproutActive extends Plugin
{
    /**
     * Enable use of SproutActive::$app-> in place of Craft::$app->
     *
     * @var App
     */
    public static $app;

    /**
     * @var string
     */
    public $schemaVersion = '2.0.0';

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->setComponents([
            'app' => App::class
        ]);

        self::$app = $this->get('app');

        Craft::$app->view->registerTwigExtension(new TwigExtensions());
    }
}

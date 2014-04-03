<?php
namespace Craft;

class SproutActivePlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Sprout Active');
    }

    public function getVersion()
    {
        return '0.5.1';
    }

    public function getDeveloper()
    {
        return 'Barrel Strength Design';
    }

    public function getDeveloperUrl()
    {
        return 'http://barrelstrengthdesign.com';
    }

    public function hasCpSection()
    {
        return false;
    }

    public function addTwigExtension()
    {
        Craft::import('plugins.sproutactive.twigextensions.SproutActiveTwigExtension');
        
        return new SproutActiveTwigExtension();
    }

}

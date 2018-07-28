<?php
namespace Craft;

class SproutActivePlugin extends BasePlugin
{
	public function getName()
	{
		return Craft::t('Sprout Active');
	}

	public function getDescription()
	{
		return "Simplify navigation and URL-based logic in your templates.";
	}

	public function getVersion()
	{
		return '1.1.0';
	}

	public function getDeveloper()
	{
		return 'Barrel Strength Design';
	}

	public function getDeveloperUrl()
	{
		return 'http://barrelstrengthdesign.com';
	}

	public function getDocumentationUrl()
	{
		return "http://sprout.barrelstrengthdesign.com/craft-plugins/active/docs";
	}

	public function getReleaseFeedUrl()
	{
		return 'https://raw.githubusercontent.com/barrelstrength/craft-sprout-active/v1/releases.json';
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

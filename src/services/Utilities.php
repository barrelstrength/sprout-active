<?php
namespace barrelstrength\sproutactive\services;

use Craft;
use craft\base\Component;
use craft\helpers\UrlHelper;

class Utilities extends Component
{
	/**
	 * @param $string
	 * @param $segment
	 *
	 * @return bool
	 */
	public function match($string, $segment)
	{
		// Get the slug version of the segment
		$matchString = $this->processSegment($segment);

		// Convert our input into an array
		$matchOptions = explode('|', $string);

		// Return true if the segment matches any of our test values
		return in_array($matchString, $matchOptions);
	}

	/**
	 * Determine how to process the segment requested
	 *
	 * @param  mixed $segment Segment number or keyword
	 * @return string         Segment, Path, or Full URL
	 */
	public function processSegment($segment)
	{
		switch ($segment)
		{
			case 'url':
				return $this->_getUrl();
				break;

			case 'path':
				return Craft::$app->getRequest()->getFullPath();
				break;

			default:
				return Craft::$app->request->getSegment($segment);
				break;
		}
	}

	private function _getUrl()
	{
		$siteUrl = Craft::$app->getConfig()->get('siteUrl');

		if ($siteUrl != null)
		{
			return $siteUrl . Craft::$app->request->url;
		}
		else
		{
			$localeId = Craft::$app->getLocale()->id;

			$localizedSiteUrl = Craft::$app->config->getLocalized('siteUrl', $localeId);

			if (!$localizedSiteUrl)
			{
				$localizedSiteUrl = UrlHelper::siteUrl();
			}

			$localizedSiteUrl = rtrim($localizedSiteUrl, '/');

			// Unless 'omitScriptNameInUrls' is explicitly set to 'true' then page.url will
			// include index.php, we'll have to add it to the localizedSiteUrl
			$omitScriptNameInUrls = Craft::$app->config->getLocalized('omitScriptNameInUrls', $localeId) === TRUE;
			$noIndexInUrls = strpos($localizedSiteUrl, 'index.php') !== TRUE;

			if($omitScriptNameInUrls || $noIndexInUrls)
			{
				return $localizedSiteUrl . '/' . Craft::$app->getRequest()->getFullPath();
			}
			else
			{
				return $localizedSiteUrl . '/index.php/' . Craft::$app->getRequest()->getFullPath();
			}
		}
	}
}


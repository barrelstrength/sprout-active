<?php
namespace Craft;

class SproutActiveService extends BaseApplicationComponent
{
	/**
	 * Check if our URL segment matches an array of test values
	 * 
	 * @param  string  $string  Pipe-delimited list of test values
	 * @param  integer $segment Number representation of the URL segment 
	 * @return boolean          true/false
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
				return $this->_getUrl($segment);
				break;

			case 'path':
				return craft()->request->path;
				break;
			
			default:
				return craft()->request->getSegment($segment);
				break;
		}
	}

	private function _getUrl()
	{	
		if (defined('CRAFT_SITE_URL')) 
		{	
			return CRAFT_SITE_URL . craft()->request->url;
		}
		else
		{	
			$localeId = craft()->getLocale()->id;

			$localizedSiteUrl = craft()->config->getLocalized('siteUrl', $localeId);

			if (!$localizedSiteUrl) 
			{
				$localizedSiteUrl = craft()->getSiteUrl();
			}

			$localizedSiteUrl = rtrim($localizedSiteUrl, '/');

			// Unless 'omitScriptNameInUrls' is explicitly set to 'true' then page.url will
			// include index.php, we'll have to add it to the localizedSiteUrl
			$omitScriptNameInUrls = craft()->config->getLocalized('omitScriptNameInUrls', $localeId) === TRUE;
			$noIndexInUrls = strpos($localizedSiteUrl, 'index.php') !== TRUE;

			if($omitScriptNameInUrls || $noIndexInUrls) 
			{	
				return $localizedSiteUrl . '/' . craft()->request->path;
			}
			else
			{	
				return $localizedSiteUrl . '/index.php/' . craft()->request->path;
			}
		}
	}
}

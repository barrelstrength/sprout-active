<?php

namespace barrelstrength\sproutactive\services;

use Craft;
use craft\base\Component;

class Utilities extends Component
{
    /**
     * Check to see if a string matches a segment in the URL
     *
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
     *
     * @return string         Segment, Path, or Full URL
     */
    public function processSegment($segment)
    {
        switch ($segment) {
            case 'url':
                return $this->_getUrl($segment);
                break;

            case 'path':
                return Craft::$app->request->path;
                break;

            default:
                return Craft::$app->request->getSegment($segment);
                break;
        }
    }

    /**
     * Get the URL
     *
     * @return string
     */
    private function _getUrl()
    {
        if (defined('CRAFT_SITE_URL')) {
            return CRAFT_SITE_URL.Craft::$app->request->url;
        } else {
            $localizedSiteUrl = Craft::$app->getSites()->currentSite->baseUrl;
            $localizedSiteUrl = rtrim($localizedSiteUrl, '/');

            // Unless 'omitScriptNameInUrls' is explicitly set to 'true' then page.url will
            // include index.php, we'll have to add it to the localizedSiteUrl
            $omitScriptNameInUrls = Craft::$app->config->getGeneral()->omitScriptNameInUrls === true;
            $noIndexInUrls = strpos($localizedSiteUrl, 'index.php') !== true;

            if ($omitScriptNameInUrls || $noIndexInUrls) {
                return $localizedSiteUrl.'/'.Craft::$app->request->getFullPath();
            } else {
                return $localizedSiteUrl.'/index.php/'.Craft::$app->request->getFullPath();
            }
        }
    }
}


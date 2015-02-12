<?php
namespace Craft;

class SproutActiveTwigExtension extends \Twig_Extension
{
  /**
   * Plugin Name
   *
   * @return string
   */
  public function getName()
  {
    return 'Sprout Active';
  }

  /**
   * Create our Twig Functions
   *
   * @return array
   */
  public function getFunctions()
  {
    return array(
      'active' => new \Twig_Function_Method($this, 'getActive'),
      'activeClass' => new \Twig_Function_Method($this, 'getActiveClass', array('is_safe' => array('html'))),
      'segment' => new \Twig_Function_Method($this, 'getSegment'),
      'segmentClass' => new \Twig_Function_Method($this, 'getSegmentClass', array('is_safe' => array('html')))
    );
  }

  /**
   * Output the classname if conditions match
   *
   * @param  string  $string    Value from URL to use in test
   * @param  integer $segment   URL segment to test against
   * @param  string  $className Value of CSS class to return to template
   * @return string OR null
   */
  public function getActive($string = '', $segment = 1, $className = 'active')
  {
    $segment = $this->_processSegment($segment);

    return ($string == $segment) ? $className : null;
  }

  /**
   * Output the classname and class parameter if conditionals match
   *
   * @param  string  $string    Value from URL to use in test
   * @param  integer $segment   URL segment to test against
   * @param  mixed  $className Value of CSS class to return to template
   * @return mixed OR null
   */
  public function getActiveClass($string = '', $segment = 1, $className = 'active')
  {
    $segment = $this->_processSegment($segment);
    $activeClassString = 'class="' . $className . '"';

    return ($string == $segment) ? $activeClassString : null;
  }

  /**
   * Output the segment if conditions match
   *
   * @param  integer $segment URL segment to test for
   * @return string OR null   Value of URL segment if it exists
   */
  public function getSegment($segment = null)
  {
    return craft()->request->getSegment($segment);
  }

  /**
   * Output the segment and class parameter if conditions match
   *
   * @param  integer $segment URL segment to test for
   * @return mixed OR null    Value of URL segment wrapped in class parameter if it exists
   */
  public function getSegmentClass($segment = null)
  {
    $segment = craft()->request->getSegment($segment);
    $segmentClassString = 'class="' . $segment . '"';

    return $segmentClassString;
  }

  /**
   * Determine how to process the segment requested
   *
   * @param  mixed $segment Segment number or keyword
   * @return string         Segment, Path, or Full URL
   */
  private function _processSegment($segment)
  {
    switch ($segment) {
      case 'url':
        if(defined('CRAFT_SITE_URL')) {
            return CRAFT_SITE_URL . craft()->request->url;
        } else {
            $localeId = craft()->getLocale()->id;
            $localizedSiteUrl = craft()->config->getLocalized('siteUrl', $localeId);

            //unless 'omitScriptNameInUrls' is explicitly set to 'true' then page.url will
            //include index.php, we'll have to add it to the localizedSiteUrl
            if(craft()->config->getLocalized('omitScriptNameInUrls', $localeId) === TRUE || strpos($localizedSiteUrl, 'index.php') !== FALSE) {
                return rtrim($localizedSiteUrl, '/') . '/' . craft()->request->path;
            } else {
                return rtrim($localizedSiteUrl, '/') . '/index.php/' . craft()->request->path;
            }
        }
        break;

      case 'path':
        return craft()->request->path;
        break;

      default:
        return craft()->request->getSegment($segment);
        break;
    }
  }
}

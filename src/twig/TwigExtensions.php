<?php

namespace barrelstrength\sproutactive\twig;

use Craft;
use \Twig_Extension;
use barrelstrength\sproutactive\SproutActive;

class TwigExtensions extends Twig_Extension
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Sprout Active';
    }

    /**
     * Makes the filters available to the template context
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('active', [$this, 'getActive']),
            new \Twig_SimpleFunction('activeClass', [$this, 'getActiveClass'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('segment', [$this, 'getSegment']),
            new \Twig_SimpleFunction('segmentClass', [$this, 'getSegmentClass'], ['is_safe' => ['html']])
        ];
    }

    /**
     * Output the classname if conditions match
     *
     * @param  string  $string    Value from URL to use in test
     * @param  integer $segment   URL segment to test against
     * @param  string  $className Value of CSS class to return to template
     *
     * @return string OR null
     */
    public function getActive($string = '', $segment = 1, $className = 'active')
    {
        $match = SproutActive::$app->utilities->match($string, $segment);

        return $match ? $className : null;
    }

    /**
     * Output the classname and class parameter if conditionals match
     *
     * @param  string  $string    Value from URL to use in test
     * @param  integer $segment   URL segment to test against
     * @param  mixed   $className Value of CSS class to return to template
     *
     * @return mixed OR null
     */
    public function getActiveClass($string = '', $segment = 1, $className = 'active')
    {
        $match = SproutActive::$app->utilities->match($string, $segment);

        $activeClassString = 'class="'.$className.'"';

        return ($match) ? $activeClassString : null;
    }

    /**
     * Output the segment if conditions match
     *
     * @param  integer $segment URL segment to test for
     *
     * @return string OR null   Value of URL segment if it exists
     */
    public function getSegment($segment = null)
    {
        return Craft::$app->request->getSegment($segment);
    }

    /**
     * Output the segment and class parameter if conditions match
     *
     * @param  integer $segment URL segment to test for
     *
     * @return mixed OR null    Value of URL segment wrapped in class parameter if it exists
     */
    public function getSegmentClass($segment = null)
    {
        $segment = Craft::$app->request->getSegment($segment);

        return 'class="' . $segment . '"';;
    }

}

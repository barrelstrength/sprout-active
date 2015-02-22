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
	  $segment = $this->processSegment($segment);

	  // Convert our input into an array
	  $matchOptions = explode('|', $string);

	  // Return true if the segment matches any of our test values
	  return in_array($segment, $matchOptions);
	}

	/**
	 * Determine how to process the segment requested
	 * 
	 * @param  mixed $segment Segment number or keyword
	 * @return string         Segment, Path, or Full URL
	 */
	public function processSegment($segment)
	{ 
	  switch ($segment) {
	    case 'url':
	      return CRAFT_SITE_URL . craft()->request->url;
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

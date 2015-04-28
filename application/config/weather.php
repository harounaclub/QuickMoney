<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @license		DBAD - http://philsturgeon.co.uk/code/dbad-license
 * @author		Brian Humes
 * @link		  http://twopiers.com
 * @email		  brian@twopiers.com
 * @twitter   twopiers
 * 
 * @file		  autoload.php
 * @version		0.0.1
 * @date		  06/12/2012
 */

/*
|--------------------------------------------------------------------------
| Wunderground.com API Key
|--------------------------------------------------------------------------
|
| Head to http://www.wunderground.com/weather/api/
| and sign up for an API key. Takes 2 minutes. Just do it.
||
*/
$config['api_key'] = '0e4aa52af9395f65';

/*
|--------------------------------------------------------------------------
| Default location
|--------------------------------------------------------------------------
|
| Enter your default location
| 
| Here are some examples:
|
| CA/San_Francisco
| 60290 (U.S. zip code)
| Australia/Sydney
| 37.8,-122.4 (latitude,longitude)
| KJFK (airport code)
| pws:KCASANFR70 (PWS id - Personal Weather Station ID. To see a full list:
|   http://www.wunderground.com/weatherstation/ListStations.asp)
| autoip (AutoIP address location)
| autoip.json?geo_ip=38.102.136.138 (Specific IP address location) 
||
*/

$config['default_location'] = 'autoip';

/*
|--------------------------------------------------------------------------
| Default observation
|--------------------------------------------------------------------------
|
| Set the default metric you are looking for. Options are:
|   weather - returns a friendly string that describes the weather
|   temp - gives the temp as a number (string)
| http://www.wunderground.com/weather/api/d/documentation.html#lang
| DEFAULT: temp
||
*/

$config['default_observation'] = 'temp';

/*
|--------------------------------------------------------------------------
| Default language
|--------------------------------------------------------------------------
|
| Set the language that the API will return. For list of choices:
| http://www.wunderground.com/weather/api/d/documentation.html#lang
| DEFAULT: EN
||
*/

$config['default_language'] = 'FR';

/*
|--------------------------------------------------------------------------
| Degree units
|--------------------------------------------------------------------------
|
| Options: f = fahrenheith, c = celsius
| DEFAULT: f
||
*/

$config['degree_unit'] = 'c';

/*
|--------------------------------------------------------------------------
| English or Metric
|--------------------------------------------------------------------------
|
| Options: e = english (miles, inches), m = metric (kilometers, mm)
| DEFAULT: e
||
*/

$config['distance_unit'] = 'e';

/*
|--------------------------------------------------------------------------
| Icon Set
|--------------------------------------------------------------------------
|
| Which set of icons would you like to use? For list of choices:
| http://www.wunderground.com/weather/api/d/documentation.html#icons
|
| For Set #1, enter 1, for Set #2, enter 2, and so on.
|
| Any value that is not a number between 1 and 9 will return Set #1.
||
*/

$config['icon_set'] = 1;

/*
|--------------------------------------------------------------------------
| Wunderground.com Credit Options
|--------------------------------------------------------------------------
|
| You MUST include a credit to Weather Underground per the ToS.
| Visit http://www.wunderground.com/weather/api/d/documentation.html#logos
| for options and details
||
*/

//options are 4c, blue, black, or white
$config['logo_color'] = '4c';

//options are standard or horz
$config['logo_orientation'] = 'standard'; 

//name of the class of the div that houses the logo
$config['logo_div_class'] = 'weather_credit';

//options are large, medium, small
//feel free to edit or add dimensions in the library file
$config['logo_size'] = 'medium';

// --------------------------------------------------------------------------

/* End of file weather.php */
/* Location: ./weather/config/weather.php */
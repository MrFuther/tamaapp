<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['activity'] = 'activity/index';
$route['report'] = 'report/index';
$route['unitkerja'] = 'unitkerja/index';
$route['subunitkerja'] = 'subunitkerja/index';
$route['grouparea'] = 'grouparea/index';
$route['subarea'] = 'subarea/index';
$route['groupdevice'] = 'groupdevice/index';
$route['subdevice'] = 'subdevice/index';
$route['locationdata'] = 'locationdata/index';
$route['devicedata'] = 'devicedata/index';
$route['personel'] = 'personel/index';
$route['m_user'] = 'manageuser/index';
$route['shift'] = 'shift/index';
$route['get-group-areas'] = 'activity/get_group_areas';
$route['get-sub-areas'] = 'activity/get_sub_areas';
$route['activity/add_documentation'] = 'activity/add_documentation';
$route['forbidden'] = 'errors/custom_forbidden';
$route['404_override'] = 'errors/forbidden';
$route['translate_uri_dashes'] = FALSE;

<?php
defined('BASEPATH') or exit('No direct script access allowed');
$autoload['packages'] = array();
$autoload['libraries'] = array(
	'cart',
	'database',
	'session',
	'form_validation',
	'pagination',
	'engine',

);
$autoload['drivers'] = array();
$autoload['helper'] = array(
	'url',
	'form',
	'hand',
	'authority',
	'display',
	'time',
	'cookie',
	'jute',
	'khamal',
	'opening_calculation'

);
$autoload['config'] = array();
$autoload['language'] = array();

$autoload['model'] = array(
	'Common',
	'authentication/User',
	'M_test',
	'M_jute_entry',
	'M_khamal'

);

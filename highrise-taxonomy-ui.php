<?php
/*
Plugin Name: Highrise Taxonmy UI
Plugin URI: https://highrise.digital
Description: Provides additional UI meta boxes for taxonomies such as select and radio inputs, rather than the standard checkboxes.
Version: 1.0
Author: Highrise Digital Ltd
Author URI: https://highrise.digital
License: GPLv2 or later
Text Domain: highrise-taxonomy-ui
*/

/**
 * Copyright (c) 2016 Highrise Digitial Ltd. All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * **********************************************************************
 */

/* exist if directly accessed */
if( ! defined( 'ABSPATH' ) ) exit;

/* define variable for path to this plugin file. */
define( 'HDTUI_LOCATION', dirname( __FILE__ ) );

/* load the radio walker and meta box files */
require_once( dirname( __FILE__ ) . '/inc/walkers/walker-radio.php' );
require_once( dirname( __FILE__ ) . '/inc/meta-boxes/meta-box-radio.php' );

/* load the drodown walker and meta box files */
require_once( dirname( __FILE__ ) . '/inc/walkers/walker-dropdown.php' );
require_once( dirname( __FILE__ ) . '/inc/meta-boxes/meta-box-dropdown.php' );
<?php

/**
 * HumHub
 * Copyright © 2014 The HumHub Project
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 */
$yii = dirname(__FILE__) . '/protected/vendors/yii/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';
$appClass = dirname(__FILE__) . '/protected/components/WebApplication.php';

// Disable these 3 lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 5);
ini_set('error_reporting', E_ALL);

require_once($yii);
require_once($appClass);

$app = Yii::createApplication('WebApplication', $config);

Yii::import('application.vendors.*');
EZendAutoloader::$prefixes = array('Zend', 'Custom');
Yii::import("ext.yiiext.components.zendAutoloader.EZendAutoloader", true);
Yii::registerAutoloader(array("EZendAutoloader", "loadClass"), true);

$app->run();
?>

<!DOCTYPE html>
<html>
	<head>  
              <meta charset="UTF-8">

		<title>thooth (tm) .: Search results</title>

		<link rel="stylesheet" href="css-th/structure.css" />
		<link rel="stylesheet" href="css-th/style.css" />

		<link rel="shortcut icon" href="favicon.ico" />

		<link rel="search" type="application/opensearchdescription+xml" title="thooth (tm) Search" href="thoothsearch.xml" />

		<script src="js-th/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="js-th/prototype.js" type="text/javascript"></script>

		<script src="js-th/util.js" type="text/javascript"></script>
		<script src="js-th/md5.js" type="text/javascript"></script>

		<!-- server to connect to for JSON -->
		<script src="JSON/servertouse.js" type="text/javascript"></script>

		<!-- server call for logout -->
		<script src="JSON/serverCall.js" type="text/javascript"></script>
		<script type="text/javascript" src="js-th/i18n/i18n.js"></script>

		<!-- tooTip include -->
		<script src="js-th/wsToolTip.js" type="text/javascript"></script>

		<!-- try_other stuffs -->
		<script src="js-th/tryother.js" type="text/javascript"></script>

		<!-- related dialogue stuffs -->
		<script src="js-th/related.js" type="text/javascript"></script>

		<!-- expand mini article stuffs -->
		<script src="js-th/expand_ma.js" type="text/javascript"></script>

		<!-- expand mini article stuffs -->
		<script src="js-th/langselect.js" type="text/javascript"></script>

		<!-- history display/management stuffs -->
		<script src="js-th/hist.js" type="text/javascript"></script>

		<!-- annotation/selection rendering -->
		<script src="js-th/ann.js" type="text/javascript"></script>

		<!-- where anything that interacts w/ the dom lives -->
		<script src="js-th/ui.js" type="text/javascript"></script>

		<!-- where the main logic and timers/json/network/etc live -->
		<script src="js-th/main.js" type="text/javascript"></script>
		<script src="js-th/advancedadd.js" type="text/javascript"></script>

		<!-- wise apps!! -->
		<script src="WISE/wise.js" type="text/javascript"></script>
<!--
		<script src="WISE/wise_apps.js" type="text/javascript"></script>
-->
		<script src="WISE/search_apps.js" type="text/javascript"></script>
		<script src="js-th/can_save.js" type="text/javascript"></script>

		<!--[if lt IE 7.]>
		<script defer type="text/javascript" src="js-th/pngfix.js"></script>
		<![endif]-->

    	</head>
	<body>

<noscript> 
			<div class="jswarning"><img src="images/front-logo.png" height="40" align="absmiddle" hspace="10"> Thooth Search requires JavaScript to be enabled. Please enable it in your browser and refresh the page.</div> 
		</noscript> 
		<div id="container" class="search-page">
			<script type="text/javascript" src="js-th/header.js"></script>
			<div id="search-results-container">
				<div id="search-results">
					<div id="search-results-top">
						<div id="cloud-title"></div>
						<div id="cloud"></div>
	
						<div id="suggest-container" style="display:none;"></div>
						<div id="wise_placeholder"></div>
						<div id="wide_ad_unit" class="wide_ads" style="display:none;"></div>
					</div>
				</div>
				<div id="loading" style=""><script>document.write(getspan("loading..."))</script></div>
			</div>
			
			
			<div id="search-side-container" style="display:none;">
				<div id="search-results-side">
					<div class="panel">
						<h2><script>document.write(getspan("Add to this result"))</script></h2>
						<form class="panelBody" id="add-site" method="post" action="javascript:" onsubmit="return addSite();">
							<div class="add-site-message"><script>document.write(getspan("Instantly add sites to the search results!"))</script> (<a href="javascript:show_advancedadd();"><script>document.write(getspan("advanced"))</script></a>)</div>
							<input id="addinput" type="text" value="http://" class="textbox" />
							<!-- FIXME: The button label is currently not translated on the fly.
							     Reload the page to re-translate it. -->
							<script>document.write('<input id="add_site_btn" type="submit" value="'+gettexta("add", {id: 'add_site_btn', param: 'value'})+'" />')</script>
						</form>
					</div>
					<div id="page-history" class="panel">
						<h2>
							<script>document.write(getspan("Result History"))</script>
							<span id="history-count"></span>
						</h2>
						<div class="panelBody">
							<div class="subtitle"><script>document.write(getspan("User contributions for this result"))</script> <span id="history-rss"></span></div>
							<form id="history-filter" action="javascript:"><script>document.write(getspan("Show only changes by:"))</script><br>
								<select name="byact" onchange="histBy('act',this)"><option>all</option></select>
								<select name="byuser" onchange="histBy('user',this)"><option>all</option></select>
								<select name="bylink" onchange="histBy('link',this)"><option>all</option></select>
							</form>
							<div id="histories"></div>
						</div>
					</div>
					<div class="panel">
						<h2><script>document.write(getspan("Shortcuts"))</script></h2>
						<div id="try-container" class="panelBody">
							<div class="subtitle"><script>document.write(getspan("Links to other search results"))</script></div>
							<span id="try-list"></span> <u class="add-more" onclick="javascript:show_tryother();">(+)</u>
						</div>
					</div>
					<div class="panel">
						<div id="admin-tools" style="display:none;"></div>
					</div>
					<div class="panel">
						<div id="ads_show" style="display:block;">
							<div id="narrow_ad_unit" class="narrow_ads" style="display:none;"></div>
						</div>
					</div>
				</div>
				
			</div>
			<div style="clear: both; display: block;"></div>
		</div>
		
		<div id="preview-container" style="display:none;">
			<div id="preview-header" class="preview-header">
				<a class="preview-close" href="javascript:void(0);" onclick="javascript:previewX();"><script>document.write(getspan("Close"))</script></a>
				<h3><script>document.write(getspan("Annotation Window"))</script></h3>
				<div class="preview-text">
					<script>document.write(getspan("You can add annotations to this search result. To add images or links, click the image or link you wish to add to the result. To add text, highlight the passage you want included."))</script>
				</div>
			</div>
			<iframe id="preview" class="preview-window" style="display:none;" frameborder="0"></iframe>
		</div>
		
		
		<div id="verybottom" style="display:inline;"></div>


	</body>
</html>


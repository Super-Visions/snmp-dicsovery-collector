<?php
/**
 * @copyright 2024 Super-Visions BVBA
 * @license http://opensource.org/licenses/AGPL-3.0
 */

define('APPROOT', dirname(__DIR__).'/');

require_once(APPROOT.'core/parameters.class.inc.php');
require_once(APPROOT.'core/utils.class.inc.php');
require_once(APPROOT.'core/restclient.class.inc.php');
require_once(APPROOT.'core/collector.class.inc.php');
require_once(APPROOT.'core/orchestrator.class.inc.php');
require_once(__DIR__.'/main.php');

try {
	Utils::InitConsoleLogLevel();
	
	if (!Orchestrator::CheckRequirements()) {
		exit(1);
	}
	
	$oCollector = new SnmpDiscoveryCollector();
	$oCollector->InitMessageQueue();
	
	$oCollector->StartWorker();
	
} catch (Exception $e) {
	Utils::Log(LOG_ERR, $e->getMessage());
	exit(1);
}

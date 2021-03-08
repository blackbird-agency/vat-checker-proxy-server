<?php

namespace Blackbird\VatCheckerProxyServer;
require 'vendor/autoload.php';
require 'conf.php';

$service = new Service(PROTECTION_KEY, EUROPA_CHECKER_URL);
$service->execute();
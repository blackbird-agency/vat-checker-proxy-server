<?php
/*
 * Blackbird Vat Checker Proxy Server
 *
 * NOTICE OF LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@bird.eu so we can send you a copy immediately.
 * @category        Blackbird
 * @copyright       Copyright (c) Blackbird (https://black.bird.eu)
 * @author          Blackbird Team
 * @license         MIT
 * @support         https://github.com/blackbird-agency/vat-checker-proxy-server/issues/new
 */

namespace Blackbird\VatCheckerProxyServer;
require '../vendor/autoload.php';
require '../conf.php';

$service = new Service(PROTECTION_KEY, EUROPA_CHECKER_URL);
$service->execute();
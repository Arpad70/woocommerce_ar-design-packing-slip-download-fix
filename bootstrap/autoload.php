<?php

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once ARD_PACKING_SLIP_FIX_PATH . 'src/Support/Autoloader.php';
require_once ARD_PACKING_SLIP_FIX_PATH . 'src/Support/Updates/GitHubUpdater.php';
require_once ARD_PACKING_SLIP_FIX_PATH . 'src/Support/Updates/RollbackManager.php';
require_once ARD_PACKING_SLIP_FIX_PATH . 'src/Presentation/Admin/PackingSlipDownloadButton.php';
require_once ARD_PACKING_SLIP_FIX_PATH . 'src/Application/Bootstrap.php';

<?php

declare(strict_types=1);

namespace ArDesign\PackingSlipDownloadFix\Support\Updates;

use ArDesign\Shared\Updates\PluginRollbackManager as BasePluginRollbackManager;

defined( 'ABSPATH' ) || exit;

require_once WP_PLUGIN_DIR . '/ar-design-shared-support/includes/updates/PluginRollbackManager.php';

final class RollbackManager extends BasePluginRollbackManager
{
	public function __construct( string $plugin_basename, string $plugin_root )
	{
		parent::__construct(
			$plugin_basename,
			$plugin_root,
			array(
				'backup_dir' => 'ard-packing-slip-fix-backups',
				'error_code' => 'ard_packing_slip_fix_rollback_performed',
				'error_message' => 'Aktualizácia Ar Design Packing Slip Download Fix zlyhala. Predchádzajúca verzia bola automaticky obnovená zo zálohy.',
				'text_domain' => 'ar-design-packing-slip-download-fix',
			)
		);
	}
}

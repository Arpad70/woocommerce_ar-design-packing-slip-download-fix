<?php

declare(strict_types=1);

namespace ArDesign\PackingSlipDownloadFix\Application;

defined( 'ABSPATH' ) || exit;

use ArDesign\PackingSlipDownloadFix\Presentation\Admin\PackingSlipDownloadButton;
use ArDesign\PackingSlipDownloadFix\Support\Updates\GitHubUpdater;
use ArDesign\PackingSlipDownloadFix\Support\Updates\RollbackManager;

final class Bootstrap
{
	private static ?self $instance = null;

	private GitHubUpdater $updater;

	private RollbackManager $rollback_manager;

	private PackingSlipDownloadButton $packing_slip_download_button;

	private function __construct()
	{
		$this->updater                      = new GitHubUpdater(
			ARD_PACKING_SLIP_FIX_GITHUB_REPOSITORY,
			ARD_PACKING_SLIP_FIX_BASENAME,
			ARD_PACKING_SLIP_FIX_VERSION,
			ARD_PACKING_SLIP_FIX_SLUG,
			'Ar Design Packing Slip Download Fix',
			'ar-design-packing-slip-download-fix',
			'Pridáva tlačidlo na stiahnutie dodacieho listu do detailu WooCommerce objednávky.'
		);
		$this->rollback_manager            = new RollbackManager( ARD_PACKING_SLIP_FIX_BASENAME, ARD_PACKING_SLIP_FIX_PATH );
		$this->packing_slip_download_button = new PackingSlipDownloadButton();
	}

	public static function boot(): self
	{
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function run(): void
	{
		add_action( 'init', array( $this, 'loadTextDomain' ) );
		add_action( 'woocommerce_loaded', array( $this, 'bootstrapRuntime' ), 20 );
	}

	public function loadTextDomain(): void
	{
		load_plugin_textdomain(
			'ar-design-packing-slip-download-fix',
			false,
			dirname( ARD_PACKING_SLIP_FIX_BASENAME ) . '/languages/'
		);
	}

	public function bootstrapRuntime(): void
	{
		if ( ! function_exists( 'WC' ) ) {
			return;
		}

		$this->updater->register();
		$this->rollback_manager->register();

		if ( is_admin() ) {
			$this->packing_slip_download_button->register();
			add_action( 'admin_notices', array( $this, 'renderDependencyNotice' ) );
		}
	}

	public static function activate(): void
	{
		update_option( 'ard_packing_slip_fix_version', ARD_PACKING_SLIP_FIX_VERSION );
	}

	public static function deactivate(): void
	{
		// Intentionally left blank.
	}

	public function renderDependencyNotice(): void
	{
		if ( $this->hasPdfDependency() ) {
			return;
		}

		if ( ! current_user_can( 'manage_woocommerce' ) && ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
		$screen_id = $screen && isset( $screen->id ) ? (string) $screen->id : '';

		if ( '' !== $screen_id && false === strpos( $screen_id, 'shop-order' ) && false === strpos( $screen_id, 'wc-orders' ) && false === strpos( $screen_id, 'plugins' ) ) {
			return;
		}

		echo '<div class="notice notice-warning"><p>';
		echo esc_html__( 'Ar Design Packing Slip Download Fix vyžaduje aktívny plugin WooCommerce PDF Invoices & Packing Slips.', 'ar-design-packing-slip-download-fix' );
		echo '</p></div>';
	}

	private function hasPdfDependency(): bool
	{
		return function_exists( 'WPO_WCPDF' ) && function_exists( 'wcpdf_get_document' );
	}
}

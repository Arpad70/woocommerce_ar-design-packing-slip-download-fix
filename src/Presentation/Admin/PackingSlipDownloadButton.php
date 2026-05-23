<?php

declare(strict_types=1);

namespace ArDesign\PackingSlipDownloadFix\Presentation\Admin;

defined( 'ABSPATH' ) || exit;

final class PackingSlipDownloadButton
{
	public function register(): void
	{
		add_action( 'wpo_wcpdf_meta_box_after_document_data', array( $this, 'render' ), 20, 2 );
	}

	/**
	 * @param mixed $document
	 * @param mixed $order
	 */
	public function render( $document, $order ): void
	{
		if ( ! current_user_can( 'manage_woocommerce' ) && ! current_user_can( 'manage_options' ) ) {
			return;
		}

		if ( ! $order instanceof \WC_Order ) {
			return;
		}

		if ( ! is_object( $document ) || ! method_exists( $document, 'get_type' ) || ! method_exists( $document, 'exists' ) ) {
			return;
		}

		if ( 'packing-slip' !== (string) $document->get_type() || ! $document->exists() ) {
			return;
		}

		if ( ! function_exists( 'WPO_WCPDF' ) ) {
			return;
		}

		$document_url = WPO_WCPDF()->endpoint->get_document_link( $order, 'packing-slip' );

		if ( '' === $document_url ) {
			return;
		}

		echo '<div class="ard-packing-slip-download" style="margin-top:12px;">';
		echo '<a class="button button-secondary" href="' . esc_url( $document_url ) . '" target="_blank" rel="noopener noreferrer">';
		echo esc_html__( 'Stáhnout dodací list', 'ar-design-packing-slip-download-fix' );
		echo '</a>';
		echo '</div>';
	}
}

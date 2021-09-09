
<?php
/**
 * AJAX mark as paid.
 *
 * @package WordPress.
 */

function ci_paid_invoice() {

	if ( check_ajax_referer( 'ci-invoices', 'nonce', false ) === false ) {
		wp_send_json_error();
	}

	if ( isset( $_POST['invoice_array'] ) ) {
		$invoice_array = sanitize_text_field( $_POST['invoice_array'] );

		$invoice_array = explode( ',', $invoice_array );

		foreach ( $invoice_array as $invoice ) {
			update_field( 'invoice_paid', 1, $invoice );
		}
	}
	wp_send_json_success();
}

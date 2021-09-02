<?php
/**
 * Invoices archive template.
 *
 * @package WordPress
 */

get_header();
?>
<main>
	<section class="invoice-table">
		<div class="invoice-table__container">
			<div class="invoice-table__table-header">
				<div><input type="checkbox" id="js--select-all"></div>
				<div><?php esc_html_e( 'ID', 'createit-demo' ); ?></div>
				<div><?php esc_html_e( 'Restaurant', 'createit-demo' ); ?></div>
				<div><?php esc_html_e( 'Status', 'createit-demo' ); ?></div>
				<div><?php esc_html_e( 'Start date', 'createit-demo' ); ?></div>
				<div><?php esc_html_e( 'End date', 'createit-demo' ); ?></div>
				<div><?php esc_html_e( 'Total', 'createit-demo' ); ?></div>
				<div><?php esc_html_e( 'Fee', 'createit-demo' ); ?></div>
				<div><?php esc_html_e( 'Transfer', 'createit-demo' ); ?></div>
				<div><?php esc_html_e( 'Orders', 'createit-demo' ); ?></div>
			</div>
			<?php
			while ( have_posts() ) :
				the_post();
				$invoice_restaurant = get_field( 'invoice_restaurant' );
				$invoice_status     = get_field( 'invoice_status' );
				$invoice_start_date = get_field( 'invoice_start_date' );
				$invoice_end_date   = get_field( 'invoice_end_date' );
				$invoice_total      = get_field( 'invoice_total' );
				$invoice_fees       = get_field( 'invoice_fees' );
				$invoice_transfer   = get_field( 'invoice_transfer' );
				$invoice_orders     = get_field( 'invoice_orders' );
				?>
				<div class="invoice-table__row">
					<div class="invoice-table__check">
						<input type="checkbox" id="the_ID">
					</div>
					<div class="invoice-table__id">#<?php the_ID(); ?></div>
					<div class="invoice-table__restaurant">
						<?php
						if ( ! empty( $invoice_restaurant ) ) :
							echo get_the_post_thumbnail( $invoice_restaurant, 'restaurant_thumbnail' );
							?>
							<span><?php echo esc_attr( $invoice_restaurant->post_title ); ?></span>
							<?php
						endif;
						?>
					</div>
					<div class="invoice-table__status <?php echo ( ! empty( $invoice_status ) ) ? esc_attr( 'invoice-table__status--' . $invoice_status ) : ''; ?>">
						<div><?php echo ( ! empty( $invoice_status ) ) ? esc_html( $invoice_status ) : ''; ?></div>
					</div>
					<div class="invoice-table__start-date">
						<?php echo ( ! empty( $invoice_start_date ) ) ? esc_html( $invoice_start_date ) : ''; ?>
					</div>
					<div class="invoice-table__end-date">
						<?php echo ( ! empty( $invoice_end_date ) ) ? esc_html( $invoice_end_date ) : ''; ?>
					</div>
					<div class="invoice-table__total">
						HK$<?php echo ( ! empty( $invoice_total ) ) ? esc_html( $invoice_total ) : ''; ?>
					</div>
					<div class="invoice-table__fees">
						HK$<?php echo ( ! empty( $invoice_fees ) ) ? esc_html( $invoice_fees ) : ''; ?>
					</div>
					<div class="invoice-table__transfer">
						HK$<?php echo ( ! empty( $invoice_transfer ) ) ? esc_html( $invoice_transfer ) : ''; ?>
					</div>
					<div class="invoice-table__orders">
						<?php echo ( ! empty( $invoice_orders ) ) ? esc_html( $invoice_orders ) : ''; ?>
					</div>
				</div>
				<?php
			endwhile;
			?>
		</div>
	</section>
</main>
<?php
get_footer();
?>

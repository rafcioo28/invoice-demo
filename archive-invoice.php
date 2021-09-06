<?php
/**
 * Invoices archive template.
 *
 * @package WordPress
 */

get_header();
?>
<main>
	<section class="heading">
		<h1>Invoices</h1>
	</section>
	<section class="filters">
		<div class="filters__container">
			<div class="filters__status">
				<div class="filters__status-filter filters__status-filter--active js--filter" data-filter="all">
					<?php esc_html_e( 'All', 'createit-demo' ); ?>
				</div>
				<div class="filters__status-filter  js--filter" data-filter="outgoing">
					<?php esc_html_e( 'Outgoing', 'createit-demo' ); ?>
				</div>
				<div class="filters__status-filter  js--filter" data-filter="verified">
					<?php esc_html_e( 'Verified', 'createit-demo' ); ?>
				</div>
				<div class="filters__status-filter  js--filter" data-filter="pending">
					<?php esc_html_e( 'Pending', 'createit-demo' ); ?>
				</div>
			</div>

			<div class="filters__dates">
				<div class="filters__dates-label">
					<?php esc_html_e( 'From', 'createit-demo' ); ?>
				</div>
				<input type="text" id="js--date-from">
			</div>

			<div class="filters__search">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
				<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
			</svg>
			<input type="text" id="js--invoice-search" placeholder="<?php esc_html_e( 'Search', 'createit-demo' ); ?>">
			</div>
			<button class="filters__paid-btn"><?php esc_html_e( 'Mark as paid', 'createit-demo' ); ?></button>
		</div>
	</section>
	<section class="invoice-table">
		<div class="invoice-table__container">
			<div class="invoice-table__table-header">
				<div><label class="js--select-all"><input type="checkbox"><span></span></label></div>
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
		</div>
	</section>
</main>
<?php
get_footer();
?>

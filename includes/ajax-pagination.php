
<?php
/**
 * AJAX Pagination.
 *
 * @package WordPress.
 */

function ci_invoices_pagination() {
	$msg = '';

	if ( isset( $_POST['page'] ) ) {

		$page         = sanitize_text_field( $_POST['page'] );
		$cur_page     = $page;
		$page         = --$page;
		$per_page     = 2;
		$previous_btn = true;
		$next_btn     = true;
		$start        = $page * $per_page;

		$invoices = new WP_Query(
			array(
				'post_type'      => 'invoice',
				'post_status '   => 'publish',
				'orderby'        => 'post_date',
				'order'          => 'DESC',
				'posts_per_page' => $per_page,
				'offset'         => $start,
			)
		);

		$count = new WP_Query(
			array(
				'post_type'      => 'invoice',
				'post_status '   => 'publish',
				'posts_per_page' => -1,
			)
		);

		$count = $count->post_count;
		if ( $invoices->have_posts() ) :
			while ( $invoices->have_posts() ) :
				$invoices->the_post();
				$invoice_restaurant = get_field( 'invoice_restaurant' );
				$invoice_status     = get_field( 'invoice_status' );
				$invoice_start_date = get_field( 'invoice_start_date' );
				$invoice_end_date   = get_field( 'invoice_end_date' );
				$invoice_total      = get_field( 'invoice_total' );
				$invoice_fees       = get_field( 'invoice_fees' );
				$invoice_transfer   = get_field( 'invoice_transfer' );
				$invoice_orders     = get_field( 'invoice_orders' );
				?>
				<div class="invoice-table__row js--row">
					<div class="invoice-table__check">
						<label>
							<input type="checkbox" id="<?php the_ID(); ?>">
							<span></span>
						</label>
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
		endif;
		$no_of_paginations = ceil( $count / $per_page );

		if ( $cur_page >= 7 ) {
			$start_loop = $cur_page - 3;
			if ( $no_of_paginations > $cur_page + 3 ) {
				$end_loop = $cur_page + 3;
			} elseif ( $cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6 ) {
				$start_loop = $no_of_paginations - 6;
				$end_loop   = $no_of_paginations;
			} else {
				$end_loop = $no_of_paginations;
			}
		} else {
			$start_loop = 1;
			if ( $no_of_paginations > 7 ) {
				$end_loop = 7;
			} else {
				$end_loop = $no_of_paginations;
			}
		}

		$pag_container .= '
		<div class="ci-pagination">
			<ul>';

		if ( $previous_btn && $cur_page > 1 ) {
			$pre            = $cur_page - 1;
			$pag_container .= "<li p='$pre' class='active'><</li>";
		} elseif ( $previous_btn ) {
			$pag_container .= "<li class='inactive'><</li>";
		}
		for ( $i = $start_loop; $i <= $end_loop; $i++ ) {
			if ( $cur_page == $i ) {
				$pag_container .= "<li p='$i' class = 'selected' >{$i}</li>";
			} else {
				$pag_container .= "<li p='$i' class='active'>{$i}</li>";
			}
		}

		if ( $next_btn && $cur_page < $no_of_paginations ) {
			$nex            = $cur_page + 1;
			$pag_container .= "<li p='$nex' class='active'>></li>";
		} elseif ( $next_btn ) {
			$pag_container .= "<li class='inactive'>></li>";
		}

		$pag_container = $pag_container . '</ul></div>';

		echo '<div class="ci-pagination-nav">' . $pag_container . '</div>';
	}
	exit();
}

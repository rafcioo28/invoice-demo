
<?php
/**
 * AJAX Pagination.
 *
 * @package WordPress.
 */

function ci_invoices_pagination() {

	if ( check_ajax_referer( 'ci-invoices', 'nonce', false ) === false ) {
		wp_send_json_error();
	}

	ob_start();
	if ( isset( $_POST['page'] ) && isset( $_POST['filter'] ) ) {

		$page          = sanitize_text_field( $_POST['page'] );
		$filter        = sanitize_text_field( $_POST['filter'] );
		$cur_page      = $page;
		$page          = --$page;
		$per_page      = 10;
		$previous_btn  = true;
		$next_btn      = true;
		$pag_container = '';
		$start         = $page * $per_page;
		$meta_filter   = array();
		$meta_start    = array();
		$meta_end      = array();
		$meta_text     = ( isset( $_POST['search_text'] ) ) ? sanitize_text_field( $_POST['search_text'] ) : '';

		if ( isset( $_POST['start_date'] ) && isset( $_POST['end_date'] ) ) {

			$start_date = sanitize_text_field( $_POST['start_date'] );
			$end_date   = sanitize_text_field( $_POST['end_date'] );

			if ( 'false' !== $start_date && 'false' !== $end_date ) {
				$meta_start = array(
					'key'     => 'invoice_start_date',
					'value'   => $start_date,
					'compare' => '>=',
					'type'    => 'DATE',
				);

				$meta_end = array(
					'key'     => 'invoice_start_date',
					'value'   => $end_date,
					'compare' => '<=',
					'type'    => 'DATE',
				);
			}
		}

		if ( 'all' !== $filter ) {
			$meta_filter = array(
				'key'     => 'invoice_status',
				'value'   => $filter,
				'compare' => '=',
			);
		}

		if ( 'false' !== $meta_text ) {

			$restaurants_array = array(
				'fields'         => 'ids',
				'post_type'      => 'restaurant',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				's'              => $meta_text,
			);

			$meta_search_array = get_posts( $restaurants_array );

			if ( ! empty( $meta_search_array ) ) {
				$meta_search = array(
					'key'     => 'invoice_restaurant',
					'value'   => $meta_search_array,
					'compare' => 'IN',
				);
			} else {
				$meta_search = array(
					'key'     => 'invoice_restaurant',
					'value'   => null,
					'compare' => 'IN',
				);
			}
		}

		$meta_query = array(
			'relation' => 'AND',
			$meta_filter,
			$meta_start,
			$meta_end,
			$meta_search,
		);

		$invoices = new WP_Query(
			array(
				'post_type'      => 'invoice',
				'post_status'    => 'publish',
				'orderby'        => 'post_date',
				'order'          => 'DESC',
				'posts_per_page' => $per_page,
				'offset'         => $start,
				'meta_query'     => $meta_query,
			)
		);

		$count = new WP_Query(
			array(
				'post_type'      => 'invoice',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'meta_query'     => $meta_query,
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
				$invoice_paid       = get_field( 'invoice_paid' );
				?>
				<div class="invoice-table__row js--row">
					<div class="invoice-table__check">
						<label>
							<input type="checkbox" data-invoice-id="<?php the_ID(); ?>">
							<span></span>
						</label>
					</div>
					<div class="invoice-table__id">#<?php the_ID(); ?></div>
					<div class="invoice-table__restaurant">
						<?php
						if ( ! empty( $invoice_restaurant ) ) :
							echo get_the_post_thumbnail( $invoice_restaurant, 'restaurant_thumbnail' );
							?>
							<span class="invoice-table__name"><?php echo esc_attr( $invoice_restaurant->post_title ); ?></span>
							<?php
						endif;
						if ( ! empty( $invoice_paid ) ) :
							?>
							<span class="invoice-table__paid"><?php esc_html_e( 'Paid', 'createit-demo' ); ?></span>
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
						<a href="#" class="invoice-table__download"><img src="<?php echo get_template_directory_uri(); ?>/images/download-ico.jpg" width="28" height="28" alt="Download-icon"></a>
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
		<div class="ci-pagination__navigation">
			<ul>';

		if ( $previous_btn && $cur_page > 1 ) {
			$pre            = $cur_page - 1;
			$pag_container .= "<li p='$pre' class='active'><</li>";
		} elseif ( $previous_btn ) {
			$pag_container .= "<li class='inactive'><</li>";
		}
		for ( $i = $start_loop; $i <= $end_loop; $i++ ) {
			if ( $i === (int) $cur_page ) {
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

		echo '<div class="ci-pagination">';
		echo '<div class="ci-pagination__page-of">';
		printf( esc_html__( 'page %1$d of %2$d', 'createit-demo' ), $cur_page, $no_of_paginations );
		echo '</div>';
		echo $pag_container;
		echo '</div>';
	}

	$output = ob_get_clean();

	$response = array(
		'table' => $output,
	);

	wp_send_json_success( $response );
}

<?php
/**
 * Upcoming events list from site.json → events.list (past events drop off automatically).
 * Args: limit (int, 0 = all), show_past (bool).
 */
$args      = isset( $args ) && is_array( $args ) ? $args : array();
$limit     = (int) ( $args['limit'] ?? 3 );
$show_past = ! empty( $args['show_past'] );
$events    = mng_events();
$upcoming  = $limit > 0 ? array_slice( $events['upcoming'], 0, $limit ) : $events['upcoming'];
?>
<div class="mng-events">
	<?php if ( $upcoming ) : ?>
		<ul class="mng-events__list">
			<?php foreach ( $upcoming as $i => $e ) :
				$d = date_create( $e['start'] );
				?>
				<li class="mng-event wow fadeInUp" data-wow-delay="<?php echo esc_attr( ( $i * 0.08 ) . 's' ); ?>">
					<time class="mng-event__date" datetime="<?php echo esc_attr( $e['start'] ); ?>">
						<span class="mng-event__mon"><?php echo esc_html( $d ? $d->format( 'M' ) : '' ); ?></span>
						<span class="mng-event__day"><?php echo esc_html( $d ? $d->format( 'j' ) : '' ); ?></span>
					</time>
					<div class="mng-event__body">
						<h3 class="mng-event__name"><?php echo esc_html( $e['name'] ); ?></h3>
						<p class="mng-event__when"><?php echo esc_html( mng_event_dates( $e ) ); ?><?php echo ! empty( $e['location'] ) ? ' · ' . esc_html( $e['location'] ) : ''; ?></p>
					</div>
					<?php if ( ! empty( $e['href'] ) ) : ?>
						<a class="mng-link mng-event__link" href="<?php echo esc_url( $e['href'] ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Event info', 'pegasus' ); ?> <span aria-hidden="true">→</span><span class="screen-reader-text"> <?php echo esc_html( $e['name'] ); ?> <?php esc_html_e( '(opens in a new tab)', 'pegasus' ); ?></span></a>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<p class="mng-events__empty"><?php esc_html_e( 'New dates are coming soon. Follow us on Instagram or Facebook to catch the next one.', 'pegasus' ); ?></p>
	<?php endif; ?>

	<?php if ( $show_past && $events['past'] ) : ?>
		<details class="mng-events__past">
			<summary><?php esc_html_e( 'Where we\'ve been this season', 'pegasus' ); ?></summary>
			<ul>
				<?php foreach ( $events['past'] as $e ) : ?>
					<li><span><?php echo esc_html( mng_event_dates( $e ) ); ?></span> <?php echo esc_html( $e['name'] ); ?></li>
				<?php endforeach; ?>
			</ul>
		</details>
	<?php endif; ?>
</div>

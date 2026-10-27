<?php
/**
 * Day list with the menu theme of each day. Times come from site.json once filled in.
 */
$today = current_datetime()->format( 'l' );
?>
<ul class="mng-hours">
	<?php foreach ( (array) mng_site( 'hours', array() ) as $row ) :
		$is_today = in_array( $today, (array) ( $row['schema_days'] ?? array() ), true );
		$label    = $row['label'];
		if ( ! empty( $row['open'] ) && ! empty( $row['close'] ) ) {
			$label = date_i18n( 'g:i A', strtotime( $row['open'] ) ) . ' – ' . date_i18n( 'g:i A', strtotime( $row['close'] ) );
		}
		?>
		<li class="mng-hours__row<?php echo $is_today ? ' is-today' : ''; ?>">
			<span class="mng-hours__day"><?php echo esc_html( $row['days'] ); ?><?php if ( ! empty( $row['theme'] ) ) : ?><small><?php echo esc_html( $row['theme'] ); ?></small><?php endif; ?></span>
			<span class="mng-hours__time<?php echo empty( $row['schema_days'] ) ? ' is-closed' : ''; ?>"><?php echo esc_html( $label ); ?></span>
		</li>
	<?php endforeach; ?>
</ul>

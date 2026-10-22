<?php
/**
 * Hours table (data/site.json → hours). Used on Home, Location and [rusans_hours].
 */
$hours = rusans_site( 'hours', array() );
$open  = rusans_open_now();
?>
<div class="rusans-hours">
	<?php if ( null !== $open ) : ?>
		<p class="rusans-hours__status <?php echo $open ? 'is-open' : 'is-closed'; ?>">
			<span class="rusans-hours__dot" aria-hidden="true"></span>
			<?php echo $open ? esc_html__( 'Open now', 'pegasus' ) : esc_html__( 'Closed now', 'pegasus' ); ?>
		</p>
	<?php endif; ?>
	<dl class="rusans-hours__list">
		<?php foreach ( $hours as $row ) : ?>
			<div class="rusans-hours__row">
				<dt><?php echo esc_html( $row['days'] ); ?></dt>
				<dd><?php echo esc_html( $row['label'] ); ?></dd>
			</div>
		<?php endforeach; ?>
	</dl>
	<?php if ( rusans_site( 'hours_note' ) ) : ?>
		<p class="rusans-hours__note"><?php echo esc_html( rusans_site( 'hours_note' ) ); ?></p>
	<?php endif; ?>
</div>

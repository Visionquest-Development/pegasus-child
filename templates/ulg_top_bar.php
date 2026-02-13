<div class=" ulg-brand-bar py-2">
	<div class="container d-flex align-items-center justify-content-between">
		<a class="ulg-brand-logo d-none d-lg-flex align-items-center" href="https://uptownlifegroup.com" target="_blank">
			<img
				src="http://uptownlifegroup.com/wp-content/uploads/2025/12/57777logo.png"
				alt="Uptown Life Group"
				class="img-fluid ulg-brand-logo-img"
			/>
		</a>
		<?php /*
		<a class="navbar-brand m-0 d-flex align-items-center gap-2" href="<?= esc_url(home_url('/')); ?>">
			<?php the_custom_logo(); ?>
			<span class="text-cream small text-white">Restaurants • Bars • Music Venues — Uptown Columbus</span>
		</a>
		*/ ?>

		<?php
			$current_host = wp_parse_url( home_url(), PHP_URL_HOST );
			$subs = [
				'Uptown Life Group' => '//uptownlifegroup.com',
				'The Loft'   => '//theloft.com',
				'Mabellas'   => '//mabellas.com',
				'Mabellas Midtown'   => '//mabellas.com',
				'Salt Cellar'=> '//saltcellar.com',
				'Mix Market' => '//themixmarket.com',
				'Tommy G\'s' => '//tommygs.com',
			];
		?>
		<nav class="brandbar-nav d-none d-lg-flex align-items-center  ms-auto">
			<?php
				$index = 0;
				$total = count( $subs );
				foreach ( $subs as $label => $url ) {
					$link_host = wp_parse_url( $url, PHP_URL_HOST );
					if ( $link_host && $current_host && $link_host === $current_host ) {
						continue;
					}
					$is_active = $link_host && $current_host && $link_host === $current_host;
					$active_class = $is_active ? ' is-active' : '';
					echo '<a class="text-white' . esc_attr( $active_class ) . '" href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
					$index++;
					//if ( $index < $total ) {
					//	echo '<span class="text-white px-1">|</span>';
					//}
				}
			?>
		</nav>
		<div class="dropdown d-block d-lg-none mx-auto">
			<button class="btn btn-link ulg-gradient-heading text-decoration-none dropdown-toggle " type="button" id="ulgDropdown" data-bs-toggle="dropdown" aria-expanded="false">
				<img
					src="http://uptownlifegroup.com/wp-content/uploads/2025/12/57777logo.png"
					alt="Uptown Life Group"
					class="ulg-dropdown-logo"
				/>
				<span class="visually-hidden">Uptown Life Group</span>
			</button>

			<ul class="dropdown-menu dropdown-menu-end text-white" aria-labelledby="ulgDropdown">
				<?php
					foreach ( $subs as $label => $url ) {
						$link_host = wp_parse_url( $url, PHP_URL_HOST );
						if ( $link_host && $current_host && $link_host === $current_host ) {
							continue;
						}
						// Note the change to <li> and class="dropdown-item"
						echo '<li><a class="dropdown-item" href="' . esc_url( $url ) . '" target="_blank">' . esc_html( $label ) . '</a></li>';
					}
				?>
			</ul>
		</div>
	</div>
</div>

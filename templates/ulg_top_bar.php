<div class=" ulg-brand-bar py-2">
	<div class="container d-flex align-items-center justify-content-between">
		<?php /*
		<a class="navbar-brand m-0 d-flex align-items-center gap-2" href="<?= esc_url(home_url('/')); ?>">
			<?php the_custom_logo(); ?>
			<span class="text-cream small text-white">Restaurants • Bars • Music Venues — Uptown Columbus</span>
		</a>
		*/ ?>

		<nav class="brandbar-nav d-none d-md-flex gap-2">
			<?php
				$subs = [
					'The Loft'   => 'https://theloft.com',
					'Mabellas'   => 'https://mabellas.com',
					'Salt Cellar'=> 'https://saltcellar.com',
					'Mix Market' => 'https://themixmarket.com',
					'Tommy G\'s' => 'https://tommygs.com',
				];
				foreach ( $subs as $label => $url ) {
					echo '<a class="text-white  " href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
				}
			?>
		</nav>
		<div class="dropdown ">
			<button class="btn btn-link ulg-gradient-heading text-decoration-none dropdown-toggle " type="button" id="ulgDropdown" data-bs-toggle="dropdown" aria-expanded="false">
				Uptown Life Group
			</button>

			<ul class="dropdown-menu dropdown-menu-end text-white" aria-labelledby="ulgDropdown">
				<?php
					$subs = [
						'The Loft'    => 'https://theloft.com',
						'Mabellas'    => 'https://mabellas.com',
						'Salt Cellar' => 'https://saltcellar.com',
						'Mix Market'  => 'https://themixmarket.com',
						'Tommy G\'s'  => 'https://tommygs.com',
					];
					foreach ( $subs as $label => $url ) {
						// Note the change to <li> and class="dropdown-item"
						echo '<li><a class="dropdown-item" href="' . esc_url( $url ) . '" target="_blank">' . esc_html( $label ) . '</a></li>';
					}
				?>
			</ul>
		</div>
	</div>
</div>
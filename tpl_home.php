 <?php
/*
	Template Name: Home Template
*/
?>
<?php get_header(); ?>
	<div id="page-wrap">

		<div class="container">

			<div id="grid">

				<!--<a href="/learn" class="tile width2 height2 wordpress-academy"></a>
				<a href="/web-app-development" class="tile width2 app-dev"><img src="//visionquestdevelopment.com/wp-content/uploads/2014/07/app-dev-140x70.png"></a>-->

				<a href="/portfolio" class="tile width2 see-my-work"><i class="fa fa-briefcase"></i> Portfolio</a>
				<a href="/resume" class="tile width2 resume"><i class="fa fa-paperclip"></i> Résumé</a>
				<div class="tile width2 quote "><div class="inner-box"><blockquote>If I have seen further than others, it is by standing upon the shoulders of giants.</blockquote> - Isaac Newton </div></div>
				<a href="/contact" class="tile width2 contact"></a>
				<a href="/design" class="tile design"><div class="inner-box"><h2>Design</h2></div></a>
				<a href="/website-pricing" class="tile develop"><div class="inner-box"><p>Development</p></div></a>

				<?php /* <div class="tile width2 height2 recent">
					<h2>Recent Posts Box</h2>
					<ul id="octane-blog-list" >
						<?php
						$query2 = new WP_Query( array( 'post_type' => array( 'post' ), 'posts_per_page' => 4 ) );
						while ( $query2->have_posts() ) : $query2->the_post();

						?>
							<li class="blog-item-container">
								<article class="article-<?php the_ID(); ?> block-inner">

									<!-- the permalink and title -->
									<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
										<p class=""><?php the_title(); ?></p>
									</a>



								</article>
							</li>
						<?php endwhile;
						wp_reset_query();
						?>
					</ul>
				</div> */ ?>
				<a href="https://www.toptal.com/resume/james-obrien" target="_blank" class="tile width2 height2 new-box toptal">
					<h1>Top 3%</h1>
					<img src="//visionquestdevelopment.com/wp-content/themes/pegasus-child/images/toptal.png">
					<p>Hire me, I'm part of the top 3% of developers in the world that freelance on Toptal.com</p>
				</a>
				<!--<div class="tile width2 height2 website-list">Website List</div>-->
				<!--<div class="tile width2 height2 map">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item"  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52955.48486617263!2d-84.57739135576008!3d33.94838549225862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f510968647065d%3A0xb18756c6328ee981!2sMarietta%2C+GA!5e0!3m2!1sen!2sus!4v1445313732908" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>-->
				<div class="tile width2 auburn"></div>

				<div class="tile wwd width2 height2 ">
					<h2>What we do:</h2>
					<ul>
						<li>Code: 
							<a target="_blank" href="https://visionquestdevelopment.com/html/">HTML</a>, 
							<a target="_blank" href="https://visionquestdevelopment.com/css/">CSS</a>, 
							<a target="_blank" href="https://visionquestdevelopment.com/php/">PHP</a>, 
							Javascript, 
							<a target="_blank" href="https://visionquestdevelopment.com/sql/">SQL</a>, etc. 
						</li>
						<li>Websites: WordPress, Magento, HTML, Bootstrap templates </li>
						<li>Web Apps &amp; Mobile Apps: Cordova, Phonegap, Laravel</li>
						<!--<li>Hosting: WHM/CPANEL, AWS, etc.</li>-->
						<!--<li><a href="/seo">SEO</a></li>-->
						<!--<li><a href="/custom-pc">Custom PC Builds</a></li>-->
						<li>Virtual Reality equipment</li>
						<li>Security Camera Installations</li>
					</ul>

				</div>

				<div class="tile special width2 height2 ">
					<h2>Specializations:</h2>
					<ul>
						<li>Responsive Web Design</li>
						<li>PSD to HTML/WP conversion</li>
						<li>WordPress Theme Development</li>
						<li>WordPress Plugin Development</li>
						<li>E-commerce stores</li>
						<li>Application Development</li>
						<li>Hardware repair and installation</li>
						<li>Virtual Reality</li>
					</ul>
				</div>
				
				<div class="tile adjust width2 height2 ">
					<h2>Adjust the width of your screen. This site is made with Responsive design.</h2>
					<img src="https://visionquestdevelopment.com/images/lalmalani_fig01.gif">
				</div>

				<a href="/javascript-libraries" class="tile width2 java">Javascript Libraries <br>and Frameworks</a>
				
				<a href="/sql" class="tile sql ">SQL</a>
				<a href="/php" class="tile php "><div class="inner-box"><h2>&lt;?PHP?&gt;</h2></div></a>
				<a href="/html" class="tile html "><div class="inner-box"><h2>&lt;HTML&gt;</h2></div></a>
				<a href="/css" class="tile css "><div class="inner-box"><h2>{ CSS }</h2></div></a>
				
				<a href="/custom-pc" class="tile new-box custom-pc width2"><h2>Custom PC Builds</h2></a>
				<a href="/seo" class="tile new-box seo width2"><h2>SEO</h2>Search Engine Optimization</a>
				
				<div class="tile width2 quote quote2 "><div class="inner-box"><blockquote>That is the way to learn the most...When you are doing something with such enjoyment that you don't notice that the time passes.</blockquote> - Albert Einstein </div></div>
				<!--<a href="#" class="tile new-box "><div class="inner-box"><h2>Newbox2</h2></div></a>
				<a href="#" class="tile new-box "><div class="inner-box"><h2>Newbox3</h2></div></a>-->



				<?php /*<a href="/blog" class="tile width2 blog-box"><div class="inner-box"><h2>Blog</h2></div></a>

				<?php
					global $post;
					$myposts = get_posts('numberposts=1');
					foreach($myposts as $post) :
				?>
				<a href="<?php the_permalink(); ?>" class="tile width2 latest-box">

					<div class="inner-box">
						<h2>Latest Post</h2>
						<?php the_title(); ?>
						<?php //the_content(); ?>
					</div>

				</a>
				<?php endforeach;
				?>


				*/ ?>

			</div>

		</div>


		<div class="container">
		  <!-- Example row of columns -->
			<div class="row">
				<div class="col-md-12">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<?php //the_content(); ?>

					<?php endwhile; else: ?>
						<?php /* kinda a 404 of sorts when not working */ ?>
						<div class="page-header">
							<h1>Oh no!</h1>
						</div>
						<p>No content is appearing for this page!</p>
					<?php endif; ?>
				</div>
				<?php //get_sidebar(); ?>

			</div>
		</div>

	</div>
		<script>
			/* document.querySelector("#myCard").classList.toggle("flip")

			.flip-container:hover .flipper, .flip-container.hover .flipper, .flip-container.flip .flipper {
				transform: rotateY(180deg);
			} */

			   /*====================================
				HOME PAGE METRO GRID
				======================================*/
				jQuery(function($) {
					//variables para el isotope
					var $window = $(window),
						$container = $("#grid"),
						$item = $(".tile"),
						$margin = 10,
						$baseWidth = 158,
						$baseHeight = 158,
						$largemobile= 481,
						$tablet= 760;

					//lanzamos el packery cuando cargue las imágenes
				  reLayout();
				  //vamos recargando el packery cada vez que cambiamos la medida de la pantalla
				  $window.resize( reLayout );

					function reLayout() {
					//calculamos cuantos thumbs caben en la nueva medida
					var containerWidth = $container.width(),
							numberProject = containerWidth/$baseWidth,
							  integerProject = parseInt(numberProject),
							  decimalProject = (numberProject - parseInt(numberProject)).toFixed(1)*10;
					if ($(window).width() < $largemobile) {
						  var newWidth = parseInt((containerWidth/2)-$margin);
						}else if($(window).width() > $largemobile && $(window).width() < $tablet) {
							var newWidth = parseInt((containerWidth/3)-$margin);
						}else{
							var newWidth = parseInt((containerWidth/(integerProject+1))-$margin);
						}

						//sacamos la nueva altura por proporción
						var newHeight = parseInt((newWidth*$baseHeight)/$baseWidth);

						//a cada thumb le damos su nueva altura y anchura y ejecutamos el packery cuando estén todos los cambios aplicados
						$item.each(function() {
							if($(this).hasClass('width2')){
							  $(this).css({ width: (newWidth*2) + $margin, height: newHeight});
							}else if ($(this).hasClass('height2')){
								$(this).css({ width: newWidth, height: (newHeight*2) + $margin});
							}else{
								$(this).css({ width: newWidth, height: newHeight});
							}
						}).promise().done( function(){
					  $container.packery({
						itemSelector: '.tile',
						gutter: $margin
					  });
					  });
				  }
				});


		</script>

      <?php get_footer(); ?>

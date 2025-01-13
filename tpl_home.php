<?php
/*
	Template Name: Home Template
*/
?>
	<?php get_header(); ?>

	<div id="page-wrap">
		<?php
			//full container page options
			$post_full_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );
			//full container theme option
			$global_full_container_option = pegasus_get_option('full_container_chk' );

			//assign post class
			$pegasus_post_container_choice = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';
			//assign global class
			$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container' ;
			//check global first then post
			$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : $pegasus_post_container_choice;

			//left align right sidebar?
			$left_align_sidebar_chk =  pegasus_get_option( 'sidebar_left_chk' ) ? pegasus_get_option( 'sidebar_left_chk' ) : 'off';
			//enable both sidebars?
			$pegasus_left_sidebar_option = ( 'on' === pegasus_get_option( 'both_sidebar_chk' ) ) ? pegasus_get_option( 'both_sidebar_chk' ) : 'off';
			//change content class if both sidebars
			$page_body_content_class = ( 'on' === $pegasus_left_sidebar_option  ) ? 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xg-6' : 'col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xg-9';

			//page header page options
			$post_disable_page_header_choice = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';
			//page header theme option
			$global_disable_page_header_option =  pegasus_get_option('page_header_chk' ) ? pegasus_get_option('page_header_chk' ) : 'off';
			//check theme option for page header before page option
			$page_title = $post->post_title;
			$is_this_home = is_home();
			if ( 'on' === $global_disable_page_header_option ) {
				$final_page_header_option = 'on';
			} elseif ( 'on' === $post_disable_page_header_choice ) {
				$final_page_header_option = 'on';
			} else {
				$final_page_header_option = 'off';
			}

			if ( true === $is_this_home ) {
				$final_page_header_option = 'off';
			}
		?>

		<div class="<?php echo $final_container_class; ?>">
		<!-- Example row of columns -->
			<div class="">

				<div class="inner-content">
					<div class="content-no-sidebar">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php if( 'off' === $final_page_header_option ) { ?>
								<div class="page-header">
									<?php
									if( '' === $page_title ) {
										echo '';
									} elseif ( $page_title ) {
										echo '<h1>';
										echo the_title();
										echo '</h1>';
									}
									?>
								</div>
							<?php }else{ ?>
								<div class="page-header-spacer"></div>
							<?php } ?>

							<?php //the_content(); ?>

						<?php endwhile; else: ?>
							<?php /* kinda a 404 of sorts when not working */ ?>
							<div class="page-header">
								<h1>Oh no!</h1>
							</div>
							<p>No content is appearing for this page!</p>
						<?php endif; ?>
					</div>
				</div><!--end inner content-->

			</div><!--end row -->
		</div><!-- end container -->

		<section id="home-top-section" class="py-5" style="background: #231e61; color: white; ">
            <div class="container-fluid">
                <h3>WordPress Bootstrap Theme</h3>
                <p><strong>Free for the Community</strong></p>
                <p>When creating custom themes for clients at various jobs,
					I ended up doing the same thing repeatedly. Therefore,
					I decided to build a theme that I could always use as a
					base for my clients' websites and then build upon.
					This is a custom Bootstrap Theme for WordPress made with
					CMB2 and various JS libraries.
					<strong>It comes with a suite of plugins that are separately
						installed to add functionality to a site.</strong>
				</p>
            </div>
			<div class="container-fluid my-5">
				<h3>Pegasus Theme for WordPress</h3>
				<p>WordPress theme for free based on Twitter Bootstrap 5
					for front-end markup, CMB2 for theme settings and custom fields,
					and Woocommerce for online shopping. I developed it to help my
					build process for custom bootstrap themes, and I want to put it
					out there for free for the open-source community and the WordPress
					community. Made with love from
					<a target="_blank" href="http://visionquestdevelopment.com">
						http://visionquestdevelopment.com
					</a>.
				</p>
			</div>
			<div class="container  text-center">
					<a href="https://github.com/Visionquest-Development/pegasus" class="btn btn-primary mb-3">Pegasus Github</a>
			</div>

        </section>

		<section id="child-theme-row" class="" >
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 mt-5 mb-3 text-center">
						<h3>Pegasus Child</h3>
						<p>For customizations, the Pegasus Child Theme is the best way to get started.</p>

						<a href="https://github.com/Visionquest-Development/pegasus-child" class="btn btn-primary mt-3 mb-5">
							Pegasus Child Theme Github
						</a>
					</div>
					<div class="col-md-6 mt-5 mb-3 text-center">
						<h3>Timeline Child</h3>
						<p>Custom Timeline Child theme can be used for displaying a timeline</p>

						<a href="https://github.com/Visionquest-Development/timeline-child" class="btn btn-primary mt-3 mb-5">
							Timeline Child Theme Github
						</a>
					</div>
				</div>
			</div>

		</section>


		<section id="pegasus-blog" class="py-5" >
			<div class="container-fluid">
				<h3>Blog</h3>
				<div class="text-center">
					<img src="/wp-content/themes/pegasus-child/screenshots/blog_screenshot.png" alt="placeholder image" class="img-fluid w-25">
				</div>
				<pre><code class="language-javascript">[blog the_query="post_type=post&order_by=title&order=ASC" ][/blog]</code></pre>
				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-blog"
					class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Blog Github
					</a>
					<a href="/pegasus-blog"
					class="btn btn-secondary  mt-5 mb-2" >
						Blog Example Page
					</a>
				</div>
			</div>
		</section>

		<!--<section id="pegasus-blurb" class="py-5" >
			<div class="container-fluid">
				<h3>Blurb</h3>
				<pre><code class="language-javascript">[blurb title="the_title" subtitle="the_subtitle" ]The content for the blurb[/blurb]</code></pre>

			</div>
		</section>-->

		<section id="pegasus-callout" class="py-5" >
			<div class="container-fluid">
				<h3>Callout</h3>
				<div class="text-center">
					<img src="/wp-content/themes/pegasus-child/screenshots/callout1_screenshot.png" alt="placeholder image" class="img-fluid">
				</div>
				<pre><code class="language-javascript">[callout button="yes" link="http://example.com" external="yes" color="white" link_text="Learn More" background="http://www.wpfreeware.com/themes/html/appstation/img/download_bg.png"]
Get your copy now!Suspendisse vitae bibendum mauris. Nunc iaculis nisl vitae laoreet elementum donec dignissim metus sit.
[/callout]</code></pre>

				<div class="text-center">
					<img src="/wp-content/themes/pegasus-child/screenshots/callout2_screenshot.png" alt="placeholder image" class="img-fluid">
				</div>
				<pre><code class="language-javascript">[callout button="yes" link="http://example.com" color="black" external="yes" backgroundcolor="#dedede"]
Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Donec sollicitudin molestie malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Donec sollicitudin molestie malesuada.
Nulla porttitor accumsan tincidunt. Nulla porttitor accumsan tincidunt. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.
[/callout]</code></pre>

				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-callout" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Callout Github
					</a>
					<a href="/pegasus-callout" class="btn btn-secondary  mt-5 mb-2" >
						Callout Example Page
					</a>
				</div>
			</div>
		</section>

		<section id="pegasus-carousel" class="py-5" >
			<div class="container-fluid">
				<h3>Carousel</h3>

				<h5>Logo Slider</h5>
				<div class="text-center">
					<img src="/wp-content/themes/pegasus-child/screenshots/carousel1_screenshot.png" alt="placeholder image" class="img-fluid">
				</div>

				<pre><code class="language-javascript">
[logo_slider the_query="showposts=100&post_type=logo_slider"]
				</code></pre>

				<h5>Testimonial Slider</h5>
				<!--<div class="text-center">
					<img src="/wp-content/themes/pegasus-child/screenshots/carousel1_screenshot.png" alt="placeholder image" class="img-fluid">
				</div>-->
				<pre><code class="language-javascript">
[testimonial_slider image="circle" type="bubble" class="test" the_query="post_type=testimonial&showposts=100" ]
				</code></pre>
				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-carousel" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Carousel Github
					</a>
					<a href="/pegasus-carousel" class="btn btn-secondary  mt-5 mb-2" >
						Carousel Example Page
					</a>
				</div>
			</div>
		</section>

		<section id="pegasus-circle-progress" class="py-5" >
			<div class="container-fluid">
				<h3>Circle Progress</h3>
				<div class="text-center">
					<img src="/wp-content/themes/pegasus-child/screenshots/circle_progress.gif" alt="placeholder image" class="img-fluid w-25">
				</div>
				<pre><code class="language-javascript">[circle_progress number="90"]</code></pre>
				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-circle-progress" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Circle Progress Github
					</a>
					<a href="/pegasus-circle-progress" class="btn btn-secondary  mt-5 mb-2" >
						Circle Progress Example Page
					</a>
				</div>
			</div>
		</section>

		<section id="pegasus-count-up" class="py-5" >
			<div class="container-fluid">
				<h3>Count Up</h3>
				<div class="text-center">
					<img src="/wp-content/themes/pegasus-child/screenshots/countup.gif" alt="placeholder image" class="img-fluid w-25">
				</div>
				<pre><code class="language-javascript">[counter_up number="2025"]</code></pre>
				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-countup" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Count Up Github
					</a>
					<a href="/pegasus-countup" class="btn btn-secondary  mt-5 mb-2" >
						Count Up Example Page
					</a>
				</div>
			</div>
		</section>

		<!--<section id="pegasus-forkit" class="py-5" >
			<div class="container-fluid">
				<h3>Forkit</h3>
				<pre><code class="language-javascript">[forkit]</code></pre>
			</div>
		</section>

		<section id="pegasus-lightbox" class="py-5" >
			<div class="container-fluid">
				<h3>Lightbox</h3>
				<pre><code class="language-javascript">[lightbox]</code></pre>
			</div>
		</section>

		<section id="pegasus-isotope" class="py-5" >
			<div class="container-fluid">
				<h3>Isotope</h3>
				<pre><code class="language-javascript">[isotope]</code></pre>
			</div>
		</section>-->

		<section id="pegasus-masonry" class="py-5" >
			<div class="container-fluid">
				<h3>Masonry</h3>
				<pre><code class="language-javascript">[masonry]
&lt;img src="https://via.placeholder.com/250/250/"&gt;
&lt;img src="https://via.placeholder.com/250/250/"&gt;
&lt;img src="https://via.placeholder.com/250/500/"&gt;
&lt;img src="https://via.placeholder.com/250/250/"&gt;
&lt;img src="https://via.placeholder.com/250/500/"&gt;
&lt;img src="https://via.placeholder.com/250/250/"&gt;
&lt;img src="https://via.placeholder.com/250/250/"&gt;
&lt;img src="https://via.placeholder.com/250/500/"&gt;
&lt;img src="https://via.placeholder.com/250/250/"&gt;
&lt;img src="https://via.placeholder.com/250/250/"&gt;
&lt;img src="https://via.placeholder.com/250/500/"&gt;
[/masonry]</code></pre>
				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-masonry" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Masonry Github
					</a>
					<a href="/pegasus-masonry" class="btn btn-secondary  mt-5 mb-2" >
						Masonry Example Page
					</a>
				</div>
			</div>
		</section>
		<!--
		<section id="pegasus-nav-menu" class="py-5" >
			<div class="container-fluid">
				<h3>Nav Menu</h3>
				<pre><code class="language-javascript">[menu menu="primary"]</code></pre>
				<pre><code class="language-javascript">[bootstrap_menu menu="primary" additional_classes="navbar-expand"]</code></pre>
				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-navmenu" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Nav Menu Github
					</a>
					<a href="/pegasus-navmenu" class="btn btn-secondary  mt-5 mb-2" >
						Nav Menu Example Page
					</a>
				</div>
			</div>
		</section>
						-->
		<section id="pegasus-one-page" class="py-5" >
			<div class="container-fluid">
				<h3>One Page</h3>
				<pre><code class="language-javascript">[section][/section]</code></pre>
				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-onepage" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus One Page Github
					</a>
					<a href="/pegasus-onepage" class="btn btn-secondary  mt-5 mb-2" >
						One Page Example Page
					</a>
				</div>
			</div>
		</section>

		<section id="pegasus-packery" class="py-5" >
			<div class="container-fluid">
				<h3>Packery</h3>
				<pre><code class="language-javascript">[packery]
&lt;img src="https://via.placeholder.com/250/250/"&gt;
&lt;img src="https://via.placeholder.com/250/250/"&gt;
&lt;img src="https://via.placeholder.com/250/500/"&gt;
&lt;img src="https://via.placeholder.com/250/250/"&gt;
&lt;img src="https://via.placeholder.com/250/500/"&gt;
&lt;img src="https://via.placeholder.com/250/250/"&gt;
&lt;img src="https://via.placeholder.com/250/250/"&gt;
&lt;img src="https://via.placeholder.com/250/500/"&gt;
&lt;img src="https://via.placeholder.com/250/250/"&gt;
&lt;img src="https://via.placeholder.com/250/250/"&gt;
&lt;img src="https://via.placeholder.com/250/500/"&gt;
[/packery]</code></pre>
				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-packery" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Packery Github
					</a>
					<a href="/pegasus-packery" class="btn btn-secondary  mt-5 mb-2" >
						Packery Example Page
					</a>
				</div>
			</div>
		</section>

		<section id="pegasus-popup" class="py-5" >
			<div class="container-fluid">
				<h3>Popup</h3>
				<pre><code class="language-javascript">[popup] &lt;img src="//farm9.staticflickr.com/8241/8589392310_7b6127e243_b.jpg"&gt; [/popup]</code></pre>
				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-popup" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Popup Github
					</a>
					<a href="/pegasus-popup" class="btn btn-secondary  mt-5 mb-2" >
						Popup Example Page
					</a>
				</div>
			</div>
		</section>

		<section id="pegasus-posts-grid" class="py-5" >
			<div class="container-fluid">
				<h3>Posts Grid</h3>

				<h5>Loop Shortcode</h5>
				<pre><code class="language-javascript">[loop the_query="post_type=post&showposts=10"]</code></pre>
				<pre><code class="language-javascript">[loop the_query="post_type=post&showposts=100&category_name=hot-news&ord=ASC&ord_by=title"]</code></pre>

				<h5>Loop Posts Shortcode</h5>
				<pre><code class="language-javascript">[loop-posts the_query="post_type=post&showposts=10"]</code></pre></p>
				<pre><code class="language-javascript">[loop-posts the_query="post_type=post&showposts=100&category_name=hot-news&ord=ASC&ord_by=title"]</code></pre>

				<h5>Loop Grid Shortcode</h5>
				<div class="text-center">
					<img src="http://pegasustheme.com/wp-content/uploads/2016/07/2016-07-22_20-29-37.png" alt="placeholder image" class="img-fluid">
				</div>
				<pre><code class="language-javascript">[loop-grid the_query="post_type=post&showposts=10"]</code></pre></p>
				<pre><code class="language-javascript">[loop-grid the_query="showposts=99&post_type=post" bkg_color="#dedede"]</code></pre>

				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-postgrid" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Posts Grid Github
					</a>
					<a href="/pegasus-postgrid" class="btn btn-secondary  mt-5 mb-2" >
						Posts Grid Example Page
					</a>
				</div>
			</div>
		</section>
		<!--
		<section id="pegasus-posts-filter" class="py-5" >
			<div class="container-fluid">
				<h3>Posts Filter</h3>
				<pre><code class="language-javascript">[ajax_filter_posts per_page="1"］</code></pre>
				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-posts-filter" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Posts Filter Github
					</a>
					<a href="/pegasus-posts-filter" class="btn btn-secondary  mt-5 mb-2" >
						Posts Filter Example Page
					</a>
				</div>
			</div>
		</section>
						-->

		<section id="pegasus-slider" class="py-5" >
			<div class="container-fluid">
				<h3>Regular Slider</h3>
				<p>This includes the Regular Slider, Thumbnail Slider, and News/Posts Slider.</p>

				<h5>Slider</h5>
				<div class="text-center">
					<img src="http://pegasustheme.com/wp-content/uploads/2016/07/2016-07-22_20-19-04.png" alt="placeholder image" class="img-fluid">
				</div>
				<pre><code class="language-javascript">[slider]
	[slide class="testing"]
		&lt;img class="alignnone size-full wp-image-12" src="https://via.placeholder.com/960x550/" alt="Gold-and-Black-Logo"&gt;
	[/slide]
	[slide]
		&lt;img class="alignnone size-full wp-image-12" src="https://via.placeholder.com/600x350/" alt="Gold-and-Black-Logo"&gt;
	[/slide]
[/slider]</code></pre>

				<h5>News/Posts Slider</h5>
				<div class="text-center">
					<img src="http://pegasustheme.com/wp-content/uploads/2016/07/2016-07-22_20-18-46.png" alt="placeholder image" class="img-fluid">
				</div>
				<pre><code class="language-javascript">[news_slider the_query="showposts=100&amp;post_type=post"]</code></pre>
				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-slider" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Slider Github
					</a>
					<a href="/pegasus-slider" class="btn btn-secondary  mt-5 mb-2" >
						Slider Example Page
					</a>
				</div>

				<h5>Thumbnail Slider</h5>
				<div class="text-center">
					<img src="http://pegasustheme.com/wp-content/uploads/2016/07/2016-07-22_20-14-49.png" alt="placeholder image" class="img-fluid">
				</div>
				<pre><code class="language-javascript">[thumb_slider]
	[thumb_slide title="slide1" number="1"]
		&lt;img  src="http://slippry.com/assets/img/image-1.jpg" alt="This is caption 1 "&gt;
	[/thumb_slide]
	[thumb_slide title="slide2" number="2"]
		&lt;img  src="http://slippry.com/assets/img/image-2.jpg" alt="This is caption 2"&gt;
	[/thumb_slide]
	[thumb_slide number="3"]
		&lt;img  src="http://slippry.com/assets/img/image-3.jpg" alt="This is caption 3"&gt;
	[/thumb_slide]
	[thumb_slide title="slide4" number="4"]
		&lt;img  src="http://slippry.com/assets/img/image-4.jpg" alt="This is caption 4"&gt;
	[/thumb_slide]
[/thumb_slider]</code></pre>

			</div>
		</section>

		<section id="pegasus-tabs" class="py-5" >
			<div class="container-fluid">
				<h3>Tab</h3>
				<pre><code class="language-javascript">[tabs]
	[tab class="first" title="Home"]
		Vivamus suscipit tortor eget felis porttitor volutpat. Pellentesque in ipsum id orci porta dapibus.
		Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Pellentesque in ipsum id orci porta dapibus.
		Quisque velit nisi, pretium ut lacinia in, elementum id enim. Sed porttitor lectus nibh. Vivamus suscipit tortor eget
		felis porttitor volutpat. Nulla porttitor accumsan tincidunt. Vivamus magna justo
	[/tab]
	[tab class="second" title="Profile"]
		&lt;img loading="lazy" decoding="async" class="alignnone size-full wp-image-6" src="http://visionquestdev.com/learn-wordpress/wp-content/uploads/2016/06/quadroIdeas_1153.jpg" alt="quadroIdeas_1153" width="960" height="386" /&gt;
	[/tab]
[/tabs]</code></pre>
			<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-tabs" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Tabs Github
					</a>
					<a href="/pegasus-tabs" class="btn btn-secondary  mt-5 mb-2" >
						Tabs Example Page
					</a>
				</div>
			</div>
		</section>

		<section id="pegasus-toggleslide" class="py-5" >
			<div class="container-fluid">
				<h3>Toggle Slide</h3>
				<pre><code class="language-javascript">[toggleslide title="the_title"]Toggle slide content[/toggleslide]</code></pre>
				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-toggleslide" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Toggleslide Github
					</a>
					<a href="/pegasus-toggleslide" class="btn btn-secondary  mt-5 mb-2" >
						Toggleslide Example Page
					</a>
				</div>
			</div>
		</section>

		<!--<section id="pegasus-tooldrawer" class="py-5" >
			<div class="container-fluid">
				<h3>Tool Drawer</h3>
				<pre><code class="language-javascript">[tooldrawer]</code></pre>
			</div>
		</section>-->

		<section id="pegasus-wow" class="py-5" >
			<div class="container-fluid">
				<h3>Wow</h3>
				<pre><code class="language-javascript">[wow]</code></pre>
				<div class="text-center">
					<a href="https://github.com/Visionquest-Development/pegasus-wow" class="btn btn-primary  mt-5 mb-2" target="_blank">
						Pegasus Wow Github
					</a>
					<a href="/pegasus-wow" class="btn btn-secondary  mt-5 mb-2" >
						Wow Example Page
					</a>
				</div>
			</div>
		</section>



	</div><!-- end page wrap -->



	<nav id="dotnav" class="navbar nav">
		<ul class="dotnav dotnav-vertical dotnav-right ">
			<li class="nav-tooltip nav-item" title="Header" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#large-header"></a>
			</li>
			<li class="nav-tooltip nav-item" title="Home Top" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#home-top-section"></a>
			</li>
			<li class="nav-tooltip nav-item" title="Child Theme" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#child-theme-row"></a>
			</li>
			<li class="nav-tooltip nav-item" title="Blog" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-blog"></a>
			</li>
			<!--<li class="nav-tooltip nav-item" title="Blurb" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-blurb"></a>
			</li>-->
			<li class="nav-tooltip nav-item" title="Callout" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-callout"></a>
			</li>
			<li class="nav-tooltip nav-item" title="Carousel" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-carousel"></a>
			</li>
			<li class="nav-tooltip nav-item" title="Circle Progress" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-circle-progress"></a>
			</li>
			<li class="nav-tooltip nav-item" title="Count Up" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-count-up"></a>
			</li>
			<!--<li class="nav-tooltip nav-item" title="Forkit" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-forkit"></a>
			</li>
			<li class="nav-tooltip nav-item" title="Lightbox" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-lightbox"></a>
			</li>
			<li class="nav-tooltip nav-item" title="Isotope" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-isotope"></a>
			</li>-->
			<li class="nav-tooltip nav-item" title="Masonry" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-masonry"></a>
			</li>
			<!--<li class="nav-tooltip nav-item" title="Nav Menu" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-nav-menu"></a>
			</li>-->
			<li class="nav-tooltip nav-item" title="OnePage" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-one-page"></a>
			</li>
			<li class="nav-tooltip nav-item" title="Packery" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-packery"></a>
			</li>
			<li class="nav-tooltip nav-item" title="Popup" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-popup"></a>
			</li>
			<li class="nav-tooltip nav-item" title="Posts Grid" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-posts-grid"></a>
			</li>
			<!--<li class="nav-tooltip nav-item" title="Posts Filter" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-posts-filter"></a>-->
			</li>
			<li class="nav-tooltip nav-item" title="Slider" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-slider"></a>
			</li>
			<li class="nav-tooltip nav-item" title="Tabs" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-tabs"></a>
			</li>
			<li class="nav-tooltip nav-item" title="Toggleslide" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-toggleslide"></a>
			</li>
			<!--<li class="nav-tooltip nav-item" title="Tooldrawer" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-tooldrawer"></a>
			</li>-->
			<li class="nav-tooltip nav-item" title="Wow" data-bs-toggle="tooltip" data-placement="left">
				<a class="nav-link"  href="#pegasus-wow"></a>
			</li>

		</ul>
	</nav>
    <?php get_footer(); ?>

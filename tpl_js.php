<?php
/* 
	Template Name: JS Libs Template
*/
?>
	<?php get_header(); ?>
	
 
    <div class="container-fluid content-area">
		<!-- Example row of columns -->
		<div class="row">
			<div class="col-md-12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="page-header">
						<h1><?php the_title(); ?></h1>
					</div>
					
					<?php //the_content(); ?>
					
					<?php 
					
						// Function to read JSON and display a specific category
						function displayCategory($categoryName) {
							// Read the JSON data from the file
							$jsonFilePath = get_stylesheet_directory() . '/json/javascript_libraries.json';
							$jsonData = file_get_contents($jsonFilePath);

							if ($jsonData === false) {
								// Handle error if the file cannot be read
								error_log("Error: Unable to read the JSON file.");
								return; // Stop further execution
							}

							// Decode the JSON data
							$data = json_decode($jsonData, true);

							if (json_last_error() !== JSON_ERROR_NONE) {
								// Handle JSON decoding errors
								error_log("Error: JSON decoding failed with message: " . json_last_error_msg());
								return; // Stop further execution
							}

							// Iterate through the categories and libraries to output the HTML
							if (isset($data['categories']) && is_array($data['categories'])) {
								foreach ($data['categories'] as $category) {
									if ($category['name'] === $categoryName) { // Match the category by name
										echo "<h3>" . htmlspecialchars($category['name']) . "</h3>";
										echo "<ul>";

										foreach ($category['libraries'] as $library) {
											// Assign classes based on properties
											$classes = [];
											if (isset($library['used_by_vqdev']) && $library['used_by_vqdev']) {
												$classes[] = 'inverse';
											}

											$classAttribute = empty($classes) ? '' : ' class="' . implode(' ', $classes) . '"';
											echo "<li$classAttribute>";
											
											// Display the favorite icon if applicable
											if (isset($library['favorite']) && $library['favorite']) {
												echo '<i class="fa fa-star"></i> ';
											}
											
											// Display the favorite icon if applicable
											if (isset($library['type']) && $library['type']) {
												if ( 'Library' === $library['type'] ) {
													echo '<i class="fa fa-book"></i> ';
												}
												if ( 'Framework' === $library['type'] ) {
													echo '<i class="fa fa-cubes"></i> ';
												}
											}
											

											echo "<strong>" . htmlspecialchars($library['name']) . "</strong> — " . htmlspecialchars($library['description']);
											echo "</li>";
										}

										echo "</ul>";
										return; // Exit after displaying the matching category
									}
								}

								// If the category was not found, log an error
								error_log("Error: Category '$categoryName' not found.");
							} else {
								error_log("Error: Categories data is missing or invalid.");
							}
						} //end of displayCategory function()
					
					
						// Example usage: Call this function to display the "Lightbox Libraries" category
						//displayCategory("Lightbox Libraries");
					?>
					
					<p>It has been impossible to keep up with all of the javascript libraries that are sprouting up as of 2024. This list is an attempt to cover the most useful and widely known javascript libraries and frameworks that are being used in the web as of today.</p>

					<b>Updated as of: Oct 2024</b><br/>
					<br/>
					<div class="">
						<strong>Difference between a Javascript Library vs Framework:</strong>
						<ul>
							<li class=""><strong>Framework:</strong> this describes a given structure of "how" you should present your code. Pretty much like a code-template, along some helpers, constructors etc. to solve/simplify a specific problem or bring your architecture in "order". Examples, "Backbone", "requireJS", "socketIO".</li>
							<li class=""><strong>Library:</strong> Is an entire toolkit which highly abstracts different layers, like browsers / DOM models / etc. Also as a good toolkit, it offers a lot of tools and neat stuff to work with, which in general, simplify your coding experience. Examples "jQuery", "MooTools", "YUI"</li>
						</ul>
					</div>
					<div class="legend p-3">
						<h3>Legend:</h3>
						<span class="ms-close-btn">
						  <i class="fa fa-times"></i>
						</span>
						<ul class="flex-container">
							<li class="item">
								<div class="div1"><i class="fa fa-star"></i></div>
								<div class="div2"><span>=</span></div>
								<div class="div3"><span>Favorite</span></div>
							</li>
							<li class="item">
								<div class="div1"><i class="fa fa-book"></i></div>
								<div class="div2"><span>=</span></div>
								<div class="div3"><span>Library</span></div>
							</li>
							<li class="item">
								<div class="div1"><i class="fa fa-cubes"></i></div>
								<div class="div2"><span>=</span></div>
								<div class="div3"><span>Framework</span></div>
							</li>
							<li class="item last-item">
								<ul>
									<li class="inverse">Visionquest uses this product.</li>
								</ul>
							</li>
						</ul>
					</div>
					<p>Here is a short summary of the Javascript libraries that have good documentation and are popular among the community.</p>
					
					<div class="mb-5">
						<?php displayCategory("Popular"); ?>
					</div>
					
					<div class="row">
					
						<div class="col-md-6">

							<div class="mb-5">
								<?php displayCategory("DOM Manipulation"); ?>
							</div>

							<div class="mb-5">
								<?php displayCategory("Template Systems"); ?>
							</div>

							<div class="mb-5">
								<?php displayCategory("Loaders"); ?>
							</div>

							<div class="mb-5">
								<?php displayCategory("Bundlers"); ?>
							</div>

							<div class="mb-5">
								<?php displayCategory("Type Checkers"); ?>
							</div>

							<div class="mb-5">
								<?php displayCategory("Runner"); ?>
							</div>

							<div class="mb-5">
								<?php displayCategory("Pure JavaScript / Ajax / Functional programming"); ?>
							</div>

							<div class="mb-5">
								<?php displayCategory("Touch Libraries / Mobile UI Libraries"); ?>
							</div>

							<div class="mb-5">
								<?php displayCategory("Animation Libraries"); ?>
							</div>

							<div class="mb-5">
								<?php displayCategory("Parallax Libraries"); ?>
							</div>

							<div class="mb-5">
								<?php displayCategory("Graphical/Visualization (Canvas or SVG related)"); ?>
							</div>

							<div class="mb-5">
								<?php displayCategory("Chart Libraries / Data Visualization"); ?>
							</div>

							<div class="mb-5">
								<?php displayCategory("Slider Libraries"); ?>
							</div>

						</div><!-- end col 1 -->

						
						<div class="col-md-6">
							<div class="mb-5">
								<?php displayCategory("Lightbox Libraries"); ?>
							</div>
							
							<div class="mb-5">
								<?php displayCategory("Unit Testing / Testing Frameworks"); ?>
							</div>
							
							<div class="mb-5">
								<?php displayCategory("QA Tools"); ?>
							</div>
							
							<div class="mb-5">
								<?php displayCategory("Web-Application related MVC"); ?>
							</div>
							
							<div class="mb-5">
								<?php displayCategory("Other"); ?>
							</div>
						
						</div> <!-- end column -->
					
					</div> <!-- end row -->
					
					<h3>Technologies / Tools used</h3>
					<ul>
						<li class="inverse">
							<i class="fa fa-star"></i>
							node JS
						</li>
						<li class="inverse">
							<i class="fa fa-star"></i>
							npm
						</li>
						<li class="inverse">
							<i class="fa fa-star"></i>
							yarn
						</li>
					</ul>
					
					<hr>
					
					<i>
						Sources: 
						<a href="http://stackoverflow.com/questions/11576018/what-is-the-difference-between-a-javascript-framework-and-a-library">StackOverflow</a>, 
						<a href="https://en.wikipedia.org/wiki/List_of_JavaScript_libraries">Wikipedia</a>, 
						<a href="http://weightof.it/">Weight-of-it.com</a>
					</i>
					
					<hr>
					
					<h5>Leave a comment below if you have any to add or any descriptions to update!</h5>



				
				<?php endwhile; else: ?>
					
					<div class="page-header">
						<h1>Oh no!</h1>
					</div>
					<p>No content is appearing for this page!</p>
				<?php endif; ?>
				
				<?php comments_template(); ?> 
				
			</div>
		</div>
	</div>
    <?php get_footer(); ?>
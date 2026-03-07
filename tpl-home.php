<?php
/*
Template Name: Right Hand Renovations Home Template
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
    ?>

    <main>
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1>Transform Your Space with <span class="highlight">Expert Renovations</span></h1>
                        <p class="lead">Professional home renovation and remodeling services that bring your vision to life. Quality craftsmanship, reliable service, and results that exceed expectations.</p>
                        <div class="mt-4">
                            <a href="#contact" class="btn btn-primary btn-lg me-3 mb-2">Get Free Estimate</a>
                            <a href="#portfolio" class="btn btn-outline-primary btn-lg mb-2">View Our Work</a>
                        </div>
                        <div class="hero-badges">
                            <div class="hero-badge">
                                <i class="fas fa-award"></i>
                                <span>Licensed & Insured</span>
                            </div>
                            <div class="hero-badge">
                                <i class="fas fa-star"></i>
                                <span>5-Star Rated</span>
                            </div>
                            <div class="hero-badge">
                                <i class="fas fa-clock"></i>
                                <span>On-Time Completion</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="services-section" id="services">
            <div class="container">
                <div class="section-title text-center">
                    <span class="subtitle">Our Expertise</span>
                    <h2>Comprehensive Renovation Services</h2>
                    <p>From concept to completion, we handle every aspect of your renovation project with precision and care.</p>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-kitchen-set"></i>
                            </div>
                            <h3>Kitchen Remodeling</h3>
                            <p>Transform your kitchen into the heart of your home with custom cabinetry, modern appliances, and beautiful finishes that combine style and functionality.</p>
                            <a href="#contact" class="btn btn-outline-primary">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-bath"></i>
                            </div>
                            <h3>Bathroom Renovation</h3>
                            <p>Create your personal spa retreat with luxurious fixtures, elegant tile work, and smart storage solutions designed for comfort and relaxation.</p>
                            <a href="#contact" class="btn btn-outline-primary">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <h3>Whole Home Remodels</h3>
                            <p>Complete home transformations that reimagine your living space from top to bottom, creating a cohesive design that reflects your lifestyle.</p>
                            <a href="#contact" class="btn btn-outline-primary">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-hammer"></i>
                            </div>
                            <h3>Custom Carpentry</h3>
                            <p>Expertly crafted built-ins, custom shelving, trim work, and millwork that add character and value to your home with meticulous attention to detail.</p>
                            <a href="#contact" class="btn btn-outline-primary">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-stairs"></i>
                            </div>
                            <h3>Basement Finishing</h3>
                            <p>Unlock hidden potential by converting your basement into beautiful, functional living space perfect for family rooms, home offices, or guest suites.</p>
                            <a href="#contact" class="btn btn-outline-primary">Learn More</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </div>
                            <h3>Home Additions</h3>
                            <p>Expand your living space with seamless additions that blend perfectly with your existing home while adding square footage and value.</p>
                            <a href="#contact" class="btn btn-outline-primary">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section" id="about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="about-image-wrapper">
                            <!-- Placeholder for about image -->
                            <img src="https://images.unsplash.com/photo-1581858726788-75bc0f6a952d?w=800" alt="Right Hand Renovations Team" class="img-fluid">
                            <div class="about-badge">
                                <h4>15+</h4>
                                <p>Years Experience</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-title">
                            <span class="subtitle">About Us</span>
                            <h2>Your Trusted Renovation Partner</h2>
                        </div>
                        <p class="mb-4">At Right Hand Renovations, we believe that your home should be a reflection of your personality and lifestyle. With over 15 years of experience in the renovation industry, we've built a reputation for exceptional craftsmanship, transparent communication, and projects delivered on time and within budget.</p>
                        <p class="mb-4">Our team of skilled professionals approaches every project with the same level of dedication and attention to detail, whether it's a small bathroom refresh or a complete home transformation. We're not just contractors – we're your partners in bringing your vision to life.</p>
                        <ul class="features-list">
                            <li><i class="fas fa-check-circle"></i> Licensed, bonded, and fully insured contractors</li>
                            <li><i class="fas fa-check-circle"></i> Transparent pricing with detailed written estimates</li>
                            <li><i class="fas fa-check-circle"></i> Quality materials from trusted suppliers</li>
                            <li><i class="fas fa-check-circle"></i> Clean, organized job sites with minimal disruption</li>
                            <li><i class="fas fa-check-circle"></i> Comprehensive warranty on all workmanship</li>
                            <li><i class="fas fa-check-circle"></i> Regular communication throughout your project</li>
                        </ul>
                        <a href="#contact" class="btn btn-primary mt-3">Start Your Project</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <span class="stat-number">500+</span>
                            <span class="stat-label">Projects Completed</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <span class="stat-number">15+</span>
                            <span class="stat-label">Years Experience</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Satisfaction Rate</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-item">
                            <span class="stat-number">5★</span>
                            <span class="stat-label">Average Rating</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Portfolio Section -->
        <section class="portfolio-section" id="portfolio">
            <div class="container">
                <div class="section-title text-center">
                    <span class="subtitle">Our Work</span>
                    <h2>Recent Projects</h2>
                    <p>Take a look at some of our recent renovation projects and see the quality craftsmanship that sets us apart.</p>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="portfolio-item">
                            <img src="https://images.unsplash.com/photo-1556912173-46c336c7fd55?w=600" alt="Modern Kitchen Remodel">
                            <div class="portfolio-overlay">
                                <h4>Modern Kitchen Remodel</h4>
                                <p>Complete kitchen transformation with custom cabinetry</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="portfolio-item">
                            <img src="https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=600" alt="Luxury Master Bath">
                            <div class="portfolio-overlay">
                                <h4>Luxury Master Bath</h4>
                                <p>Spa-inspired bathroom with premium finishes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="portfolio-item">
                            <img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=600" alt="Basement Finishing">
                            <div class="portfolio-overlay">
                                <h4>Basement Finishing</h4>
                                <p>Converted basement into entertainment space</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="portfolio-item">
                            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=600" alt="Home Addition">
                            <div class="portfolio-overlay">
                                <h4>Home Addition</h4>
                                <p>Seamless two-story addition</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="portfolio-item">
                            <img src="https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=600" alt="Custom Carpentry">
                            <div class="portfolio-overlay">
                                <h4>Custom Built-Ins</h4>
                                <p>Hand-crafted shelving and cabinetry</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="portfolio-item">
                            <img src="https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=600" alt="Whole Home Remodel">
                            <div class="portfolio-overlay">
                                <h4>Whole Home Remodel</h4>
                                <p>Complete interior renovation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials-section" id="testimonials">
            <div class="container">
                <div class="section-title text-center">
                    <span class="subtitle">Client Reviews</span>
                    <h2>What Our Clients Say</h2>
                    <p>Don't just take our word for it – hear from homeowners who trusted us with their renovation projects.</p>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="testimonial-card">
                            <div class="testimonial-quote">"</div>
                            <p>"Right Hand Renovations completely transformed our outdated kitchen into a modern masterpiece. The team was professional, punctual, and the quality of work exceeded our expectations. Highly recommend!"</p>
                            <div class="testimonial-author">
                                <div class="testimonial-avatar">JD</div>
                                <div class="testimonial-author-info">
                                    <h5>John & Sarah Davis</h5>
                                    <span>Kitchen Remodel</span>
                                    <div class="testimonial-stars">★★★★★</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="testimonial-card">
                            <div class="testimonial-quote">"</div>
                            <p>"From start to finish, the process was seamless. They listened to our ideas, offered valuable suggestions, and delivered a bathroom that feels like a luxury spa. Worth every penny!"</p>
                            <div class="testimonial-author">
                                <div class="testimonial-avatar">MR</div>
                                <div class="testimonial-author-info">
                                    <h5>Michael Rodriguez</h5>
                                    <span>Bathroom Renovation</span>
                                    <div class="testimonial-stars">★★★★★</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="testimonial-card">
                            <div class="testimonial-quote">"</div>
                            <p>"We needed our basement finished on a tight timeline, and they delivered! The craftsmanship is excellent, and they kept the job site clean every day. Our family loves the new space."</p>
                            <div class="testimonial-author">
                                <div class="testimonial-avatar">CT</div>
                                <div class="testimonial-author-info">
                                    <h5>Christine Thompson</h5>
                                    <span>Basement Finishing</span>
                                    <div class="testimonial-stars">★★★★★</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section" id="cta">
            <div class="container">
                <h2>Ready to Start Your Renovation?</h2>
                <p>Let's discuss your project and bring your vision to life. Get a free, no-obligation estimate today.</p>
                <a href="#contact" class="btn btn-light btn-lg">Get Your Free Estimate</a>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-section" id="contact">
            <div class="container">
                <div class="section-title text-center">
                    <span class="subtitle">Get In Touch</span>
                    <h2>Contact Us Today</h2>
                    <p>Ready to transform your space? Reach out for a free consultation and estimate.</p>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="contact-info-box">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="contact-details">
                                    <h5>Phone</h5>
                                    <p><a href="tel:+1234567890">(123) 456-7890</a></p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-details">
                                    <h5>Email</h5>
                                    <p><a href="mailto:info@righthandrenovations.com">info@righthandrenovations.com</a></p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-details">
                                    <h5>Service Areas</h5>
                                    <p>Serving the Greater Metro Area</p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="contact-details">
                                    <h5>Business Hours</h5>
                                    <p>Mon-Fri: 8AM - 6PM<br>Sat: 9AM - 4PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="contact-form">
                            <?php 
                            // Display Gravity Forms contact form if exists
                            // Replace with actual form ID when form is created
                            if (function_exists('gravity_form')) {
                                gravity_form(1, false, false, false, '', true, 1);
                            } else {
                                // Fallback contact form HTML
                            ?>
                                <form method="post" action="">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Name *</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email *</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label">Phone *</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="service" class="form-label">Project Type</label>
                                            <select class="form-control" id="service" name="service">
                                                <option value="">Select a service...</option>
                                                <option value="kitchen">Kitchen Remodeling</option>
                                                <option value="bathroom">Bathroom Renovation</option>
                                                <option value="whole-home">Whole Home Remodel</option>
                                                <option value="carpentry">Custom Carpentry</option>
                                                <option value="basement">Basement Finishing</option>
                                                <option value="addition">Home Addition</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Project Details *</label>
                                        <textarea class="form-control" id="message" name="message" rows="6" placeholder="Tell us about your project, timeline, and budget range..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg">Request Free Estimate</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Additional Page Content -->
        <section class="section-spacer">
            <div class="<?php echo $final_container_class; ?>">
                <div class="row">
                    <div class="col-12">
                        <div class="inner-content">
                            <div class="content-no-sidebar">
                                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                                    <?php the_content(); ?>
                                <?php endwhile; else: ?>
                                    <div class="page-header">
                                        <h1>Oh no!</h1>
                                    </div>
                                    <p>No content is appearing for this page!</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

</div><!-- end page wrap -->

<?php get_footer(); ?>

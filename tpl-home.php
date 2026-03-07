<?php
/*
Template Name: Organize Plus Home Template
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
                    <div class="col-lg-7">
                        <h1>Residential Cleaning & Room Organization</h1>
                        <p class="lead">Professional cleaning and organizing services to help simplify your life and restore order to your home or office.</p>
                        <div class="mt-4">
                            <a href="#contact" class="btn btn-primary btn-lg me-3 mb-2">Get a Free Quote</a>
                            <a href="#services" class="btn btn-light btn-lg mb-2">Our Services</a>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- Hero image placeholder -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="services-section" id="services">
            <div class="container">
                <div class="section-title">
                    <h2>Cleaning & Organizing Services</h2>
                    <p>Comprehensive solutions for a cleaner, more organized life</p>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <h3>Declutter</h3>
                            <p>What is clutter? Clutter is anything you're keeping that doesn't add value to your life. De-cluttering is all about making room in your home for the things that truly matter. Organize Plus Cleaning offers professional de-cluttering services to help simplify your life and organize your home or office for optimum functionality.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <h3>Organizing is our Specialty</h3>
                            <p>If your goal this year is to improve your relationships, career, and overall health and wellness, it should start with an organized, clean space where you can be the best version of yourself. Our team of professional organizers are committed to restoring organization and controlling clutter by implementing space solutions best suited for your lifestyle.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-sparkles"></i>
                            </div>
                            <h3>A Sparkling Clean Home</h3>
                            <p>With busy schedules and fast-paced lifestyles, it's sometimes hard to maintain a clean home. At Organize Plus Cleaning we specialize in delivering quality deep-cleaning services tailored to our clients needs. We provide regular, recurring house cleaning services, either weekly, biweekly or monthly.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section-title text-start">
                            <h2>Office & House Cleaning</h2>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-broom"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Professional Cleaning Services</h4>
                                <p>The appearance of a dirty, untidy house can often cause stress and anxiety. At Organize Plus Cleaning we specialize in delivering quality deep-cleaning services tailored to our clients needs. Our cleaning service can help save you time and money.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Flexible Scheduling</h4>
                                <p>We provide regular, recurring house cleaning and commercial cleaning services, either weekly, biweekly or monthly to ensure your home or office is professionally cleaned and maintained.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-title text-start">
                            <h2>A Safe & Healthy Home</h2>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Eco-Friendly Products</h4>
                                <p>A clean home is a healthy home and natural eco friendly cleaning products offer an effective way to disinfect and clean. At Organize Plus Cleaning we use products that are safe and non-toxic.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="feature-content">
                                <h4>Safe for Family & Pets</h4>
                                <p>Eco-friendly products can help to improve overall indoor air quality and thus contribute to reducing certain health risks. We are committed to utilizing natural, eco-friendly products that are beneficial to you, your family, and your pets.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Additional Services Section -->
        <section class="services-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <h3>Real Estate Cleaning & Organizing</h3>
                            <p>Cleanliness is often a top priority when buyers are looking at properties, and a clean home instantly communicates quality and value. Organize Plus Cleaning is proud of our successful partnerships and collaborations with Real Estate professionals throughout Georgia. Whether you're showing a fix-it-up foreclosure, a newly updated property, or a brand new dream house, our professional cleaning and organizing services is the secret to your Real Estate success.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-compress-arrows-alt"></i>
                            </div>
                            <h3>Maximize Your Living Space</h3>
                            <p>We know that moving, downsizing, de-cluttering, packing and storing can be a daunting task. Our goal is to step in and completely take on the responsibility of helping you manage your most treasured belongings and all the memories that accompany them. Let us help you modify your living areas and possessions to improve your life and overall well-being. Organize Plus Cleaning is your downsizing solution, giving you and your family peace of mind and unwanted stress.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section" id="contact">
            <div class="container">
                <h2>Ready to Transform Your Space?</h2>
                <p>Contact us today for a free consultation and quote</p>
                <a href="#contact-form" class="btn btn-light btn-lg">Get Your Free Quote</a>
            </div>
        </section>

        <!-- Contact Form Section -->
        <section class="contact-section" id="contact-form">
            <div class="container">
                <div class="section-title">
                    <h2>Get In Touch</h2>
                    <p>We'd love to hear from you and discuss how we can help</p>
                </div>
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="contact-info">
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
                                    <p><a href="mailto:info@organizepluscleaning.com">info@organizepluscleaning.com</a></p>
                                </div>
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-details">
                                    <h5>Service Areas</h5>
                                    <p>Georgia</p>
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
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="tel" class="form-control" id="phone" name="phone">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="service" class="form-label">Service Needed</label>
                                            <select class="form-control" id="service" name="service">
                                                <option value="">Select a service...</option>
                                                <option value="declutter">Decluttering</option>
                                                <option value="organizing">Home Organization</option>
                                                <option value="cleaning">House Cleaning</option>
                                                <option value="realestate">Real Estate Cleaning</option>
                                                <option value="downsizing">Downsizing Services</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message *</label>
                                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
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

<?php
/*
	Template Name: Ticket Report
*/

// Restrict to admins only
if ( ! current_user_can( 'manage_options' ) ) {
	wp_redirect( home_url() );
	exit;
}

get_header();
?>

<div id="page-wrap">
	<div class="container">
		<div class="inner-content">
			<div class="content-no-sidebar">

				<div class="page-header">
					<h1>FooEvents Ticket Report</h1>
				</div>

				<div id="ticket-report-app">

					<!-- Tab Navigation -->
					<ul class="nav nav-tabs mb-4" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-bs-toggle="tab" href="#tab-by-event" role="tab">By Event</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="tab" href="#tab-by-customer" role="tab">By Customer</a>
						</li>
					</ul>

					<div class="tab-content">

						<!-- BY EVENT TAB -->
						<div class="tab-pane fade show active" id="tab-by-event" role="tabpanel">
							<div class="row mb-4">
								<div class="col-md-8">
									<label for="event-select" class="form-label"><strong>Select Event</strong></label>
									<select id="event-select" class="form-select">
										<option value="">-- Choose an event --</option>
									</select>
								</div>
								<div class="col-md-4 d-flex align-items-end">
									<button id="load-event-btn" class="btn btn-primary ulg-btn ulg-section-btn border-0 w-100" disabled>Load Tickets</button>
								</div>
							</div>

							<div id="event-summary" class="alert alert-info d-none"></div>

							<div id="event-results">
								<p class="text-muted">Select an event above to view ticket data.</p>
							</div>
						</div>

						<!-- BY CUSTOMER TAB -->
						<div class="tab-pane fade" id="tab-by-customer" role="tabpanel">
							<div class="row mb-4">
								<div class="col-md-8">
									<label for="customer-search" class="form-label"><strong>Search Customer</strong></label>
									<input type="text" id="customer-search" class="form-control" placeholder="Name or email...">
								</div>
								<div class="col-md-4 d-flex align-items-end">
									<button id="search-customer-btn" class="btn btn-primary ulg-btn ulg-section-btn border-0 w-100">Search</button>
								</div>
							</div>

							<div id="customer-results">
								<p class="text-muted">Enter a name or email to search for ticket purchases.</p>
							</div>
						</div>

					</div><!-- .tab-content -->

				</div><!-- #ticket-report-app -->

			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>

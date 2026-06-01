<?php
/*
	Template Name: For Coaches
	Description: QBIQ "For Coaches & Teams" page — coach dashboard mock, why
	             coaches install QBIQ, install timeline, quotes, plans table.
	             Content is hardcoded for now.
*/
?>
<?php get_header(); ?>

<div class="qb-coaches">

<!-- ============================================ HERO -->
<header class="co-hero">
	<div class="container position-relative">
		<div class="row align-items-center g-5">
			<div class="col-lg-6">
				<span class="qb-eyebrow">For Coaches &amp; Teams</span>
				<h1 class="qb-display mt-3 mb-4" style="font-size: clamp(2.5rem, 5.5vw, 4.5rem);">
					A QB-room install supplement,
					<span style="color: var(--qb-accent);">built for your program.</span>
				</h1>
				<p class="lead mb-4" style="max-width: 560px; color: #d8dbe2;">
					QBIQ Team gives every QB on your roster the same mental-rep system, plus a coach dashboard
					to see who's training, who's improving, and who needs a film session before Friday.
				</p>
				<div class="d-flex flex-wrap gap-3 mb-4">
					<a href="#" class="btn btn-qb btn-qb-primary">Book a Demo</a>
					<a href="#" class="btn btn-qb btn-qb-outline-light">See Team Plans</a>
				</div>
				<div class="d-flex flex-wrap gap-4 small text-muted">
					<span><i class="bi bi-shield-check text-warning me-1"></i> Used by 500+ programs</span>
					<span><i class="bi bi-people-fill text-warning me-1"></i> HS &middot; college &middot; select pro</span>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="co-dash">
					<div class="co-dash-bar">
						<span class="co-dot" style="background:#ff5f56;"></span>
						<span class="co-dot" style="background:#ffbd2e;"></span>
						<span class="co-dot" style="background:#27c93f;"></span>
						<span class="co-url">app.qbiqsystem.com / coach</span>
					</div>
					<div class="co-dash-body">
						<div class="co-dash-grid">
							<aside class="co-dash-side">
								<div class="qb-eyebrow mb-3" style="font-size: .68rem;">Eastside HS</div>
								<div class="co-dash-side-item active"><i class="bi bi-grid-fill"></i>QB Room</div>
								<div class="co-dash-side-item"><i class="bi bi-clipboard-data"></i>Reports</div>
								<div class="co-dash-side-item"><i class="bi bi-calendar-event"></i>This Week</div>
								<div class="co-dash-side-item"><i class="bi bi-film"></i>Opp Prep</div>
								<div class="co-dash-side-item"><i class="bi bi-gear"></i>Settings</div>
							</aside>
							<div class="co-dash-main">
								<div class="co-dash-tiles">
									<div class="co-dash-tile">
										<div class="co-dash-tile-label">Avg Read Speed</div>
										<div class="co-dash-tile-num">2.6s</div>
										<div class="co-dash-tile-delta">&#9660; 0.8s &middot; week</div>
									</div>
									<div class="co-dash-tile">
										<div class="co-dash-tile-label">Accuracy</div>
										<div class="co-dash-tile-num">87%</div>
										<div class="co-dash-tile-delta">&#9650; 6% &middot; week</div>
									</div>
									<div class="co-dash-tile">
										<div class="co-dash-tile-label">Reps This Week</div>
										<div class="co-dash-tile-num">412</div>
										<div class="co-dash-tile-delta">&#9650; 28% &middot; week</div>
									</div>
								</div>
								<div class="co-dash-table">
									<div class="co-dash-th">
										<span>Roster</span>
										<span>Reads</span>
										<span>Acc.</span>
										<span>Streak</span>
									</div>
									<div class="co-dash-row">
										<div><span class="co-dash-name">J. Harrell</span><span class="co-dash-pos">QB1</span></div>
										<div>2.3s</div>
										<div>91%</div>
										<div class="co-bar"><span style="width: 92%;"></span></div>
									</div>
									<div class="co-dash-row">
										<div><span class="co-dash-name">T. Velez</span><span class="co-dash-pos">QB2</span></div>
										<div>2.7s</div>
										<div>84%</div>
										<div class="co-bar"><span style="width: 78%;"></span></div>
									</div>
									<div class="co-dash-row">
										<div><span class="co-dash-name">M. Brooks</span><span class="co-dash-pos">WR</span></div>
										<div>2.8s</div>
										<div>82%</div>
										<div class="co-bar"><span style="width: 70%;"></span></div>
									</div>
									<div class="co-dash-row">
										<div><span class="co-dash-name">D. Park</span><span class="co-dash-pos">QB3</span></div>
										<div>3.1s</div>
										<div>74%</div>
										<div class="co-bar"><span style="width: 55%;"></span></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<!-- ============================================ WHY COACHES -->
<section class="qb-section qb-bg-dark">
	<div class="container">
		<div class="text-center mb-5">
			<span class="qb-eyebrow">Why coaches install QBIQ</span>
			<h2 class="qb-display mt-3 mb-2" style="font-size: clamp(2rem, 4vw, 3rem);">More reps. Better decisions. Faster.</h2>
			<p class="text-muted mx-auto mb-0" style="max-width: 600px;">
				QBIQ doesn't replace your install &mdash; it multiplies it. Every QB shows up to Monday's film already inside the language of defense.
			</p>
		</div>

		<div class="row g-4">
			<div class="col-md-6 col-lg-3">
				<div class="co-why">
					<div class="co-why-icon"><i class="bi bi-arrow-repeat"></i></div>
					<h4>10&times; mental reps</h4>
					<p>Daily 2-minute drills give your QBs reps you can't fit into practice scripts.</p>
				</div>
			</div>
			<div class="col-md-6 col-lg-3">
				<div class="co-why">
					<div class="co-why-icon"><i class="bi bi-bar-chart-line"></i></div>
					<h4>See who's training</h4>
					<p>The coach dashboard shows reps, recognition speed, and accuracy by player and by week.</p>
				</div>
			</div>
			<div class="col-md-6 col-lg-3">
				<div class="co-why">
					<div class="co-why-icon"><i class="bi bi-file-earmark-text"></i></div>
					<h4>Custom opponent prep</h4>
					<p>Build weekly prep packets from QBIQ's library and our self-scout templates.</p>
				</div>
			</div>
			<div class="col-md-6 col-lg-3">
				<div class="co-why">
					<div class="co-why-icon"><i class="bi bi-translate"></i></div>
					<h4>Shared language</h4>
					<p>QBs, WRs, and coaches all speak the same defensive vocabulary. Film room moves faster.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ============================================ INSTALL TIMELINE -->
<section class="qb-section qb-bg-ink2">
	<div class="container">
		<div class="row g-5 align-items-start">
			<div class="col-lg-5">
				<span class="qb-eyebrow">Install Plan</span>
				<h2 class="qb-display mt-3 mb-3" style="font-size: clamp(2rem, 4vw, 3rem);">From handshake to first rep in two weeks.</h2>
				<p class="text-muted mb-4">A typical install for a 4&ndash;10 player QB room. Built around your offense, not against it.</p>
				<a href="#" class="btn btn-qb btn-qb-primary">Book a 20-min demo</a>
			</div>

			<div class="col-lg-7">
				<div class="co-timeline">
					<div class="co-time-step">
						<div class="co-time-when">Day 0</div>
						<h4>Discovery Call</h4>
						<p>20 minutes with a QBIQ coach. We learn your offense, your QB room, and your bottleneck &mdash; coverage ID, pre-snap decisions, or pressure response.</p>
					</div>
					<div class="co-time-step">
						<div class="co-time-when">Days 1&ndash;3</div>
						<h4>Onboarding &amp; Setup</h4>
						<p>Roster import, coach dashboard configured to your concepts, custom flash-card decks built around your opponents this season.</p>
					</div>
					<div class="co-time-step">
						<div class="co-time-when">Day 4</div>
						<h4>Player Kickoff</h4>
						<p>A QBIQ coach runs the first session in your QB room. Players install the app, complete chapter one, and finish their baseline read test.</p>
					</div>
					<div class="co-time-step">
						<div class="co-time-when">Week 2+</div>
						<h4>Weekly Rhythm</h4>
						<p>Drills on the bus. Install reads in Monday's film. Custom opp prep mid-week. Coach reports every Sunday morning at 7am.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ============================================ COACH QUOTES -->
<section class="qb-section qb-bg-dark">
	<div class="container">
		<div class="text-center mb-5">
			<span class="qb-eyebrow">From the sideline</span>
			<h2 class="qb-display mt-3 mb-0" style="font-size: clamp(2rem, 4vw, 3rem);">Coaches who put QBIQ on their staff.</h2>
		</div>

		<div class="row g-4">
			<div class="col-md-4">
				<article class="qb-quote">
					<i class="bi bi-quote text-warning fs-3 d-block mb-2"></i>
					<p>Our QBs picked up two seasons of mental reps in eight weeks. Friday-night decisions look completely different.</p>
					<div class="qb-quote-name">Coach Williams</div>
					<div class="qb-quote-role">Head Coach &middot; Eastside HS</div>
				</article>
			</div>
			<div class="col-md-4">
				<article class="qb-quote">
					<i class="bi bi-quote text-warning fs-3 d-block mb-2"></i>
					<p>The dashboard is the part I never knew I needed. I see who put in reps before I see them in the building Monday morning.</p>
					<div class="qb-quote-name">Coach Reyes</div>
					<div class="qb-quote-role">QB Coach &middot; Apex Football</div>
				</article>
			</div>
			<div class="col-md-4">
				<article class="qb-quote">
					<i class="bi bi-quote text-warning fs-3 d-block mb-2"></i>
					<p>Coach Hixson built the manual every QB coach needs. I'd pay for QBIQ out of my own pocket.</p>
					<div class="qb-quote-name">Coach McEwen</div>
					<div class="qb-quote-role">OC &middot; Ridgeway Football</div>
				</article>
			</div>
		</div>
	</div>
</section>

<!-- ============================================ PLANS -->
<section class="qb-section qb-bg-ink2">
	<div class="container">
		<div class="text-center mb-5">
			<span class="qb-eyebrow">Team Plans</span>
			<h2 class="qb-display mt-3 mb-2" style="font-size: clamp(2rem, 4vw, 3rem);">Pricing that fits the program.</h2>
			<p class="text-muted mx-auto mb-0" style="max-width: 560px;">All team plans include the coach dashboard, weekly reports, and onboarding with a QBIQ coach.</p>
		</div>

		<div class="co-plans">
			<div class="table-responsive">
			<table>
				<thead>
					<tr>
						<th></th>
						<th class="co-plans-h">QB Room<span class="co-plans-price">$49<small>/mo</small></span></th>
						<th class="co-plans-h co-plans-featured">Program<span class="co-plans-price">$129<small>/mo</small></span></th>
						<th class="co-plans-h">District<span class="co-plans-price">Custom</span></th>
					</tr>
				</thead>
				<tbody>
					<tr><td>QB / WR seats included</td><td>Up to 6</td><td class="co-plans-featured">Up to 20</td><td>Unlimited</td></tr>
					<tr><td>Coach seats</td><td>1</td><td class="co-plans-featured">3</td><td>Unlimited</td></tr>
					<tr><td>Coach dashboard</td><td><i class="bi bi-check2"></i></td><td class="co-plans-featured"><i class="bi bi-check2"></i></td><td><i class="bi bi-check2"></i></td></tr>
					<tr><td>Weekly reports</td><td><i class="bi bi-check2"></i></td><td class="co-plans-featured"><i class="bi bi-check2"></i></td><td><i class="bi bi-check2"></i></td></tr>
					<tr><td>Custom opp-prep packets</td><td><i class="bi bi-dash"></i></td><td class="co-plans-featured"><i class="bi bi-check2"></i></td><td><i class="bi bi-check2"></i></td></tr>
					<tr><td>Onboarding session</td><td>Group video</td><td class="co-plans-featured">In-person + film</td><td>On-site clinic</td></tr>
					<tr><td>Priority coach support</td><td><i class="bi bi-dash"></i></td><td class="co-plans-featured"><i class="bi bi-check2"></i></td><td><i class="bi bi-check2"></i></td></tr>
					<tr class="co-plans-cta-row">
						<td></td>
						<td><a href="#" class="btn btn-qb btn-qb-outline-light">Start Trial</a></td>
						<td class="co-plans-featured"><a href="#" class="btn btn-qb btn-qb-primary">Book Demo</a></td>
						<td><a href="#" class="btn btn-qb btn-qb-outline-light">Contact Us</a></td>
					</tr>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</section>

<!-- ============================================ CTA -->
<section class="qb-bg-accent" style="padding-block: clamp(3.5rem, 7vw, 5rem);">
	<div class="container">
		<div class="row align-items-center g-4">
			<div class="col-lg-8">
				<h2 class="qb-display mb-2" style="font-size: clamp(2rem, 4vw, 3rem);">Bring QBIQ to your sideline.</h2>
				<p class="mb-0" style="color: rgba(255,255,255,.92); max-width: 540px;">Book a 20-minute demo. We'll show you exactly what your QBs would see Monday morning.</p>
			</div>
			<div class="col-lg-4 text-lg-end">
				<a href="#" class="btn btn-qb btn-qb-dark me-2">Book Demo</a>
				<a href="#" class="btn btn-qb" style="background:#fff; color: var(--qb-accent);">Email Us</a>
			</div>
		</div>
	</div>
</section>

</div><!-- /.qb-coaches -->

<?php get_footer(); ?>

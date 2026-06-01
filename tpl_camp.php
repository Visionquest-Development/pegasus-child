<?php
/*
	Template Name: Camps
	Description: QBIQ "Camps & Training Centers" page — upcoming camps grid,
	             day-at-camp schedule, training centers map + list, CTA.
	             Content is hardcoded for now.
*/
?>
<?php get_header(); ?>

<div class="qb-camp">

<!-- ============================================ HERO -->
<header class="cp-hero text-center">
	<div class="container position-relative">
		<span class="qb-eyebrow v1-eyebrow-center" style="justify-content: center; display: inline-flex;">Camps &amp; Training Centers</span>
		<h1 class="qb-display mt-3 mb-3" style="font-size: clamp(2.5rem, 6vw, 5rem);">
			Real reps.<br />
			<span style="color: var(--qb-accent);">In real rooms.</span>
		</h1>
		<p class="lead mx-auto mb-4" style="max-width: 640px; color: #d8dbe2;">
			Two days. One QB room. Coach Hixson on the whiteboard, the field, and the film. QBIQ camps and training-center sessions bring the system off-screen.
		</p>
		<div class="d-flex justify-content-center flex-wrap gap-3">
			<a href="#camps" class="btn btn-qb btn-qb-primary">View Upcoming Camps</a>
			<a href="#centers" class="btn btn-qb btn-qb-outline-light">Find a Training Center</a>
		</div>
	</div>
</header>

<!-- ============================================ CAMP FILTERS + GRID -->
<section id="camps" class="qb-section qb-bg-dark">
	<div class="container">
		<div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
			<div>
				<span class="qb-eyebrow">Upcoming &middot; 2026 Season</span>
				<h2 class="qb-display mt-3 mb-0" style="font-size: clamp(2rem, 4vw, 3rem);">Six camps. Open registration.</h2>
			</div>
			<div class="cp-filters">
				<span class="cp-filter active">All</span>
				<span class="cp-filter">QB</span>
				<span class="cp-filter">WR</span>
				<span class="cp-filter">QB &amp; WR</span>
				<span class="cp-filter">Coaches</span>
			</div>
		</div>

		<div class="row g-4">
			<!-- CAMP 1 -->
			<div class="col-md-6 col-lg-4">
				<article class="cp-camp">
					<div class="cp-camp-vis cp-camp-vis-green">
						<div class="cp-camp-date"><div class="cp-camp-date-mo">JUN</div><div class="cp-camp-date-d">12</div></div>
						<span class="cp-camp-pos">QB</span>
						<svg class="cp-camp-vis-svg" viewBox="0 0 100 56" preserveAspectRatio="none">
							<g stroke="rgba(255,255,255,.18)" stroke-width=".3"><line x1="0" y1="20" x2="100" y2="20"/><line x1="0" y1="36" x2="100" y2="36"/></g>
							<g fill="#fff" opacity=".85"><circle cx="35" cy="18" r="1.5"/><circle cx="50" cy="18" r="1.5"/><circle cx="65" cy="18" r="1.5"/></g>
							<g fill="#e98318"><circle cx="50" cy="42" r="2"/><circle cx="32" cy="38" r="1.5"/><circle cx="68" cy="38" r="1.5"/></g>
						</svg>
					</div>
					<div class="cp-camp-body">
						<div class="cp-camp-loc">Cincinnati, OH</div>
						<h3 class="cp-camp-title">QB Reads Intensive</h3>
						<div class="cp-camp-meta">
							<span><i class="bi bi-calendar-event"></i>Jun 12&ndash;14</span>
							<span><i class="bi bi-people"></i>HS &amp; College QBs</span>
							<span><i class="bi bi-clock"></i>3 days</span>
						</div>
						<div class="cp-camp-foot">
							<div class="cp-camp-price">$495<small>USD</small></div>
							<div class="cp-camp-spots"><span class="cp-camp-dot"></span>8 spots left</div>
						</div>
					</div>
				</article>
			</div>

			<!-- CAMP 2 -->
			<div class="col-md-6 col-lg-4">
				<article class="cp-camp">
					<div class="cp-camp-vis cp-camp-vis-orange">
						<div class="cp-camp-date"><div class="cp-camp-date-mo">JUL</div><div class="cp-camp-date-d">08</div></div>
						<span class="cp-camp-pos">QB &middot; WR</span>
						<svg class="cp-camp-vis-svg" viewBox="0 0 100 56" preserveAspectRatio="none">
							<g stroke="rgba(255,255,255,.22)" stroke-width=".3" stroke-dasharray="2 2"><line x1="20" y1="40" x2="20" y2="20"/><line x1="80" y1="40" x2="80" y2="20"/></g>
							<g fill="#fff" opacity=".9"><circle cx="20" cy="20" r="2"/><circle cx="80" cy="20" r="2"/><circle cx="50" cy="42" r="2.5"/></g>
						</svg>
					</div>
					<div class="cp-camp-body">
						<div class="cp-camp-loc">Nashville, TN</div>
						<h3 class="cp-camp-title">Throw &amp; Catch Lab</h3>
						<div class="cp-camp-meta">
							<span><i class="bi bi-calendar-event"></i>Jul 8&ndash;9</span>
							<span><i class="bi bi-people"></i>QB + WR pairs</span>
							<span><i class="bi bi-clock"></i>2 days</span>
						</div>
						<div class="cp-camp-foot">
							<div class="cp-camp-price">$395<small>USD</small></div>
							<div class="cp-camp-spots cp-camp-low"><span class="cp-camp-dot"></span>3 spots left</div>
						</div>
					</div>
				</article>
			</div>

			<!-- CAMP 3 -->
			<div class="col-md-6 col-lg-4">
				<article class="cp-camp">
					<div class="cp-camp-vis cp-camp-vis-blue">
						<div class="cp-camp-date"><div class="cp-camp-date-mo">JUL</div><div class="cp-camp-date-d">22</div></div>
						<span class="cp-camp-pos">Coaches</span>
						<svg class="cp-camp-vis-svg" viewBox="0 0 100 56" preserveAspectRatio="none">
							<rect x="20" y="10" width="60" height="36" fill="none" stroke="rgba(255,255,255,.3)" stroke-width=".4"/>
							<text x="50" y="30" text-anchor="middle" fill="#fff" font-family="Archivo" font-size="6" font-weight="800" opacity=".8">CLINIC</text>
							<text x="50" y="40" text-anchor="middle" fill="#e98318" font-family="JetBrains Mono" font-size="3.5">QB ROOM INSTALL</text>
						</svg>
					</div>
					<div class="cp-camp-body">
						<div class="cp-camp-loc">Chicago, IL</div>
						<h3 class="cp-camp-title">Coaches Clinic</h3>
						<div class="cp-camp-meta">
							<span><i class="bi bi-calendar-event"></i>Jul 22</span>
							<span><i class="bi bi-people"></i>HS &amp; college staff</span>
							<span><i class="bi bi-clock"></i>1 day</span>
						</div>
						<div class="cp-camp-foot">
							<div class="cp-camp-price">$249<small>USD</small></div>
							<div class="cp-camp-spots"><span class="cp-camp-dot"></span>Open</div>
						</div>
					</div>
				</article>
			</div>

			<!-- CAMP 4 -->
			<div class="col-md-6 col-lg-4">
				<article class="cp-camp">
					<div class="cp-camp-vis cp-camp-vis-red">
						<div class="cp-camp-date"><div class="cp-camp-date-mo">AUG</div><div class="cp-camp-date-d">04</div></div>
						<span class="cp-camp-pos">QB</span>
						<svg class="cp-camp-vis-svg" viewBox="0 0 100 56" preserveAspectRatio="none">
							<g fill="#fff" opacity=".85"><circle cx="30" cy="18" r="1.5"/><circle cx="50" cy="18" r="1.5"/><circle cx="70" cy="18" r="1.5"/></g>
							<g fill="#e98318"><circle cx="50" cy="42" r="2.5"/></g>
							<path d="M50 42 Q 50 30 50 18" stroke="#e98318" stroke-width=".8" fill="none" stroke-dasharray="2 2"/>
						</svg>
					</div>
					<div class="cp-camp-body">
						<div class="cp-camp-loc">Dallas, TX</div>
						<h3 class="cp-camp-title">Elite QB Showcase</h3>
						<div class="cp-camp-meta">
							<span><i class="bi bi-calendar-event"></i>Aug 4&ndash;6</span>
							<span><i class="bi bi-people"></i>Invite-only &middot; College recruits</span>
							<span><i class="bi bi-clock"></i>3 days</span>
						</div>
						<div class="cp-camp-foot">
							<div class="cp-camp-price">$795<small>USD</small></div>
							<div class="cp-camp-spots cp-camp-full"><span class="cp-camp-dot"></span>Waitlist</div>
						</div>
					</div>
				</article>
			</div>

			<!-- CAMP 5 -->
			<div class="col-md-6 col-lg-4">
				<article class="cp-camp">
					<div class="cp-camp-vis cp-camp-vis-night">
						<div class="cp-camp-date"><div class="cp-camp-date-mo">AUG</div><div class="cp-camp-date-d">18</div></div>
						<span class="cp-camp-pos">WR</span>
						<svg class="cp-camp-vis-svg" viewBox="0 0 100 56" preserveAspectRatio="none">
							<g fill="#e98318"><circle cx="18" cy="40" r="2"/><circle cx="82" cy="40" r="2"/></g>
							<path d="M18 40 L18 28 L26 22" stroke="#e98318" stroke-width=".8" fill="none" stroke-dasharray="2 2"/>
							<path d="M82 40 L82 28 L74 22" stroke="#e98318" stroke-width=".8" fill="none" stroke-dasharray="2 2"/>
							<g fill="#fff" opacity=".7"><circle cx="40" cy="18" r="1.3"/><circle cx="60" cy="18" r="1.3"/></g>
						</svg>
					</div>
					<div class="cp-camp-body">
						<div class="cp-camp-loc">Phoenix, AZ</div>
						<h3 class="cp-camp-title">Receiver Read Lab</h3>
						<div class="cp-camp-meta">
							<span><i class="bi bi-calendar-event"></i>Aug 18&ndash;19</span>
							<span><i class="bi bi-people"></i>WRs &middot; all levels</span>
							<span><i class="bi bi-clock"></i>2 days</span>
						</div>
						<div class="cp-camp-foot">
							<div class="cp-camp-price">$345<small>USD</small></div>
							<div class="cp-camp-spots"><span class="cp-camp-dot"></span>12 spots left</div>
						</div>
					</div>
				</article>
			</div>

			<!-- CAMP 6 -->
			<div class="col-md-6 col-lg-4">
				<article class="cp-camp">
					<div class="cp-camp-vis cp-camp-vis-purple">
						<div class="cp-camp-date"><div class="cp-camp-date-mo">SEP</div><div class="cp-camp-date-d">14</div></div>
						<span class="cp-camp-pos">QB &middot; WR</span>
						<svg class="cp-camp-vis-svg" viewBox="0 0 100 56" preserveAspectRatio="none">
							<rect x="15" y="10" width="70" height="36" fill="none" stroke="rgba(255,255,255,.3)" stroke-width=".4" stroke-dasharray="3 2"/>
							<g fill="#fff" opacity=".85"><circle cx="30" cy="22" r="1.5"/><circle cx="50" cy="22" r="1.5"/><circle cx="70" cy="22" r="1.5"/></g>
							<g fill="#e98318"><circle cx="50" cy="40" r="2"/></g>
						</svg>
					</div>
					<div class="cp-camp-body">
						<div class="cp-camp-loc">Atlanta, GA</div>
						<h3 class="cp-camp-title">Read &amp; Recognition Camp</h3>
						<div class="cp-camp-meta">
							<span><i class="bi bi-calendar-event"></i>Sep 14&ndash;15</span>
							<span><i class="bi bi-people"></i>Pre-season &middot; QB &amp; WR</span>
							<span><i class="bi bi-clock"></i>2 days</span>
						</div>
						<div class="cp-camp-foot">
							<div class="cp-camp-price">$395<small>USD</small></div>
							<div class="cp-camp-spots"><span class="cp-camp-dot"></span>Open</div>
						</div>
					</div>
				</article>
			</div>
		</div>

		<div class="text-center mt-5">
			<a href="#" class="btn btn-qb btn-qb-outline-light">Join the waitlist for new dates</a>
		</div>
	</div>
</section>

<!-- ============================================ WHAT HAPPENS -->
<section class="qb-section qb-bg-ink2">
	<div class="container">
		<div class="row g-5 align-items-start">
			<div class="col-lg-5">
				<span class="qb-eyebrow">A Day at Camp</span>
				<h2 class="qb-display mt-3 mb-3" style="font-size: clamp(2rem, 4vw, 3rem);">What two days at QBIQ camp looks like.</h2>
				<p class="text-muted mb-4">Half whiteboard. Half field. Mostly reps. Every camp ends with a personal scouting report for each player.</p>
				<ul class="list-unstyled" style="color: #d8dbe2;">
					<li class="py-2 d-flex gap-2"><i class="bi bi-check2-circle text-warning"></i> Coach Hixson teaches every session</li>
					<li class="py-2 d-flex gap-2"><i class="bi bi-check2-circle text-warning"></i> Max 24 athletes per camp</li>
					<li class="py-2 d-flex gap-2"><i class="bi bi-check2-circle text-warning"></i> All film recorded &mdash; yours to keep</li>
					<li class="py-2 d-flex gap-2"><i class="bi bi-check2-circle text-warning"></i> 90-day QBIQ app access included</li>
				</ul>
			</div>

			<div class="col-lg-7">
				<div class="cp-schedule">
					<div class="cp-sched-item">
						<div class="cp-sched-time">8:00</div>
						<div>
							<div class="cp-sched-title">Whiteboard install &mdash; Coverage of the day</div>
							<div class="cp-sched-desc">Cover 2 tells, beaters, leverage. Live questions and worked examples.</div>
						</div>
					</div>
					<div class="cp-sched-item">
						<div class="cp-sched-time">9:30</div>
						<div>
							<div class="cp-sched-title">Field block &mdash; Read drills</div>
							<div class="cp-sched-desc">Walk-through speed. Identify, decide, throw. Three reps per rotation.</div>
						</div>
					</div>
					<div class="cp-sched-item">
						<div class="cp-sched-time">11:00</div>
						<div>
							<div class="cp-sched-title">Flash card game &mdash; Pattern reps</div>
							<div class="cp-sched-desc">Timed coverage ID. Bracket-style competition.</div>
						</div>
					</div>
					<div class="cp-sched-item">
						<div class="cp-sched-time">12:00</div>
						<div>
							<div class="cp-sched-title">Lunch + Film with the coaches</div>
							<div class="cp-sched-desc">Watch your morning reps with a QBIQ coach. Eat. Adjust.</div>
						</div>
					</div>
					<div class="cp-sched-item">
						<div class="cp-sched-time">2:00</div>
						<div>
							<div class="cp-sched-title">Live periods &mdash; Full speed, full route tree</div>
							<div class="cp-sched-desc">Decision-making under pressure. Live DBs, real coverage rotations.</div>
						</div>
					</div>
					<div class="cp-sched-item">
						<div class="cp-sched-time">4:30</div>
						<div>
							<div class="cp-sched-title">Day-end review &amp; scouting report</div>
							<div class="cp-sched-desc">Your reads, your decisions, your next steps &mdash; written by your coach.</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ============================================ TRAINING CENTERS -->
<section id="centers" class="qb-section qb-bg-dark">
	<div class="container">
		<div class="text-center mb-5">
			<span class="qb-eyebrow v1-eyebrow-center" style="display: inline-flex;">Training Centers</span>
			<h2 class="qb-display mt-3 mb-2" style="font-size: clamp(2rem, 4vw, 3rem);">Year-round QBIQ rooms.</h2>
			<p class="text-muted mx-auto mb-0" style="max-width: 560px;">Local training centers run weekly QBIQ sessions for individuals and small groups. Walk in. Get reps. Leave smarter.</p>
		</div>

		<div class="row g-4 mb-5">
			<div class="col-lg-7">
				<div class="cp-map">
					<div class="cp-map-graticule"></div>
					<div class="cp-map-pin" style="left:30%; top:42%;">
						<span class="cp-map-pin-label">Cincinnati</span>
					</div>
					<div class="cp-map-pin" style="left:42%; top:60%;">
						<span class="cp-map-pin-label">Nashville</span>
					</div>
					<div class="cp-map-pin" style="left:55%; top:68%;">
						<span class="cp-map-pin-label">Atlanta</span>
					</div>
					<div class="cp-map-pin" style="left:38%; top:35%;">
						<span class="cp-map-pin-label">Chicago</span>
					</div>
					<div class="cp-map-pin" style="left:22%; top:65%;">
						<span class="cp-map-pin-label">Dallas</span>
					</div>
					<div class="cp-map-pin" style="left:12%; top:55%;">
						<span class="cp-map-pin-label">Phoenix</span>
					</div>
					<div class="cp-map-pin" style="left:75%; top:50%;">
						<span class="cp-map-pin-label">Raleigh</span>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="row g-3">
					<div class="col-12">
						<div class="cp-center">
							<div class="cp-center-city">Cincinnati, OH</div>
							<h4>QBIQ HQ Training Center</h4>
							<div class="cp-center-meta">Indoor turf &middot; Whiteboard room &middot; Film bay. Open year-round.</div>
							<a href="#">View schedule &rarr;</a>
						</div>
					</div>
					<div class="col-12">
						<div class="cp-center">
							<div class="cp-center-city">Nashville, TN</div>
							<h4>Music City QB Lab</h4>
							<div class="cp-center-meta">Partner facility. Weekly group sessions + 1-on-1 reviews.</div>
							<a href="#">View schedule &rarr;</a>
						</div>
					</div>
					<div class="col-12">
						<div class="cp-center">
							<div class="cp-center-city">Atlanta, GA</div>
							<h4>Peach State Performance</h4>
							<div class="cp-center-meta">Year-round indoor turf. QBIQ-certified coaches on staff.</div>
							<a href="#">View schedule &rarr;</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="text-center">
			<a href="#" class="btn btn-qb btn-qb-outline-light">See all 7 training centers</a>
		</div>
	</div>
</section>

<!-- ============================================ CTA -->
<section class="qb-bg-accent" style="padding-block: clamp(3.5rem, 7vw, 5rem);">
	<div class="container">
		<div class="row align-items-center g-4">
			<div class="col-lg-8">
				<h2 class="qb-display mb-2" style="font-size: clamp(2rem, 4vw, 3rem);">Train with us in person.</h2>
				<p class="mb-0" style="color: rgba(255,255,255,.92); max-width: 540px;">Camps sell out fast. Reserve your spot now &mdash; or join the waitlist and we'll text you when a new date opens.</p>
			</div>
			<div class="col-lg-4 text-lg-end">
				<a href="#camps" class="btn btn-qb btn-qb-dark me-2">Register</a>
				<a href="#" class="btn btn-qb" style="background:#fff; color: var(--qb-accent);">Join Waitlist</a>
			</div>
		</div>
	</div>
</section>

</div><!-- /.qb-camp -->

<script>
	// Cosmetic filter chip toggle (visual only — wire to real filtering later)
	(function () {
		var filters = document.querySelectorAll('.qb-camp .cp-filter');
		filters.forEach(function (el) {
			el.addEventListener('click', function () {
				filters.forEach(function (f) { f.classList.remove('active'); });
				el.classList.add('active');
			});
		});
	})();
</script>

<?php get_footer(); ?>

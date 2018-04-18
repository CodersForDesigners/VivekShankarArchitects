<?php 
	/*
	 *
	 *	# Home Page
	 *
	 */
?>

<!-- Landing Section -->
<section id="landing" class="landing-section fill-teal gradient-blue-green block-space-bottom section js_section">
	<div class="slick-landing">
		<div class="slide">
			<img class="block" src="http://via.placeholder.com/1920x1080?text=1">
		</div>
		<div class="slide">
			<img class="block" src="http://via.placeholder.com/1920x1080?text=2">
		</div>
		<div class="slide">
			<img class="block" src="http://via.placeholder.com/1920x1080?text=3">
		</div>
	</div>
</section><!-- END : Landing Section -->
<script type="text/javascript">
$(document).ready(function(){

	/*
	 *	Slick Home Landing
	 */

	$('.slick-landing').slick({
		dots: true,
		arrows: true,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		adaptiveHeight: true,
		autoplay: true,
		autoplaySpeed: 5000,
		responsive: [
		{
			breakpoint: 800,
			settings: {
				arrows: false
			}
		} ]
	});

});
</script>

<!-- Project Listing Section -->
<section id="projects-list" class="project-listing-section fill-neutral section js_section">
	<div class="project-type" tabindex="-1">
		<div class="title h3 strong text-uppercase">Residential</div>
		<div class="heading label">Apartments, Villas, Row Houses</div>
	</div>
	<div class="project-type" tabindex="-1">
		<div class="title h3 strong text-uppercase">Industrial</div>
		<div class="heading label">Factories</div>
	</div>
	<div class="project-type" tabindex="-1">
		<div class="title h3 strong text-uppercase">Commercial</div>
		<div class="heading label">Retail, Office Buildings, Mall</div>
	</div>
	<div class="project-type" tabindex="-1">
		<div class="title h3 strong text-uppercase">Institutions</div>
		<div class="heading label">Schools, Colleges</div>
	</div>
	<div class="project-type" tabindex="-1">
		<div class="title h3 strong text-uppercase">Hospitality</div>
		<div class="heading label">Restaurants, Hotels</div>
	</div>
	<div class="project-type" tabindex="-1">
		<div class="title h3 strong text-uppercase">Homes</div>
		<div class="heading label">Custom Villas, Interiors</div>
	</div>
	<div class="project-type" tabindex="-1">
		<div class="title h3 strong text-uppercase">Conceptual</div>
		<div class="heading label">Unbuilt Projects</div>
	</div>
</section><!-- END : Project Listing Section -->




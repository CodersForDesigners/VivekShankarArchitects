<?php 
	/*
	 *
	 *	# Project Template
	 *
	 */
?>

<!-- Landing Section -->
<section id="landing" class="landing-section fill-teal gradient-blue-green section js_section">
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

<!-- Intro Section -->
<section id="intro" class="intro-section block-space-top-bottom section js_section">
	<div class="container">
		<div class="row">
			<div class="columns small-10 small-offset-1">
				<div class="typology h1 strong text-uppercase">Industrial</div>
				<div class="name h4 strong">Buhler — Phoenix Factory</div>
			</div>
			<div class="meta columns small-4 small-offset-1 medium-2">
				<div class="label text-neutral">Place</div>
				<div class="p">Bangalore</div>

				<div class="label text-neutral">Year</div>
				<div class="p">2011</div>

				<div class="label text-neutral">Area</div>
				<div class="p">90,000 sq.ft.</div>
			</div>
			<div class="meta columns small-5 small-offset-1 medium-3 large-2 large-offset-0">
				<div class="label text-neutral">Structural Engineer</div>
				<div class="p">Adams Kara Taylor</div>

				<div class="label text-neutral">M+E Engineer</div>
				<div class="p">PHA Consult</div>

				<div class="label text-neutral">Landscape Architect</div>
				<div class="p">Gillespies</div>

				<div class="label text-neutral">Lighting Engineer</div>
				<div class="p">Claude Engle</div>
			</div>
			<div class="description p columns small-10 small-offset-1 medium-7 large-4">
				The factory has two levels of manufacturing and had to meet all the technical norms of an industrial building. A long canopy on its’ west side connects the new facility with the old one and aesthetically breaks away from the usual canopies seen in industrial facilities.
			</div>
			<div class="quick-links columns small-10 small-offset-1 medium-2 large-1">
				<a class="button-link" tabindex="-1" href="#benefits">Benefits</a>
				<a class="button-link" tabindex="-1" href="#showcase">Showcase</a>
				<a class="button-link" tabindex="-1" href="#fact-file">Fact File</a>
			</div>
		</div>
	</div>
</section><!-- END : Intro Section -->

<!-- Benefits Section -->
<section id="benefits" class="benefits-section gradient-band section js_section">
	<div class="inner-section fill-light block-space-top-bottom">
		<div class="container">
			<div class="row">
				<div class="title h2 strong text-uppercase columns small-10 small-offset-1">
					<span>Benefits</span>
					<span class="underline fill-teal"></span>
				</div>
			</div>
			<div class="point row">
				<div class="heading h4 strong columns small-10 small-offset-1 large-4">
					Optimal Capital Cost
				</div>
				<div class="description p columns small-10 small-offset-1 large-5">
					<span class="block">Build of spaces to optimize cost of Construction</span>
					<span class="block">Ensure future expansion plans at low cost in a modular fashion</span>
					<span class="block">Optimum current and future use of land parcel</span>
					<span class="block">Use of right material</span>
					<span class="block">Material appropriate for climatic conditions and industry type.</span>
				</div>
			</div>
			<div class="point row">
				<div class="heading h4 strong columns small-10 small-offset-1 large-4">
					Running Cost Savings
				</div>
				<div class="description p columns small-10 small-offset-1 large-5">
					<span class="block">Minimize losses of services (steam, refrigeration, compressed air)</span>
					<span class="block">Minimum wastage and handling costs</span>
					<span class="block">Optimum manpower movement</span>
					<span class="block">Energy efficiency</span>
				</div>
			</div>
			<div class="point row">
				<div class="heading h4 strong columns small-10 small-offset-1 large-4">
					Balancing Function and Aesthetics
				</div>
				<div class="description p columns small-10 small-offset-1 large-5">
					<span class="block">Specific industry requirements (Food Safety, Chemical Industry)</span>
					<span class="block">Manufacturing efficiency</span>
					<span class="block">Maintenance efficiency</span>
					<span class="block">Cleaning efficiency, avoid pest infestation</span>
				</div>
			</div>
			<div class="point row">
				<div class="heading h4 strong columns small-10 small-offset-1 large-4">
					Health & Safety
				</div>
				<div class="description p columns small-10 small-offset-1 large-5">
					<span class="block">Safe work environment</span>
					<span class="block">Ensure emergency exits</span>
					<span class="block">Regulatory compliance</span>
					<span class="block">Protect workers from potential hazards such as falling objects, harmful chemicals and loud noise levels</span>
					<span class="block">Take utmost care of the safety of workers on the shop floor taking industrial ergonomics into consideration</span>
					<span class="block">Prevent the factory from becoming a heat island from inside</span>
					<span class="block">Safe evacuation in an emergency</span>
					<span class="block">Prevent occupational hazards</span>
				</div>
			</div>
			<div class="point row">
				<div class="heading h4 strong columns small-10 small-offset-1 large-4">
					Lighting & Ventilation
				</div>
				<div class="description p columns small-10 small-offset-1 large-5">
					<span class="block">Natural Ventilation</span>
					<span class="block">Natural lighting</span>
					<span class="block">Optimum working environment</span>
					<span class="block">Reduce heat accumulation in production areas</span>
				</div>
			</div>
			<div class="point row">
				<div class="heading h4 strong columns small-10 small-offset-1 large-4">
					Optimised People / Vehicle Flow
				</div>
				<div class="description p columns small-10 small-offset-1 large-5">
					<span class="block">Smooth flow of raw material and finished products</span>
					<span class="block">Avoid vehicle congestions</span>
					<span class="block">Ensure access to authorized people</span>
				</div>
			</div>
			<div class="point row">
				<div class="heading h4 strong columns small-10 small-offset-1 large-4">
					Material Flow
				</div>
				<div class="description p columns small-10 small-offset-1 large-5">
					<span class="block">Raw Material flow</span>
					<span class="block">Finished product flow</span>
					<span class="block">Avoid cross flow of men and material</span>
					<span class="block">Ensure flow clean to dirty ( can we have a more elegant word)</span>
					<span class="block">Arrangement  of equipment decks adapted to the task and the conditions of the operating environment</span>
					<span class="block">Floor space planned efficiently for expeditious movement of raw materials, processing and finished goods</span>
					<span class="block">Walkways designed for parts to be delivered at convenient distances for assembly and minimal redundant spaces</span>
					<span class="block">Enabling continuous flow of people and materials through the assembly line on the shop floor</span>
					<span class="block">Restriction on flow of men and material as required by the industry ( example: Food industry – no movement from dirty area to clean area)</span>
					<span class="block">Preventing stock pile up and enabling just-in-time operations</span>
					<span class="block">Efficiency in loading / unloading and material flow</span>
				</div>
			</div>
			<div class="point row">
				<div class="heading h4 strong columns small-10 small-offset-1 large-4">
					Construction Speed
				</div>
				<div class="description p columns small-10 small-offset-1 large-5">
					<span class="block">Facilitate construction scheduling to ensure construction and installation of equipment in shortest time</span>
					<span class="block">Plan for equipment movement in construction</span>
					<span class="block">Design considering needs for installation and or change of equipment’s.</span>
					<span class="block">Fastest time to Production.</span>
					<span class="block">Assist the client in designing the layout</span>
				</div>
			</div>
			<div class="point row">
				<div class="heading h4 strong columns small-10 small-offset-1 large-4">
					Brand Image
				</div>
				<div class="description p columns small-10 small-offset-1 large-5">
					<span class="block">Project to conform to the ethos of the Brand</span>
					<span class="block">Facilitate design to enable factory visit of partners and consumers without disrupting the operations.</span>
					<span class="block">Ensure public visibility of only clean areas</span>
					<span class="block">Providing an inspiring environment to employees</span>
				</div>
			</div>
		</div>
	</div>
</section><!-- END : Benefits Section -->

<!-- Showcase Section -->
<section id="showcase" class="showcase-section block-space-top-bottom section js_section">
	<div class="container">
		<div class="row">
			<div class="title h2 strong text-uppercase columns small-10 small-offset-1">
				<span>Showcase</span>
				<span class="underline fill-light"></span>
			</div>
		</div>
		<div class="row">
			<div class="tabs columns small-10 small-offset-1">
				<a class="tab active button-link" tabindex="-1" href="#">Finished<span class="hide-for-mobile"> Project</span></a>
				<a class="tab button-link" tabindex="-1" href="#">3D Renders</a>
				<a class="tab button-link" tabindex="-1" href="#">Concept<span class="hide-for-mobile"> Drawings</span></a>
			</div>
		</div>
		<div class="row">
			<div class="showcase-masonry">
				<div class="showcase-item columns small-6 medium-4 xlarge-3"><img src="http://via.placeholder.com/650x500"></div>
				<div class="showcase-item columns small-6 medium-4 xlarge-3"><img src="http://via.placeholder.com/650x500"></div>
				<div class="showcase-item columns small-6 medium-4 xlarge-3"><img src="http://via.placeholder.com/650x500"></div>
				<div class="showcase-item columns small-6 medium-4 xlarge-3"><img src="http://via.placeholder.com/650x500"></div>
				<div class="showcase-item columns small-6 medium-4 xlarge-3"><img src="http://via.placeholder.com/650x500"></div>
				<div class="showcase-item columns small-6 medium-4 xlarge-3"><img src="http://via.placeholder.com/650x500"></div>
				<div class="showcase-item columns small-6 medium-4 xlarge-3"><img src="http://via.placeholder.com/650x500"></div>
				<div class="showcase-item columns small-6 medium-4 xlarge-3"><img src="http://via.placeholder.com/650x500"></div>
				<div class="showcase-item columns small-6 medium-4 xlarge-3"><img src="http://via.placeholder.com/650x500"></div>
			</div>
		</div>
	</div>
</section><!-- END : Showcase Section -->
<script type="text/javascript">
$(document).ready(function(){

	/*
	 *	Masonry Showcase
	 */

	$('.showcase-masonry').masonry();
});
</script>

<!-- Facts Section -->
<section id="fact-file" class="facts-section fill-light block-space-top-bottom section js_section">
	<div class="container">
		<div class="row">
			<div class="title h2 strong text-uppercase columns small-10 small-offset-1">
				<span>Fact File</span>
				<span class="underline fill-teal"></span>
			</div>
		</div>
		<div class="point row">
			<div class="heading h4 strong columns small-10 small-offset-1 large-4">
				Design Brief
			</div>
			<div class="description columns small-10 small-offset-1 large-5">
				<div class="p">A contemporary design which offers privacy to the inside and at the same time opens up to the outside with ample natural light. Maximum natural ventilation to ensure enhanced indoor air quality for employees.Roof top ventilator for cool air circulation and hot air exhaust.</div>
				<div class="p strong">Benefit : Maximum savings on running cost; profitable returns on the capital invested.</div>
			</div>
		</div>
		<div class="point row">
			<div class="heading h4 strong columns small-10 small-offset-1 large-4">
				Design Intervention
			</div>
			<div class="description columns small-10 small-offset-1 large-5">
				<div class="p">Proposed a structural column grid that enabled efficient space utilization.</div>
				<div class="p">Extended canopy connecting the new facility to the old became the primary design feature on the exterior.</div>
				<div class="p">The structural grid and the steel staircases became the primary design elements on the inside of the factory.</div>
			</div>
		</div>
		<div class="point row">
			<div class="heading h4 strong columns small-10 small-offset-1 large-4">
				Budget
			</div>
			<div class="description columns small-10 small-offset-1 large-5">
				<div class="p">₹ 110,000,000 INR</div>
			</div>
		</div>
	</div>
</section><!-- END : Facts Section -->

<!-- Other Project Section -->
<section id="other-projects" class="other-project-section fill-light section js_section">
	<div class="container">
		<div class="row">
			<div class="title h3 text-uppercase text-center text-teal columns small-10 small-offset-1">
				Other &lt;Industrial&gt; Projects
			</div>
		</div>
	</div>
	<div class="other-project-list fill-neutral">
		<div class="other-project" tabindex="-1">
			<div class="name h3 strong text-uppercase">Halcyon Complex</div>
			<div class="place label">Bangalore</div>
		</div>
		<div class="other-project" tabindex="-1">
			<div class="name h3 strong text-uppercase">Smartome</div>
			<div class="place label">Mumbai</div>
		</div>
		<div class="other-project" tabindex="-1">
			<div class="name h3 strong text-uppercase">Rajharhat Mall</div>
			<div class="place label">Kolkata</div>
		</div>
		<div class="other-project" tabindex="-1">
			<div class="name h3 strong text-uppercase">Golden Gate Bridge</div>
			<div class="place label">San Francisco</div>
		</div>
	</div>
</section><!-- END : Other Projects Section -->

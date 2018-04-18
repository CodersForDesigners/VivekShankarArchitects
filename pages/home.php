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
	<?php foreach ( $projectsByType as $type => $projects ) : ?>
		<?php
			$firstProjectImage = $projects[ 0 ][ 'featured images' ][ 0 ];
			$imageURL = 'media/projects/' . $firstProjectImage[ 'id' ] . '.' . explode( '/', $firstProjectImage[ 'mimeType' ] )[ 1 ];
		?>
		<div class="project-type" tabindex="-1">
			<div class="title h3 strong text-uppercase"><?php echo $type ?></div>
			<div class="heading label"><?php echo $projects[ 0 ][ 'type description' ] ?></div>
			<div class="image" style="background-image: url( '<?php echo $imageURL ?>' )"></div>
		</div>
	<?php endforeach; ?>
</section><!-- END : Project Listing Section -->

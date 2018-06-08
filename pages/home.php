<?php
	/*
	 *
	 *	# Home Page
	 *
	 */
?>

<?php
function viewMarkup () {

	global $settings;
	global $serverBaseUrl;
	global $baseImageUrl;
	global $mimeToFileExtensions;
	global $projectsByTypology;

?>

<!-- Landing Section -->
<?php if ( ! empty( $settings[ 'Home Featured Images' ] ) ) : ?>
<section id="landing" class="landing-section fill-teal gradient-blue-green section js_section">
	<div class="slick-landing">
		<?php foreach ( $settings[ 'Home Featured Images' ] as $image ) : ?>
			<?php
				// $imageURL = $serverBaseUrl . 'media/settings/' . $image[ 'id' ] . $mimeToFileExtensions[ $image[ 'mimeType' ] ];
			?>
			<?php
				$imageURL_XL = $baseImageUrl . ',w_1600/settings/' . $image[ 'id' ];
				$imageURL_L = $baseImageUrl . ',w_1200/settings/' . $image[ 'id' ];
				$imageURL_M = $baseImageUrl . ',w_800/settings/' . $image[ 'id' ];
				$imageURL_S = $baseImageUrl . ',w_400/settings/' . $image[ 'id' ];
			?>
			<!-- <div class="slide">
				<img class="block" src="<?php echo $imageURL ?>">
			</div> -->
			<picture class="slide" style="display: inline">
				<source class="block" srcset="<?php echo $imageURL_XL ?>" media="(min-width: 1380px)">
				<source class="block" srcset="<?php echo $imageURL_L ?>" media="(min-width: 1040px)">
				<source class="block" srcset="<?php echo $imageURL_M ?>" media="(min-width: 640px)">
				<img class="block" srcset="<?php echo $imageURL_S ?>">
			</picture>
		<?php endforeach; ?>
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
<?php endif; ?>

<!-- Project Listing Section -->
<section id="projects-list" class="project-listing-section fill-neutral section js_section">
	<?php foreach ( $projectsByTypology as $type => $projects ) : ?>
		<?php
			$firstProject = $projects[ 0 ];
			$firstProjectImage = $firstProject[ 'Featured Image' ][ 0 ];
			// $imageURL = $baseImageUrl . $firstProjectImage[ 'id' ] . $mimeToFileExtensions[ $firstProjectImage[ 'mimeType' ] ];
			$imageURL = $baseImageUrl . ',w_800/projects/' . $firstProjectImage[ 'id' ];
		?>
		<a class="project-type text-light" tabindex="-1" href="project/<?php echo $firstProject[ 'ID' ] ?>">
			<div class="title h3 strong text-uppercase"><?php echo $type ?></div>
			<div class="heading label"><?php echo $projects[ 0 ][ 'Type Description' ] ?></div>
			<div class="image" style="background-image: url( '<?php echo $imageURL ?>' )"></div>
		</a>
	<?php endforeach; ?>
</section><!-- END : Project Listing Section -->









<?php
}

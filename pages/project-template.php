<?php
	/*
	 *
	 *	# Project Template
	 *
	 */

	$projectName = $_REQUEST[ '_project' ];
	$project = getProjectBySlug( $projectName );
	$projectTypology = getTypologyByName( $project[ 'Typology' ] );

	// Page Title
	if ( $viewName == 'project-template' ) {
		$pageTitle .= ' | ' . $project[ 'Name' ];
	}

	// Other projects from the same type
	$otherProjectsOfTheType = array_filter( $projectsByTypology[ $project[ 'Typology' ] ], function ( $currentProject ) use ( $project ) {
		return $currentProject[ 'name' ] != $project[ 'Name' ];
	} );

	$factFileIsEmpty = false;
	$showcaseIsEmpty = false;
	if ( empty( $project[ 'Design Brief' ] ) && empty( $project[ 'Budget' ] ) && empty( $project[ 'Design Intervention' ] ) ) {
		$factFileIsEmpty = true;
	}
	if ( empty( $project[ 'Finished Project' ] ) && empty( $project[ '3D Renders' ] ) && empty( $project[ 'Concept Drawings' ] ) ) {
		$showcaseIsEmpty = true;
	}

	// Break down the "Consultants" field to a convenient data structure
	if ( ! empty( $project[ 'Consultants' ] ) ) {
		$consultants = array_chunk( preg_split( '/\s*(<br>)+\s*/', $project[ 'Consultants' ] ), 2 );
	}
	else {
		$consultants = [ ];
	}

?>

<?php
function viewMarkup () {

	global $mimeToFileExtensions;
	global $project;
	global $projectTypology;
	global $baseImageUrl;
	global $otherProjectsOfTheType;
	global $showcaseIsEmpty;
	global $factFileIsEmpty;
	global $consultants;

?>









<!-- Landing Section -->
<section id="landing" class="landing-section fill-teal gradient-blue-green section js_section">
	<div class="slick-landing">
		<?php foreach ( $project[ 'Featured Image' ] as $image ) : ?>
			<?php
				$imageURL_XL = $baseImageUrl . ',w_1600/projects/' . $image[ 'id' ];
				$imageURL_L = $baseImageUrl . ',w_1200/projects/' . $image[ 'id' ];
				$imageURL_M = $baseImageUrl . ',w_800/projects/' . $image[ 'id' ];
				$imageURL_S = $baseImageUrl . ',w_400/projects/' . $image[ 'id' ];
			?>
			<!-- <div class="slide"> -->
				<!-- <img class="block" src="<?php // echo $baseImageUrl . $image[ 'id' ] . $mimeToFileExtensions[ $image[ 'mimeType' ] ] ?>"> -->
			<!-- </div> -->
			<picture class="slide">
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

<!-- Intro Section -->
<section id="intro" class="intro-section block-space-top-bottom section js_section">
	<div class="container">
		<div class="row">
			<div class="columns small-10 small-offset-1">
				<div class="typology h1 strong text-uppercase"><?php echo $project[ 'Typology' ] ?></div>
				<div class="name h4 strong"><?php echo $project[ 'Name' ] ?></div>
			</div>
			<div class="meta columns small-4 small-offset-1 medium-2">
				<?php if ( ! empty( $project[ 'Location' ] ) ) : ?>
					<div class="label text-neutral">Location</div>
					<div class="p"><?php echo $project[ 'Location' ] ?></div>
				<?php endif; ?>

				<?php if ( ! empty( $project[ 'Year' ] ) ) : ?>
					<div class="label text-neutral">Year</div>
					<div class="p"><?php echo $project[ 'Year' ] ?></div>
				<?php endif; ?>

				<?php if ( ! empty( $project[ 'Area' ] ) ) : ?>
					<div class="label text-neutral">Area</div>
					<div class="p"><?php echo $project[ 'Area' ] ?></div>
				<?php endif; ?>
			</div>
			<div class="meta columns small-5 small-offset-1 medium-3 large-2 large-offset-0">
				<?php foreach ( $consultants as $consultant ) : ?>
					<div class="label text-neutral"><?php echo $consultant[ 0 ] ?></div>
					<div class="p"><?php echo $consultant[ 1 ] ?></div>
				<?php endforeach; ?>
			</div>
			<?php if ( ! empty( $project[ 'Description' ] ) ) : ?>
			<div class="description p columns small-10 small-offset-1 medium-7 large-4">
				<?php echo $project[ 'Description' ] ?>
			</div>
			<?php endif; ?>
			<div class="quick-links columns small-10 small-offset-1 medium-2 large-1">
				<?php if ( ! empty( $projectTypology[ 'Benefits' ] ) ) : ?>
					<a class="button-link" tabindex="-1" href="#benefits">Benefits</a>
				<?php endif; ?>
				<?php if ( ! $showcaseIsEmpty ) : ?>
					<a class="button-link" tabindex="-1" href="#showcase">Showcase</a>
				<?php endif; ?>
				<?php if ( ! $factFileIsEmpty ) : ?>
					<a class="button-link" tabindex="-1" href="#fact-file">Fact File</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section><!-- END : Intro Section -->

<!-- Benefits Section -->
<?php if ( ! empty( $projectTypology[ 'Benefits' ] ) ) : ?>
<section id="benefits" class="benefits-section gradient-band section js_section">
	<div class="inner-section fill-light block-space-top-bottom">
		<div class="container">
			<div class="row">
				<div class="title h2 strong text-uppercase columns small-10 small-offset-1">
					<span>Benefits</span>
					<span class="underline fill-teal"></span>
				</div>
			</div>
			<?php foreach ( $projectTypology[ 'Benefits' ] as $benefit ) : ?>
				<div class="point row">
					<div class="heading h4 strong columns small-10 small-offset-1 large-4">
						<?php echo $benefit[ 'Title' ] ?>
					</div>
					<div class="description p columns small-10 small-offset-1 large-5">
						<?php echo $benefit[ 'Description' ] ?>
					</div>
				</div>
			<?php endforeach; ?>
			<!-- <div class="point row">
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
			</div> -->
		</div>
	</div>
</section><!-- END : Benefits Section -->
<?php endif; ?>

<!-- Showcase Section -->
<?php if ( ! $showcaseIsEmpty ) : ?>
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
				<?php if ( ! empty( $project[ 'Finished Project' ] ) ) : ?>
					<div class="tab button-link js_gallery_btn" tabindex="-1" data-link="Finished Project">Finished<span class="hide-for-mobile"> Project</span></div>
				<?php endif; ?>
				<?php if ( ! empty( $project[ '3D Renders' ] ) ) : ?>
					<div class="tab button-link js_gallery_btn" tabindex="-1" data-link="3D Renders">3D Renders</div>
				<?php endif; ?>
				<?php if ( ! empty( $project[ 'Concept Drawings' ] ) ) : ?>
					<div class="tab button-link js_gallery_btn" tabindex="-1" data-link="Concept Drawings">Concept<span class="hide-for-mobile"> Drawings</span></div>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<?php if ( ! empty( $project[ 'Finished Project' ] ) ) : ?>
				<div class="showcase-masonry hidden js_showcase_masonry" data-gallery="Finished Project">
					<?php foreach ( $project[ 'Finished Project' ] as $image ) : ?>
						<!-- <div class="showcase-item columns small-6 medium-4 xlarge-3"><img src="<?php //echo $baseImageUrl . $image[ 'id' ] . $mimeToFileExtensions[ $image[ 'mimeType' ] ] ?>"></div> -->
						<?php
							$imageURL_M = $baseImageUrl . ',w_800/projects/' . $image[ 'id' ];
							$imageURL_S = $baseImageUrl . ',w_400/projects/' . $image[ 'id' ];
						?>
						<div class="showcase-item columns small-6 medium-4 xlarge-3 js_showcase_item"><div class="slide js_modal_trigger" data-mod-id="slick-gallery">
							<!-- <source class="block" srcset="<?php //echo $imageURL_M ?>" media="(min-width: 640px)"> -->
							<img class="block" src="<?php echo $imageURL_S ?>">
						</div></div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $project[ '3D Renders' ] ) ) : ?>
				<div class="showcase-masonry hidden js_showcase_masonry" data-gallery="3D Renders">
					<?php foreach ( $project[ '3D Renders' ] as $image ) : ?>
						<!-- <div class="showcase-item columns small-6 medium-4 xlarge-3"><img src="<?php //echo $baseImageUrl . $image[ 'id' ] . $mimeToFileExtensions[ $image[ 'mimeType' ] ] ?>"></div> -->
						<?php
							$imageURL_M = $baseImageUrl . ',w_800/projects/' . $image[ 'id' ];
							$imageURL_S = $baseImageUrl . ',w_400/projects/' . $image[ 'id' ];
						?>
						<div class="showcase-item columns small-6 medium-4 xlarge-3"><div class="slide js_modal_trigger" data-mod-id="slick-gallery">
							<!-- <source class="block" srcset="<?php //echo $imageURL_M ?>" media="(min-width: 640px)"> -->
							<img class="block" src="<?php echo $imageURL_S ?>">
						</div></div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $project[ 'Concept Drawings' ] ) ) : ?>
				<div class="showcase-masonry hidden js_showcase_masonry" data-gallery="Concept Drawings">
					<?php foreach ( $project[ 'Concept Drawings' ] as $image ) : ?>
						<!-- <div class="showcase-item columns small-6 medium-4 xlarge-3"><img src="<?php //echo $baseImageUrl . $image[ 'id' ] . $mimeToFileExtensions[ $image[ 'mimeType' ] ] ?>"></div> -->
						<?php
							$imageURL_M = $baseImageUrl . ',w_800/projects/' . $image[ 'id' ];
							$imageURL_S = $baseImageUrl . ',w_400/projects/' . $image[ 'id' ];
						?>
						<div class="showcase-item columns small-6 medium-4 xlarge-3"><div class="slide js_modal_trigger" data-mod-id="slick-gallery">
							<!-- <source class="block" srcset="<?php //echo $imageURL_M ?>" media="(min-width: 640px)"> -->
							<img class="block" src="<?php echo $imageURL_S ?>">
						</div></div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section><!-- END : Showcase Section -->
<script type="text/javascript">

	$( document ).ready( function () {

		/*
		 *	Masonry Showcase
		 */

		$( ".js_gallery_btn" ).first().addClass( "active" );
		var $masonryLayout = $( ".js_showcase_masonry" ).first().masonry();
		// Have Masonry continually layout images as they load
		$masonryLayout.imagesLoaded().progress( function () {
			$masonryLayout.masonry( "layout" );
		} );
		// Show the first tab
		$( ".js_showcase_masonry" ).first().removeClass( "hidden" );

		$( document ).on( "click", ".js_gallery_btn", function ( event ) {

			event.preventDefault();

			var $button = $( event.target ).closest( ".js_gallery_btn" );

			// Mark the selected button
			$( ".js_gallery_btn" ).removeClass( "active" );
			$button.addClass( "active" );

			// Show the corresponding gallery
			var gallery = $button.data( "link" );
			$( ".js_showcase_masonry" ).addClass( "hidden" );

			var $gallery = $( "[ data-gallery = \"" + gallery + "\" ]" );
			// Un-hide the selected gallery
			$gallery.removeClass( "hidden" );
			// Have Masonry layout the gallery
			var $masonryLayout = $gallery.masonry();
			// Have Masonry continually layout images as they load
			$masonryLayout.imagesLoaded().progress( function () {
				$masonryLayout.masonry( "layout" );
			} );

		} )

	} );

	// When an image on the galleries in the "Showcase" section is hit,
	// 	open the gallery in a lightbox
	window.__MODALS[ "slick-gallery" ] = function ( modId, event ) {

		// Clone the image markup
		var $galleryImages = $( event.target ).closest( ".js_showcase_masonry" ).find( "img" );
		var $newGalleryImages = Array.prototype.slice.call( $galleryImages ).map( function ( el ) {
			var $el = $( el );
			var src = $el.attr( "src" );
			// Change the image sources to higher-res versions
			var newSrc = src.replace( "w_400", "w_800" );
			return "<div class='slide' style='background-image: url( \"" + newSrc +
			"\" )'></div>";
		} );
		// Re-order the images so that the one clicked on is the first.
		// 	This is so that that image loads first.
		var slideIndex = $galleryImages.index( $( event.target ).closest( "img" ) );
		$newGalleryImages = $newGalleryImages.slice( slideIndex ).concat( $newGalleryImages.slice( 0, slideIndex ) );

		// Empty the modal box of the previous gallery's content
		var $modalBox = $( ".js_modal_box_content.js_active" );
		$newGalleryImages = "<div class='slick-landing'>" + $newGalleryImages.join( "" ) + "</div>";
		$modalBox.html( $newGalleryImages );
		var $galleryContainer = $modalBox.children().first();
		// Initialize Slick
		$galleryContainer.slick( {
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
				}
			]
		} );

	};

</script>
<?php endif; ?>

<!-- Facts Section -->
<?php if ( ! $factFileIsEmpty ) : ?>
<section id="fact-file" class="facts-section fill-light block-space-top-bottom section js_section">
	<div class="container">
		<div class="row">
			<div class="title h2 strong text-uppercase columns small-10 small-offset-1">
				<span>Fact File</span>
				<span class="underline fill-teal"></span>
			</div>
		</div>
		<?php if ( ! empty( $project[ 'Design Brief' ] ) ) : ?>
		<div class="point row">
			<div class="heading h4 strong columns small-10 small-offset-1 large-4">
				Design Brief
			</div>
			<div class="description columns small-10 small-offset-1 large-5">
				<div class="p"><?php echo $project[ 'Design Brief' ] ?></div>
			</div>
		</div>
		<?php endif; ?>
		<?php if ( ! empty( $project[ 'Budget' ] ) ) : ?>
		<div class="point row">
			<div class="heading h4 strong columns small-10 small-offset-1 large-4">
				Budget
			</div>
			<div class="description columns small-10 small-offset-1 large-5">
				<div class="p"><?php echo $project[ 'Budget' ] ?></div>
			</div>
		</div>
		<?php endif; ?>
		<?php if ( ! empty( $project[ 'Design Intervention' ] ) ) : ?>
		<div class="point row">
			<div class="heading h4 strong columns small-10 small-offset-1 large-4">
				Design Intervention
			</div>
			<div class="description columns small-10 small-offset-1 large-5">
				<div class="p"><?php echo $project[ 'Design Intervention' ] ?></div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section><!-- END : Facts Section -->
<?php endif; ?>

<!-- Other Project Section -->
<?php if ( ! empty( $otherProjectsOfTheType ) ) : ?>
<section id="other-projects" class="other-project-section fill-light section js_section">
	<div class="container">
		<div class="row">
			<div class="title h3 text-uppercase text-center text-teal columns small-10 small-offset-1">
				Other <?php echo $project[ 'Typology' ] ?> Projects
			</div>
		</div>
	</div>
	<div class="other-project-list fill-neutral">
		<?php foreach ( $otherProjectsOfTheType as $project ) : ?>
			<a href="/project/<?php echo $project[ 'ID' ] ?>" class="other-project block text-light fill-black" tabindex="-1">
				<div class="name h3 strong text-uppercase"><?php echo $project[ 'name' ] ?></div>
				<div class="place label"><?php echo $project[ 'Location' ] ?></div>
				<!-- <div class="image" style="background-image: url( '<?php //echo $baseImageUrl . $project[ 'Featured Image' ][ 0 ][ 'id' ] . $mimeToFileExtensions[ $project[ 'Featured Image' ][ 0 ][ 'mimeType' ] ] ?>' )"></div> -->
				<div class="image" style="background-image: url( '<?php echo $baseImageUrl . ',w_800/projects/' . $project[ 'Featured Image' ][ 0 ][ 'id' ] ?>' )"></div>
			</a>
		<?php endforeach; ?>
	</div>
</section><!-- END : Other Projects Section -->
<?php endif; ?>









<?php
}

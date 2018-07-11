<?php

	// :: ONLY DURING DEVELOPMENT ::
	// debugging
	ini_set( "display_errors", "On" );
	ini_set( "error_reporting", E_ALL );

	/*
	 * -/-/-/-/
	 * Database
	 * -/-/-/-/
	 */
	require_once __DIR__ . '/inc/db.php';
	require_once __DIR__ . '/inc/db/settings.php';
	require_once __DIR__ . '/inc/db/typologies.php';
	require_once __DIR__ . '/inc/db/projects.php';

	/*
	 * Versioning Assets to invalidate the browser cache
	 */
	$ver = '?v=20180719';

	// get info on the request
	// $view = require "server/pageless.php";
	// $viewName = $view[ 0 ];
	// $viewPath = $view[ 1 ];
	$viewName = $_REQUEST[ '_view' ];

	// included external php files with functions.
	require ('inc/head.php');
	require ('inc/lazaro.php'); /* -- Lazaro disclaimer and footer -- */

	// Helper values
	$mimeToFileExtensions = [
		'image/jpeg' => '.jpeg',
		'image/png' => '.png'
	];
	$serverBaseUrl = 'http://' . $_SERVER[ 'HTTP_HOST' ] . '/';
	// $baseImageUrl = $serverBaseUrl . 'media/projects/';
	$baseImageUrl = 'https://res.cloudinary.com/vsa/image/upload/f_auto';

	// Get settings
	$settings = getSettings();
	// Get projects by type
	$projectsByTypology = getProjectsByTypology();

	// Page Title
	$pageTitle = 'Vivek Shankar Architects';

	// Pull the view-specific code
	require __DIR__ . '/pages/' . $viewName . '.php';

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
	prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml">

<head>


	<!-- Nothing Above This -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Page Title | Page Name -->
	<title><?php echo $pageTitle ?></title>

	<?php echo gethead(); ?>

</head>

<body id="body" class="body">

<!--  ★  MARKUP GOES HERE  ★  -->

<div id="page-wrapper" class="fill-off-dark" data-page="<?php echo $viewName ?>"><!-- Page Wrapper -->

	<!-- Header Section -->
	<section id="header" class="header-section fill-off-dark section js_section">
		<div class="container">
			<div class="header row">
				<div class="columns small-5 small-offset-1 medium-offset-0 large-3">
					<a class="logo" href="/">
						<img class="show-for-mobile block" src="/media/logo-vsa-medium-dark.svg<?php echo $ver ?>">
						<img class="hide-for-mobile block" src="/media/logo-vsa-large-dark.svg<?php echo $ver ?>">
					</a>
				</div>
				<!-- <div class="text-right columns small-9">
					<div class="navigation inline">
						<a class="button js_nav_button <?php /*echo ( $viewName == "home" ? "active" : "" )*/ ?>" data-page-id="home" href="/home">home</a>
						<a class="button js_nav_button <?php /*echo ( $viewName == "project" ? "active" : "" )*/ ?>" data-page-id="project" href="/project">project</a>
						<a class="button js_nav_button <?php /*echo ( $viewName == "pageone" ? "active" : "" )*/ ?>" data-page-id="pageone" href="/pageone">page-1</a>
						<a class="button js_nav_button <?php /*echo ( $viewName == "pagetwo" ? "active" : "" )*/ ?>" data-page-id="pagetwo" href="/pagetwo">page-2</a>
						<a class="button js_nav_button <?php /*echo ( $viewName == "contact" ? "active" : "" )*/ ?>" data-page-id="contact" href="/contact">contact</a>
					</div>
				</div> -->
			</div>
		</div>
	</section> <!-- END : Header Section -->


	<!-- Page Content -->
	<div id="page-content">

		<?php // require __DIR__ . '/pages/' . $viewName . '.php'; ?>
		<?php viewMarkup(); ?>

	</div> <!-- END : Page Content -->


	<!-- Practice Section -->
	<section id="practice" class="practice-section block-space-top-bottom section js_section">
		<div class="container">
			<div class="row">
				<div class="title h1 strong text-uppercase columns small-10 small-offset-1">
					The Practice
				</div>
				<div class="meta columns small-10 small-offset-1 large-2">
					<div class="label text-neutral">Est.</div>
					<div class="p">2004</div>
				</div>
				<div class="description columns small-10 small-offset-1 medium-7 large-5 large-offset-0">
					<div class="p">We are an Architecture practice based in Bangalore with over 16 years of experience in the industry and won several awards for our work in India and oversees. Our Principal Architect has worked with the world renowned architect, Zaha Hadid on many hallmark projects. We specialize in Architecture Design and also take ownership of the development until completion including interior design and project planning services.</div>
					<div class="p strong em text-teal">Vivek Shankar Architects strives to keep abreast with the future trends that will redraw the city and the profession so as to be equipped to respond to challenges in future markets. The practice consciously strives to induct a process ruled by geometric strategies and material compositions that result in subversion of the conventional mode of perceiving a structure or space.</div>
				</div>
				<div class="quick-links columns small-10 small-offset-1 medium-2 large-2 xlarge-1 xlarge-offset-2">
					<a class="button-link" tabindex="-1" href="#expertise">Expertise</a>
					<a class="button-link" tabindex="-1" href="#origin-story">Origin Story</a>
					<a class="button-link" tabindex="-1" href="#process">Process</a>
				</div>
			</div>
		</div>
	</section><!-- END : Practice Section -->

	<!-- Expertise Section -->
	<section id="expertise" class="expertise-section gradient-band section js_section">
		<div class="inner-section fill-light block-space-top-bottom">
			<div class="container">
				<div class="row">
					<div class="title h2 strong text-uppercase columns small-10 small-offset-1">
						<span>Expertise</span>
						<span class="underline fill-teal"></span>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="point row">
					<div class="columns small-10 small-offset-1 large-4">
						<div class="heading h4 strong">Global DNA</div>
						<div class="excerpt p strong em text-teal hide-for-mobile">Vivek trained and worked with the internationally renowned architect Zaha Hadid.</div>
					</div>
					<div class="columns small-10 small-offset-1 large-5">
						<div class="description p">Vivek trained and worked with the internationally renowned architect Zaha Hadid. His first exposure to Zaha was during his Masters degree at the prestigious AA School of Architecture in London. He spent 8 years under Zaha, working on award winning projects in Tokyo, Munich, Singapore, Rome and London.</div>
					</div>
				</div>
				<div class="point row">
					<div class="columns small-10 small-offset-1 large-4">
						<div class="heading h4 strong">Process Driven Global Standards</div>
						<div class="excerpt p strong em text-teal hide-for-mobile">Vivek returned to India and setup his practice to exacting global standards.</div>
					</div>
					<div class="columns small-10 small-offset-1 large-5">
						<div class="description p">With this foundational exposure, Vivek returned to India and setup his practice to exacting global standards. Today the firm operates under the umbrella of these global standards that enable bespoke Design Strategies for each project and client.</div>
					</div>
				</div>
				<div class="point row">
					<div class="columns small-10 small-offset-1 large-4">
						<div class="heading h4 strong">Local Context Advantage</div>
						<div class="excerpt p strong em text-teal hide-for-mobile">Indian lineage ensures we do not run into operational delays and cost overruns.</div>
					</div>
					<div class="columns small-10 small-offset-1 large-5">
						<div class="description p">Global standards in an Indian context are a challenge. Whether it be construction practices, social norms, cultural biases; our strong Indian lineage ensures we do not run into operational delays and cost overruns that International Architects most often suffer when they operate in India.</div>
					</div>
				</div>
				<div class="point row">
					<div class="columns small-10 small-offset-1 large-4">
						<div class="heading h4 strong">Integrated Research, Design and Execution Process</div>
						<div class="excerpt p strong em text-teal hide-for-mobile">We carefully integrate our Research Team with our Design and Execution teams.</div>
					</div>
					<div class="columns small-10 small-offset-1 large-5">
						<div class="description p">Innovation is not realistic in a pure implementation environment. We have deliberately created the optimal conditions for innovation; we carefully integrate our Research Team with our Design and Execution teams with a proprietary triple layer process. The result is research driven bespoke strategy.</div>
					</div>
				</div>
				<div class="point row">
					<div class="columns small-10 small-offset-1 large-4">
						<div class="heading h4 strong">Innovation that leads to Sustainability</div>
						<div class="excerpt p strong em text-teal hide-for-mobile">Innovation is not possible without a bespoke strategy for every project.</div>
					</div>
					<div class="columns small-10 small-offset-1 large-5">
						<div class="description p">The way that we approach a project is highly personalised. Innovation is not possible without a bespoke strategy for every project. Sustainability can only be achieved if Innovation has a stable Design is typically undertaken by a small, close-knit team of individuals, yet this team is able to draw on the wide range of skills that only a practice of our size can offer.</div>
					</div>
				</div>
				<div class="point row">
					<div class="columns small-10 small-offset-1 large-4">
						<div class="heading h4 strong">Last Mile Design Management</div>
						<div class="excerpt p strong em text-teal hide-for-mobile">Vivek’s driving principle is the last mile craftsmanship</div>
					</div>
					<div class="columns small-10 small-offset-1 large-5">
						<div class="description p">The repeating tragedy is the dilution of Architectural Design Strategy during the construction phase. Vivek’s driving principle is the last mile craftsmanship that is needed to transform an architectural concept into finely crafted materials and finishes. We audit all projects against global standards using the most up-to-date project management standards. We play a key role throughout the design and construction phases, from programming, change control, and procurement to document control, payments and risk management.</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- END : Expertise Section -->

	<!-- History Section -->
	<section id="origin-story" class="history-section block-space-top-bottom section js_section">
		<div class="container">
			<div class="row">
				<div class="title h2 text-uppercase strong columns small-10 small-offset-1">
					<span>Origin Story</span>
					<span class="underline fill-light"></span>
				</div>
			</div>
			<div class="description row">
				<div class="columns small-10 small-offset-1 large-5">
					<div class="p">Principal Architect of Vivek Shankar Architects, graduated with a Bachelor’s Degree in Architecture from BMS College of Engineering in Bangalore. He pursued his Master’s degree (M.Arch) – Design Research Lab from the AA School of Architecture in London.</div>
					<div class="p">Upon completion of his Master’s Degree, Vivek was employed with the world renowned Architect, Zaha Hadid. During his tenure with Zaha Hadid, Vivek was part of the design team for the following projects:</div>
					<div class="p">
						<span class="block">Guggenheim Museum, Tokyo</span>
						<span class="block">BMW Event and Delivery Center, Munich</span>
						<span class="block">Biopolis Master plan, Singapore</span>
						<span class="block">Center for Contemporary Arts, Rome</span>
						<span class="block">Interiors for Mandarina Duck, London</span>
					</div>
					<div class="p">He started Vivek Shankar Architects in 2002 and has since then designed and delivered landmark projects across various typologies and scales.  Vivek Shankar Architects  believes in practicing cutting edge design which is enabled by team of skilled designers and engineers/contractors who are able to successfully execute the visualized projects.</div>
				</div>
			</div>
		</div>
	</section><!-- END : History Section -->

	<!-- Process Section -->
	<section id="process" class="process-section fill-light block-space-top-bottom section js_section">
		<div class="container">
			<div class="row">
				<div class="title h2 strong text-uppercase columns small-10 small-offset-1">
					<span>Process</span>
					<span class="underline fill-teal"></span>
				</div>
				<div class="logo columns small-10 small-offset-1 large-9 xlarge-8">
					<img class="show-for-mobile block" src="/media/logo-vsa-large-light.svg<?php echo $ver ?>">
					<img class="hide-for-mobile block" src="/media/logo-vsa-xlarge-light.svg<?php echo $ver ?>">
				</div>
			</div>
		</div>
		<div class="container">
			<div class="point row">
				<div class="heading columns small-10 small-offset-1">
					<span class="inline h4 strong text-uppercase text-light">Research</span>
					<img class="ribbon" src="/media/process-ribbon-1.svg<?php echo $ver ?>">
				</div>
				<div class="description hide-for-mobile columns small-10 small-offset-1 large-5">
					<div class="p">We see the relevance of research not just as the first vital step of the design process that lays down a set of parameters but as the thought generator infused with a high degree of intellectual content that influences the design process.</div>
					<div class="p">The research phase involves probing into the engineering, material, occupational and programmatic aspects that are relevant to the project being designed.</div>
				</div>
				<div class="excerpt columns small-8 small-offset-2 large-4 large-offset-1">
					<div class="p strong em text-teal">The thought generator infused with a high degree of intellectual content that influences the design process.</div>
					<div class="p strong em text-teal">Probing into the engineering, material, occupational and programmatic aspects.</div>
				</div>
			</div>
			<div class="point row">
				<div class="heading columns small-10 small-offset-1">
					<span class="inline h4 strong text-uppercase text-light">Design</span>
					<img class="ribbon" src="/media/process-ribbon-2.svg<?php echo $ver ?>">
				</div>
				<div class="description hide-for-mobile columns small-10 small-offset-1 large-5">
					<div class="p">The inferences drawn from the research enable the formulation of a design agenda that comprises the amalgamation of the site characteristics, climate and budget with the design intent. The client brief is re-imagined and rewritten by us in order to maintain the rigor of the research.</div>
					<div class="p">The design phase largely involves the innovative intervention on the site which is realized through a set of conditions be it structural, geometric explorations, climate responsive measures, generated with software capable of simulating the conditions and perceptions. The production of drawings required for execution is produced after gaining absolute clarity on the technical and material aspects of the design. The 3D renders prepared at various stages of the design development enable a holistic reading of the engineering and design aspects.</div>
				</div>
				<div class="excerpt columns small-8 small-offset-2 large-4 large-offset-1">
					<div class="p strong em text-teal">The amalgamation of the site characteristics, climate & budget with the design intent.</div>
					<div class="p strong em text-teal">The design phase largely involves the innovative intervention.</div>
					<div class="p strong em text-teal">The production of drawings required for execution.</div>
				</div>
			</div>
			<div class="point row">
				<div class="heading columns small-10 small-offset-1">
					<span class="inline h4 strong text-uppercase text-light">Execution</span>
					<img class="ribbon" src="/media/process-ribbon-3.svg<?php echo $ver ?>">
				</div>
				<div class="description hide-for-mobile columns small-10 small-offset-1 large-5">
					<div class="p">This phase witnesses the translation of the drawing content to a physical manifestation of a structural core of steel and concrete and subsequently the resemblance to the 3D render starts to interestingly emerge until the completion of the project.</div>
					<div class="p">We assign a lot of importance to the adherence of instructions mentioned in the drawing along with a high degree of quality control ensured by Project Management and Site Engineers trained to deliver the exacting standards set by Vivek Shankar Architects.  </div>
				</div>
				<div class="excerpt columns small-8 small-offset-2 large-4 large-offset-1">
					<div class="p strong em text-teal">Translation of the drawing content to a physical manifestation.</div>
					<div class="p strong em text-teal">A high degree of quality control ensured by Project Management and Site Engineers trained to deliver.</div>
				</div>
			</div>
		</div>
	</section><!-- END : Process Section -->

	<!-- Services Section -->
	<section id="services" class="services-section block-space-top-bottom section js_section">
		<div class="container">
			<div class="row">
				<div class="heading h2 strong text-uppercase columns small-10 small-offset-1">
					<span>Services</span>
					<span class="underline fill-neutral"></span>
				</div>
				<div class="service columns small-10 small-offset-1 large-5 large-offset-1">
					<div class="title h4 text-teal">Architecture</div>
					<div class="description p text-neutral">The heart and soul of what we provide. Our comprehensive architectural services include conceptual and schematic design, design development and construction documentation, assisting with contractor bidding and/or negotiating and construction contract administration. Architecture embodies all we touch. And we are a combination of artists and tacticians, imagining, coordinating and creating some of the world’s most iconic places.</div>
				</div>
				<div class="service columns small-10 small-offset-1 large-5 large-offset-0">
					<div class="title h4 text-teal">Planning & Development</div>
					<div class="description p text-neutral">We combine global reach with a tremendous local touch. Our commitment to our communities allows us to effectively navigate local regulatory approval processes from platting subdivisions to zoning and permitting. We also handle issues of site analysis, access, circulation, parking, urban design, local development guidelines and place-making. It’s the entire picture. Always.</div>
				</div>
				<div class="service columns small-10 small-offset-1 large-5 large-offset-1">
					<div class="title h4 text-teal">Structural Engineering</div>
					<div class="description p text-neutral">We stretch the design boundaries daily, but always with a practical guide. Our highly experienced in-house team of structural engineers consistently communicates with the architectural team to ensure structural considerations are incorporated into designs from day one. This close cooperation translates into buildings that simply work.</div>
				</div>
				<div class="service columns small-10 small-offset-1 large-5 large-offset-0">
					<div class="title h4 text-teal">Interior Design</div>
					<div class="description p text-neutral">Our award-winning interior design group, one of the largest in the nation, offers creative and intelligent responses to your goals and requirements. We know how to listen and infuse your organization’s personality into a space.</div>
				</div>
				<div class="service columns small-10 small-offset-1 large-5 large-offset-1">
					<div class="title h4 text-teal">Sustainable Design</div>
					<div class="description p text-neutral">Sustainability is infused into all that we touch. We build energy simulation models early in our process to help inform decisions made in our design studios. Our approach is collaborative and integrated, focused on conserving resources, achieving energy independence, reducing greenhouse gas emissions and effectively improving your bottom line.</div>
				</div>
			</div>
		</div>
	</section><!-- END : Services Section -->

	<!-- Contact Section -->
	<section id="contact" class="contact-section fill-light block-space-top-bottom section js_section">
		<div class="container">
			<div class="row">
				<div class="columns small-10 small-offset-1">
					<div class="title h1 strong text-uppercase">
						Contact
					</div>
				</div>
				<div class="get-in-touch columns small-10 small-offset-1 large-4">
					<div class="heading h4 strong text-uppercase text-teal">
						Get in touch
					</div>
					<a class="call button fill-teal" href="tel:+918041328203" target="_blank">
						<img src="/media/icon-call-light.svg<?php echo $ver ?>">
						<span>+91 80 41328203</span>
					</a>
					<a class="call button fill-off-light" href="tel:+918040952203" target="_blank">
						<img src="/media/icon-call-neutral.svg<?php echo $ver ?>">
						<span>+91 80 40952203</span>
					</a>
					<a class="email button fill-teal" href="mailto:enquiry@vivekshankararchitects.com" target="_blank">
						<img src="/media/icon-email-light.svg<?php echo $ver ?>">
						<span>Enquiry</span>
					</a>
					<a class="email button fill-off-light" href="mailto:careers@vivekshankararchitects.com" target="_blank">
						<img src="/media/icon-email-neutral.svg<?php echo $ver ?>">
						<span>Careers</span>
					</a>
				</div>
				<div class="location columns small-10 small-offset-1 medium-3 large-2">
					<div class="heading h4 strong text-uppercase text-teal">
						Location
					</div>
					<div class="address p text-neutral">
						2230/1, 16th B Cross, 8th Main, D Block, Sahakarnagar, Bangalore-560092. Karnataka. India.
					</div>
					<a class="button-link fill-teal" target="_blank" href="https://goo.gl/maps/pnUGjUUYpQw">Google Maps</a>
				</div>
				<div class="follow-us columns small-10 small-offset-1 medium-6 large-3">
					<div class="heading h4 strong text-uppercase text-teal">
						Follow us
					</div>
					<div class="social-icons">
						<a class="icon" target="_blank" href="https://www.facebook.com/vivekshankararchitects/">
							<span>Facebook</span>
							<img src="/media/icon-facebook.svg<?php echo $ver ?>">
						</a>
						<a class="icon" target="_blank" href="https://www.linkedin.com/company/vivek-shankar-architects/">
							<span>LinkedIn</span>
							<img src="/media/icon-linkedin.svg<?php echo $ver ?>">
						</a>
						<a class="icon" target="_blank" href="https://www.instagram.com/vivekshankararchitects/">
							<span>Instagram</span>
							<img src="/media/icon-instagram.svg<?php echo $ver ?>">
						</a>
						<a class="icon" target="_blank" href="https://www.youtube.com/channel/UCHut4ml46MJ3JCUQSm5pvNQ">
							<span>YouTube</span>
							<img src="/media/icon-youtube.svg<?php echo $ver ?>">
						</a>
					</div>
				</div>
			</div>
		</div>
	</section><!-- END : Contact Section -->


	<!-- Lazaro Signature -->
	<?php lazaro_signature(); ?>
	<!-- END : Lazaro Signature -->

</div><!-- END : Page Wrapper -->









<!-- ☰ Super Navigator  ☰ -->

<!-- Menu -->
<div class="menu" tabindex="-1">
	<div class="menu-container container">
		<div class="menu-toggle inline js_menu_opener js_modal_closer">
			<span class="menu-label h4 text-uppercase">&nbsp;</span>
			<span class="menu-icon">
				<span></span>
				<span></span>
				<span></span>
			</span>
		</div>
	</div>
</div>
<!-- END : Menu -->

<!-- Navigation -->
<div class="navigation js_navigation">
	<div class="nav-container container text-right">
		<div class="menu-close-toggler js_modal_close"></div>
		<div class="inline nav-list fill-dark text-left">
			<div class="title h1 strong text-off-dark">Menu</div>
			<a tab-index="-1" href="/" class="link inline h3 strong text-teal text-uppercase">Home</a><br>
			<!-- <a tab-index="-1" href="" class="link inline p strong text-neutral text-uppercase js_link_internal">Welcome</a><br> -->

			<a tab-index="-1" class="link dropdown inline h3 strong text-teal text-uppercase js_sub_menu_trigger">Projects</a><br>
			<div class="js_sub_menu" style="display: none">
				<?php foreach ( $projectsByTypology as $type => $projects ) : ?>
					<a tab-index="-1" class="link dropdown inline p strong text-neutral text-uppercase js_sub_menu_trigger"><?php echo $type ?></a><br>
					<div class="js_sub_menu" style="display: none">
						<?php foreach ( $projects as $project ) : ?>
							<a tab-index="-1" href="/project/<?php echo $project[ 'ID' ] ?>" class="link inline h4 text-blue"><?php echo $project[ 'name' ] ?></a><br>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>

			<?php if ( $viewName == 'project-template' ) : ?>
				<div>
					<a tab-index="-1" href="#intro" class="link inline h4 strong text-off-light text-uppercase js_link_internal">Intro</a><br>
					<a tab-index="-1" href="#benefits" class="link inline h4 strong text-off-light text-uppercase js_link_internal">Benefits</a><br>
					<a tab-index="-1" href="#showcase" class="link inline h4 strong text-off-light text-uppercase js_link_internal">Showcase</a><br>
					<a tab-index="-1" href="#fact-file" class="link inline h4 strong text-off-light text-uppercase js_link_internal">Facts</a><br>
					<a tab-index="-1" href="#other-projects" class="link inline h4 strong text-off-light text-uppercase js_link_internal">Other Projects</a><br>
				</div>
			<?php endif; ?>

			<a tab-index="-1" href="#practice" class="link inline h3 strong text-teal text-uppercase js_link_internal">Practice</a><br>
			<a tab-index="-1" href="#expertise" class="link inline p strong text-neutral text-uppercase js_link_internal">Expertise</a><br>
			<a tab-index="-1" href="#origin-story" class="link inline p strong text-neutral text-uppercase js_link_internal">History</a><br>
			<a tab-index="-1" href="#process" class="link inline p strong text-neutral text-uppercase js_link_internal">Process</a><br>
			<a tab-index="-1" href="#services" class="link inline h3 strong text-teal text-uppercase js_link_internal">Services</a><br>
			<a tab-index="-1" href="#contact" class="link inline h3 strong text-teal text-uppercase js_link_internal">Contact</a><br>
		</div>
	</div>
</div>
<!-- END : Navigation -->




<!-- ⬇ All Modals below this point ⬇ -->

<div id="modal-wrapper"><!-- Modal Wrapper -->
	<div class="modal-box js_modal_box">
		<!-- Modal Content : Sample Video -->
		<div class="modal-box-content js_modal_box_content" data-mod-id="sample-video">
			<div class="container">
				<div class="row">
					<div class="columns small-12">
						<!-- video embed -->
						<div class="youtube_embed ga_video" data-src="https://www.youtube.com/embed/lncVHzsc_QA?rel=0&amp;showinfo=0" data-ga-video-src="Sample - Video">
							<div class="youtube_load"></div>
							<iframe width="1280" height="720" src="" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
		</div><!-- END : Sample Video -->

		<!-- Modal Content : Sample Form -->
		<div class="modal-box-content js_modal_box_content" data-mod-id="sample-form">
			<div class="container">
				<div class="row">
					<div class="columns small-12">
						<h2>Form Title Goes Here</h2>
					</div>
				</div>
				<div class="row">
					<!-- video embed -->
					<div class="columns small-12">
						<div class="youtube_embed ga_video" data-src="https://www.youtube.com/embed/lncVHzsc_QA?rel=0&amp;showinfo=0" data-ga-video-src="Sample - Video">
							<div class="youtube_load"></div>
							<iframe width="1280" height="720" src="" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="columns small-12">
						<p>Augmented reality chrome network skyscraper Tokyo camera military-grade cardboard footage ablative otaku warehouse Kowloon table tower monofilament. Bicycle girl tower network face forwards towards fetishism corporation tiger-team. Monofilament decay hacker RAF dolphin DIY franchise narrative math-skyscraper realism systemic order-flow corrupted. Math-sentient tube cyber-paranoid order-flow long-chain hydrocarbons Chiba boy. RAF advert narrative dissident car wristwatch soul-delay cardboard nano-neon silent. Wonton soup pistol nano-otaku assault franchise realism RAF denim skyscraper geodesic tube into weathered youtube artisanal grenade. Youtube monofilament smart-corporation military-grade Tokyo meta-papier-mache corrupted disposable plastic savant shanty town dolphin 8-bit wonton soup. Military-grade Tokyo digital 3D-printed boat advert San Francisco engine tattoo computer skyscraper physical construct. Sub-orbital computer media market order-flow nodal point j-pop spook Chiba soul-delay tiger-team tanto cartel. Camera tower-space franchise range-rover futurity network military-grade Shibuya. Saturation point tanto physical BASE jump 3D-printed neural fetishism long-chain hydrocarbons rain. Bicycle apophenia futurity digital boat denim post-jeans free-market car corporation range-rover cardboard convenience store concrete. Long-chain hydrocarbons j-pop Tokyo crypto-table cardboard render-farm. Tokyo boy disposable industrial grade bridge A.I. carbon footage BASE jump cartel free-market euro-pop long-chain hydrocarbons-ware grenade. Pre-man voodoo god towards euro-pop cyber-crypto-Legba systema modem beef noodles. Free-market boy sensory post--space systemic jeans. Uplink singularity shanty town voodoo god rifle tank-traps smart-katana shrine human. Hotdog savant human garage wonton soup tube dolphin j-pop. Tiger-team wristwatch engine vehicle cartel apophenia augmented reality man network stimulate. Shrine claymore mine monofilament hotdog voodoo god geodesic knife. Voodoo god silent otaku hacker computer post-singularity office tower shanty town. Tokyo lights corrupted marketing skyscraper receding beef noodles uplink footage gang rebar order-flow table nano-bicycle tube. </p>
					</div>
				</div>
			</div>
		</div><!-- END : Sample Form -->


		<!-- Modal Close Button -->
		<div class="modal-close js_modal_close">&times;</div>
	</div>

</div><!-- END : Modal Wrapper -->

<!--  ☠  MARKUP ENDS HERE  ☠  -->

<?php lazaro_disclaimer(); ?>









<!-- JS Modules -->
<!-- <script type="text/javascript" src="/js/modules/pageless.js"></script> -->
<script type="text/javascript" src="/js/modules/navigation.js<?php echo $ver ?>"></script>
<script type="text/javascript" src="/js/modules/video_embed.js<?php echo $ver ?>"></script>
<script type="text/javascript" src="/js/modules/modal_box.js<?php echo $ver ?>"></script>
<script type="text/javascript" src="/js/modules/smoothscroll.js<?php echo $ver ?>"></script>
<script type="text/javascript" src="/js/modules/form.js<?php echo $ver ?>"></script>
<script type="text/javascript" src="/js/modules/disclaimer.js<?php echo $ver ?>"></script>

<script type="text/javascript">

// JAVASCRIPT GOES HERE
$(document).ready(function(){
});

</script>

</body>

</html>

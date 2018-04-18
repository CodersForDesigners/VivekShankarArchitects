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
	require_once __DIR__ . '/lib/db.php';
	require_once __DIR__ . '/lib/projects.php';

	/*
	 * Versioning Assets to invalidate the browser cache
	 */
	$ver = '?v=2018041621';

	// get info on the request
	$view = require "server/pageless.php";
	$viewName = $view[ 0 ];
	$viewPath = $view[ 1 ];

	// included external php files with functions.
	require ('inc/head.php');
	require ('inc/lazaro.php'); /* -- Lazaro disclaimer and footer -- */

	// Get projects by type
	$projectsByType = getProjectsByType();

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
	prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml">

<head>


	<!-- Nothing Above This -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Page Title | Page Name -->
	<title>Page Title <?php echo ( $viewName != "404" ? " | " . $viewName : "" ) ?></title>

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

		<?php require $viewPath; ?>

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
					<div class="p">Building and operating an international architectural firm in India is possible. In fact we have done it.  Every project we execute follows global standards across Research, Design and Execution. The benefit? Our team has local knowledge in construction techniques, cultural constraints and legal by-laws.</div>
					<div class="p strong em text-teal">Architecture that is Global yet Local.</div>
				</div>
				<div class="quick-links columns small-10 small-offset-1 medium-2 large-2 xlarge-1 xlarge-offset-2">
					<a class="button-link" tabindex="-1" href="#">Expertise</a>
					<a class="button-link" tabindex="-1" href="#">Origin Story</a>
					<a class="button-link" tabindex="-1" href="#">Process</a>
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
						<div class="excerpt p strong em text-teal hide-for-mobile">Indian leaniage ensures we do not run into operational delays and cost overruns.</div>
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
						<div class="heading h4 strong">Last Mile Design Management </div>
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
	<section id="history" class="history-section block-space-top-bottom section js_section">
		<div class="container">
			<div class="row">
				<div class="title h2 text-uppercase strong columns small-10 small-offset-1">
					<span>Origin Story</span>
					<span class="underline fill-light"></span>
				</div>
			</div>
			<div class="description row">
				<div class="columns small-10 small-offset-1 large-5">
					<div class="p">Vivek V.Shankar graduated with a bachelor’s degree in Architecture from BMS College of Engineering in Bangalore in 1998. Vivek took a Masters’ degree (M.Arch) in Architecture and Urbanism from the prestigious AA School of Architecture in London. I</div>
					<div class="p">Upon completion of his Masters’ degree, Vivek was employed at the office of Zaha Hadid in London.</div>
					<div class="p">Zaha Hadid is a world renowned architect based in London and recipient of the Pritzker Prize for Architecture. Vivek’s design language is influenced by the work experience gained with ZahaHadid and also the design processes that were experimented during the Masters’ program at the Architectural Association, London. Vivek was part of the design team for the following projects at the office of Zaha Hadid in London.</div>
					<div class="p">
						<span class="block">1. Guggenheim Museum, Tokyo</span>
						<span class="block">2. BMW Event and Delivery Center, Munich</span>
						<span class="block">3. Ordrupgaard Museum, Denmark</span>
						<span class="block">4. Center for Contemporary arts, Rome</span>
						<span class="block">5. Interiors for Mandarina Duck, London</span>
					</div>
					<div class="p">Vivek has his architectural practice based out of Bangalore and is keen on establishing an affiliation with the latest Trends in design and the changing face of design in Indian Metros. The practice consciously strives to induct a process ruled by geometric strategies and material compositions that result in a subversion of the conventional mode of perceiving a structure or space.</div>
				</div>
				<div class="columns small-10 small-offset-1 large-4">
					<img class="block photograph" src="http://via.placeholder.com/650x500">
					<div class="p">The projects are currently being designed by the office demand a high level of design ingenuity and resolution. This is achieved by the skilled team of young architects who are trained to adopt the latest in software technology for preparing high quality presentations and technical drawings.</div>
					<div class="p">Vivek has been a member of the visiting faculty at leading architecture schools in South India.</div>
				</div>
			</div>
			<div class="film row">
				<div class="columns small-10 small-offset-1 large-5">
					<img class="block" src="http://via.placeholder.com/1280x720?text=YouTube">
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
				<div class="h2 strong text-uppercase columns small-10 small-offset-1">
					Services
				</div>
				<div class="columns small-10 small-offset-1 medium-5 medium-offset-1">
					<div class="h4">Architecture</div>
					<div class="p">The heart and soul of what we provide. Our comprehensive architectural services include conceptual and schematic design, design development and construction documentation, assisting with contractor bidding and/or negotiating and construction contract administration. Architecture embodies all we touch. And we are a combination of artists and tacticians, imagining, coordinating and creating some of the world’s most iconic places.</div>
				</div>
				<div class="columns small-10 small-offset-1 medium-5 medium-offset-0">
					<div class="h4">Planning & Development</div>
					<div class="p">We combine global reach with a tremendous local touch. Our commitment to our communities allows us to effectively navigate local regulatory approval processes from platting subdivisions to zoning and permitting. We also handle issues of site analysis, access, circulation, parking, urban design, local development guidelines and place-making. It’s the entire picture. Always.</div>
				</div>
				<div class="columns small-10 small-offset-1 medium-5 medium-offset-1">
					<div class="h4">Structural Engineering</div>
					<div class="p">We stretch the design boundaries daily, but always with a practical guide. Our highly experienced in-house team of structural engineers consistently communicates with the architectural team to ensure structural considerations are incorporated into designs from day one. This close cooperation translates into buildings that simply work.</div>
				</div>
				<div class="columns small-10 small-offset-1 medium-5 medium-offset-0">
					<div class="h4">Interior Design</div>
					<div class="p">Our award-winning interior design group, one of the largest in the nation, offers creative and intelligent responses to your goals and requirements. We know how to listen and infuse your organization’s personality into a space.</div>
				</div>
				<div class="columns small-10 small-offset-1 medium-5 medium-offset-1">
					<div class="h4">Sustainable Design</div>
					<div class="p">Sustainability is infused into all that we touch. We build energy simulation models early in our process to help inform decisions made in our design studios. Our approach is collaborative and integrated, focused on conserving resources, achieving energy independence, reducing greenhouse gas emissions and effectively improving your bottom line.</div>
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
						<img src="media/icon-call.svg<?php echo $ver ?>">
						<span>+91 80 4132 8203</span>
					</a>
					<a class="email button fill-off-light" href="#" target="_blank">
						<img src="media/icon-email.svg<?php echo $ver ?>">
						<span>Email</span>
					</a>
				</div>
				<div class="location columns small-10 small-offset-1 medium-3 large-2">
					<div class="heading h4 strong text-uppercase text-teal">
						Location
					</div>
					<div class="address p text-neutral">
						#203 ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.
					</div>
					<a class="button-link fill-teal" href="">Google Maps</a>
				</div>
				<div class="follow-us columns small-10 small-offset-1 medium-6 large-3">
					<div class="heading h4 strong text-uppercase text-teal">
						Follow us
					</div>
					<div class="social-icons">
						<a class="icon" href="">
							<span>Facebook</span>
							<img src="media/icon-facebook.svg<?php echo $ver ?>">
						</a>
						<a class="icon" href="">
							<span>LinkedIn</span>
							<img src="media/icon-linkedin.svg<?php echo $ver ?>">
						</a>
						<a class="icon" href="">
							<span>Instagram</span>
							<img src="media/icon-instagram.svg<?php echo $ver ?>">
						</a>
						<a class="icon" href="">
							<span>YouTube</span>
							<img src="media/icon-youtube.svg<?php echo $ver ?>">
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
			<a tab-index="-1" href="" class="link inline h3 strong text-teal text-uppercase">Home</a><br>
			<a tab-index="-1" href="" class="link inline p strong text-neutral text-uppercase">Welcome</a><br>

			<a tab-index="-1" class="link dropdown inline h3 strong text-teal text-uppercase js_sub_menu_trigger">Projects</a><br>
			<div class="js_sub_menu" style="display: none">
				<?php foreach ( $projectsByType as $type => $projects ) : ?>
					<a tab-index="-1" class="link dropdown inline p strong text-neutral text-uppercase js_sub_menu_trigger"><?php echo $type ?></a><br>
					<div class="js_sub_menu" style="display: none">
						<?php foreach ( $projects as $project ) : ?>
							<a tab-index="-1" href="project/<?php echo $project[ 'slug' ] ?>" class="link inline h4 text-blue"><?php echo $project[ 'name' ] ?></a><br>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- if Project Template { -->
			<div>
				<a tab-index="-1" href="" class="link inline h4 strong text-off-light text-uppercase">Intro</a><br>
				<a tab-index="-1" href="" class="link inline h4 strong text-off-light text-uppercase">Benefits</a><br>
				<a tab-index="-1" href="" class="link inline h4 strong text-off-light text-uppercase">Showcase</a><br>
				<a tab-index="-1" href="" class="link inline h4 strong text-off-light text-uppercase">Facts</a><br>
				<a tab-index="-1" href="" class="link inline h4 strong text-off-light text-uppercase">Other Projects</a><br>
			</div>
			<!-- END : } if Project Template -->
			<a tab-index="-1" href="" class="link inline h3 strong text-teal text-uppercase">Practice</a><br>
			<a tab-index="-1" href="" class="link inline p strong text-neutral text-uppercase">Expertise</a><br>
			<a tab-index="-1" href="" class="link inline p strong text-neutral text-uppercase">History</a><br>
			<a tab-index="-1" href="" class="link inline p strong text-neutral text-uppercase">Process</a><br>
			<a tab-index="-1" href="" class="link inline h3 strong text-teal text-uppercase">Services</a><br>
			<a tab-index="-1" href="" class="link inline h3 strong text-teal text-uppercase">Contact</a><br>
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
<script type="text/javascript" src="/js/modules/pageless.js"></script>
<script type="text/javascript" src="/js/modules/navigation.js"></script>
<script type="text/javascript" src="/js/modules/video_embed.js"></script>
<script type="text/javascript" src="/js/modules/modal_box.js"></script>
<script type="text/javascript" src="/js/modules/smoothscroll.js"></script>
<script type="text/javascript" src="/js/modules/form.js"></script>
<script type="text/javascript" src="/js/modules/disclaimer.js"></script>

<script type="text/javascript">

// JAVASCRIPT GOES HERE
$(document).ready(function(){
});

</script>

</body>

</html>

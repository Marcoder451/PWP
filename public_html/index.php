<!Doctype HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
				integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- FontAwesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<!-- Custom CSS -->
		<link rel="stylesheet" href="css/style.css">


		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
				  integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
				  crossorigin="anonymous"></script>

		<!-- jQuery Form, Additional Methods, Validate -->
		<script type="text/javascript"
				  src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
		<script type="text/javascript"
				  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
		<script type="text/javascript"
				  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/additional-methods.min.js"></script>

		<!-- Your JavaScript Form Validator -->
		<script src="js/form-validate.js"></script>

		<title>ANC 451</title>
		<!-- google recaptcha-->
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>

	<body class="index" data-spy="scroll" data-target=".navbar-inverse">

		<nav class="navbar navbar-inverse">
			<div class="container-fluid">

				<!-- logo #is place holder for a link -->
				<div class="navbar-header">
					<!-- Navbar button -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="#" class="navbar-brand">AmbassadorsNChains</a>
				</div>


			<!-- menu items -->

				<div class="collapse navbar-collapse" id="mainNavBar">
					<ul class="nav navbar-nav">


						<!-- Services tab dropdown-->
						<li class="active" class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Services<span></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Studio Recording</a></li>
								<li><a href="#">Voice Overs</a></li>
								<li><a href="#">Music Production</a></li>
								<li><a href="#">Post Production</a></li>
							</ul>
						</li>
						<!-- Our Artist tab dropdown-->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Our Artist<span></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Emel</a></li>
								<li><a href="#">Rival</a></li>
								<li><a href="#">Submissions</a></li>
							</ul>
						</li>
						<!-- About Us tab dropdown-->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us<span></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Our Desire</a></li>
								<li><a href="#">Our Goal</a></li>
							</ul>
						</li>
						</li>
					</ul>
					<!-- right align contact us tab -->
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Contact Us</a></li>
					</ul>
				</div>

		</nav>

		<!-- look to wireframes for above the content -->
		<div class="container">
			<div class="row">
				<div id="header">
					<img src="images/station.jpg" id="back" class="img-responsive">
					<div class="carousel-caption"><h1 class="brand-heading">Ambassadors N’ Chains</h1>
						<p id="caption">ANC has a wide range of services geared towards helping you to effectively</p>
						<p id="caption">get your message out to the world. Let's build your vision</p></div>
					<img id="front" src="images/logo.png">
				</div>
			</div>
		</div>

		<section class="intro">
			<div class="intro-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">



							<div class="page-scroll">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- trying some things -->

		<!-- some quote about service. sits on image @ top of screen -->
		<div class="row">
			<div class="col-md-2"></div>
			<H3 class="text-center">Services</H3>
		</div>


		<div class="row">
			<div class="col-md-12">

				<div class="row" id="services">
					<div class="col-md-12">
						<div class="col-md-2"></div>
						<div class="col-md-10"><p>Specifically created for todays social media focused world, ANC
								Studios
								is a
								conscious provider of high quality production value that companies, talent, content
								creators,
								brands and partners can connect with their target audiences and fans by way of engaging
								content. Here are the services we pride our selves on carrying out, to serve
								your various media needs.</p>
						</div>
					</div>
				</div>

				<!-- same quote about service. sits on image @ top of screen -->
				<div class="row">
					<div class="col-md-2"></div>
					<H3 class="text-center">What We Will Do For You</H3>
				</div>

				<div class="row">
					<div class="class center-block">
						<div class="col-md-3">
							<p class="text-center"><strong>Studio Recording</strong></p>
							<a href="#demo" data-toggle="collapse" class="text-center">
								<img data-toggle="collapse" data-target="#demo" id="studio"
									  src="images/studio-recording.jpg"
									  class="img-circle person" alt="Studio Recording" align="middle"></a>

							<div id="demo" class="collapse">
								<p>ANC Studios is a fully integrated multimedia company specializing in audio recording,
									creative
									development, songwriting, and vocal coaching to accommodate the many needs of both
									artist,
									and
									companies.</p>
							</div>
						</div>
						<div class="col-md-3">
							<p class="text-center"><strong>Voice Overs</strong></p>
							<a href="#demo2" data-toggle="collapse">
								<img id="voice" src="images/voice-overs.jpg" class="img-circle person" alt="Voice Overs"></a>
							<div id="demo2" class="collapse">
								<p>Great storytelling needs a great voice, amazing music and an effective relatable
									message.
									We’ve
									worked on successful social media campaigns, event promotion, community engagement
									projects,
									short films and documentaries. Lets tell your brands story.</p>
							</div>
						</div>
						<div class="col-md-3">
							<p class="text-center"><strong>Music Production</strong></p>
							<a href="#demo3" data-toggle="collapse">
								<img id="music" src="images/music-production.jpg" class="img-circle person"
									  alt="Music Production"></a>

							<div id="demo3" class="collapse">
								<p>Our producers can help in all the areas of a songs production. From choosing the songs,
									through
									completing the recording process, and even to sequencing material for an entire album.
									The
									producer is here to insure a polished finished product. We take what the artist is
									communicating, to bring emotion to a song that that will touch lives. Our producers
									approach
									recording sessions like a conductor of an orchestra. The players being artist,
									musicians,
									engineers, arrangers, vocalists, editors and even atmosphere of the studio.</p>
							</div>
						</div>
						<div class="col-md-3">
							<p class="text-center"><strong>Post Production</strong></p>
							<a href="#demo4" data-toggle="collapse">
								<img id="post" src="images/post-production.jpg" class="img-circle person"
									  alt="Random Name"></a>
							<div id="demo4" class="collapse">
								<p>We offer professional editing, mixing, and mastering services for your voice overs,
									ads,
									and music. Whether you’ve
									recorded in a home or professional studio, if you’re a beginner or seasoned pro,
									ANC caters to every business and artist across the board. Our Mixing and Mastering
									packages
									include anything needed in order for your project/campaign to reach its fulfillment. We
									stick
									with
									each client until they are satisfied. Our staff is responsive, helpful, friendly, and
									here
									to make your vision as amazing as you want it.</p>
							</div>
						</div>
					</div>
				</div>
				<!-- top of page -->
				<!-- some quote about artist. sits on image @ top of screen -->
				<div class="row">
					<div class="col-md-2"></div>
					<H3 class="text-center">Our Artist</H3>
				</div>
				<!-- the page's subtitle -->
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-4"><H3>Meet The Artist Of ANC</H3>
					</div>
				</div>

				<!-- artist names will represent picture links until pics added -->
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-3">
						<p class="text-center"><strong>Emel</strong></p>
						<a href="#demo5" data-toggle="collapse">
							<img id="emel" src="images/emel.jpg" class="img-circle person" alt="Random Name"></a>
						<div id="demo5" class="collapse">
							<p>Emel is the founder and owner of ANC and has been a Christian Hip Hop artist since 2008.
								Dedicated to the ministry and entertainment.</p>
						</div>
					</div>
					<div class="col-md-3">
						<p class="text-center"><strong>Rival</strong></p>
						<a href="#demo6" data-toggle="collapse">
							<img id="rival" src="images/rival.jpg" class="img-circle person" alt="Random Name"></a>
						<div id="demo6" class="collapse">
							<p>Emel and Dee Brown comprise the group Rival. The two have collaborated musically since
								2011.
								After frequent collaboration, the duo decided to combine their talents, creating a new
								distinctive sound.</p>
						</div>
					</div>
					<div class="col-md-3">
						<p class="text-center"><strong>Submissions</strong></p>
						<a href="#demo7" data-toggle="collapse">
							<img id="submissions" src="images/talent.jpeg" class="img-circle person"
								  alt="Random Name"></a>
						<div id="demo7" class="collapse">
							<p>ANC is looking for ambitious, energetic, positive and God loving artist to join the team.
								ANC
								is
								two artist strong and, knows when a group Christian artists come together to attain a
								common
								goal, God steps in and history is created!</p>
						</div>
					</div>
				</div>

				<!-- top of the page -->
				<div class="row">
					<div class="col-md-2"></div>
					<H3 class="text-center">About Us</H3>
				</div>

				<!-- the page's subtitle -->
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-4"><H3>Why We strive to serve</H3>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-3">
						<div class="center-block">
							<p class="text-center"><strong>Our Desire</strong></p>
							<a href="#demo8" data-toggle="collapse">
								<img id="desire" src="images/emel.jpg" class="img-circle person" alt="Random Name"></a>
							<div id="demo8" class="collapse">
								<p>The founder of ANC is a dream driven entrepreneur and fills the company with
									like-minded individuals who are driven to help make dreams a reality knowing that all
									things are possible when great minds work together. We have the expertise to prepare
									your project for entry into any media outlet.</p>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<p class="text-center"><strong>Our Goal</strong></p>
						<a href="#demo9" data-toggle="collapse">
							<img id="goal" src="images/rival.jpg" class="img-circle person" alt="Random Name"></a>
						<div id="demo9" class="collapse">
							<p>Our team is passionate about providing quality. We view every project as an opportunity to
								help someone’s vision come to fruition and we work very closely with our customers to make
								sure the project is what you envisioned. Whether it is, audio advertising, music
								production or artist development we are dedicated to ensuring THE DREAM is what we have
								achieved.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<H3 class="text-center" id="contact">Contact Us</H3>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="col-md-4">
								<h2>Let's Get To Work</h2>
								<p>For more information regarding available services or to request a quote
									please complete the required fields.</p>
								<p>For quotes please include what service you would like pricing for and desired date for
									completion of your project.</p>
								<p>We look forward helping you create what you have envisioned!</p>
							</div>
							<div class="col-md-7">
								<!--Begin Contact Form-->

								<form id="contact-form" action="php/mailer.php" method="post">
									<div class="form-group">
										<label for="name">Name <span class="text-danger">*</span></label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-user" aria-hidden="true"></i>
											</div>
											<input type="text" class="form-control" id="name" name="name" placeholder="Name">
										</div>
									</div>
									<div class="form-group">
										<label for="email">Email <span class="text-danger">*</span></label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-envelope" aria-hidden="true"></i>
											</div>
											<input type="email" class="form-control" id="email" name="email"
													 placeholder="Email">
										</div>
									</div>
									<div class="form-group">
										<label for="subject">Subject</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-pencil" aria-hidden="true"></i>
											</div>
											<input type="text" class="form-control" id="subject" name="subject"
													 placeholder="Subject">
										</div>
									</div>
									<div class="form-group">
										<label for="message">Message <span class="text-danger">*</span></label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-comment" aria-hidden="true"></i>
											</div>
											<textarea class="form-control" rows="5" id="message" name="message"
														 placeholder="Message (2000 characters max)"></textarea>
										</div>
									</div>

									<!-- reCAPTCHA -->
									<div class="g-recaptcha" data-sitekey="6LeJ0CMUAAAAADAqraFj7aDpPZm6CzlN3RVqZuWn"></div>

									<button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Send
									</button>
									<button class="btn btn-warning" type="reset"><i class="fa fa-ban"></i> Reset</button>
								</form>
							</div>

						</div>
						<!--empty area for form error/success output-->
						<div class="row">
							<div class="col-xs-12">
							</div>
						</div>
						<div id="output-area"></div>
						</main>
					</div>
				</div>
	</body>

</html>
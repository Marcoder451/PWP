<!Doctype HTML>
<html>
	<head>
		<meta charset="utf-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css" type="text/css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<!-- jQuery Form, Additional Methods, Validate -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/additional-methods.min.js"></script>

		<!-- Your JavaScript Form Validator -->
		<script src="js/form-validate.js"></script>
		<title>ANC 451</title>
		<!-- google recaptcha-->
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body>
		<div class="container">
		<header>


		</header>
		<div>
			<h1>Content</h1>
			<H3>Services</H3>
			<p>Specifically created for todays social media focused world, ANC Studios is a conscious provider of high quality production value that companies, talent, content creators, brands and partners can connect with their target audiences and fans by way of engaging content. </p>

			<ul>
				<li>Studio Recording</li>
				<p>ANC Studios is a fully integrated multimedia company specializing in audio recording, music videos, creative development, songwriting, and vocal coaching to accommodate the many needs of both artist, and companies.</p>

				<li>Voice Overs</li>
				<p>Great storytelling needs a great voice, amazing music and an effective relatable message. We’ve worked on successful social media campaigns, event promotion, community engagement projects, short films and documentaries. Lets tell your brands story.</p>

				<li>Music Production</li>
				<p>Our producers can help in all the areas of a songs production. From choosing the songs, through completing the recording process, and even to sequencing material for an entire album. The producer is here to insure a polished finished product. We take what the artist is communicating, to bring emotion to a song that that will touch lives. Our producers approach recording sessions like a conductor of an orchestra. The players being artist, musicians, engineers, arrangers, vocalists, editors and even atmosphere of the studio.</p>

				<li>Post Production</li>
				<p>We offer Professional Online Mixing and Mastering services for your music, whether you’ve recorded in a home studio or professional studio, whether you’re a beginner or seasoned pro. Our services cater to all artists, producers across the board. Our Mixing and Mastering packages include anything needed in order for your music/campaign to reach its fulfillment. We stick with each client until they’re satisfied. Our staff is responsive, helpful, friendly, and we’re here to make your vision as amazing as you want it.</p>
			</ul>

			<H3>Artist</H3>
			<p>Meet the current artist of ANC</p>
			<ul>
				<li>Emel</li>
				<p>Emel is the founder and owner of ANC and has been a Christian Hip Hop artist since 2008.  Dedicated to the ministry and entertainment.</p>

				<li>Rival</li>
				<p>Emel and Dee Brown comprise the group Rival. The two have collaborated musically since 2011. Afeter frequent collaboration, the duo decided to combine thier talents, creating a new distinctive sound.</p>

				<li>Submissions Reviewed</li>
				<p>ANC is looking for ambitious, energetic, positive and God loving artist to join the team. ANC is two artist strong and, knows when a group Christian artists come together to attain a common goal, God steps in and history is created!</p>
			</ul>

			<H3>About Us</H3>
			<ul>
				<li>Our Desire</li>
				<li></li>
				<li>Our Goal</li>
			</ul>

			<div class="row">
				<div class="col-md-12">
					<H3 class="text-center">Contact Us</H3>
				</div>

			</div>
			<div class="row">
				<div class="col-md-5">
				</div>
				<div class="col-md-6">
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
						<input type="email" class="form-control" id="email" name="email" placeholder="Email">
					</div>
				</div>
				<div class="form-group">
					<label for="subject">Subject</label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</div>
						<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
					</div>
				</div>
				<div class="form-group">
					<label for="message">Message <span class="text-danger">*</span></label>
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-comment" aria-hidden="true"></i>
						</div>
						<textarea class="form-control" rows="5" id="message" name="message" placeholder="Message (2000 characters max)"></textarea>
					</div>
				</div>

				<!-- reCAPTCHA -->
				<div class="g-recaptcha" data-sitekey="--YOUR RECAPTCHA SITE KEY--"></div>

				<button class="btn btn-success" type="submit"><i class="fa fa-paper-plane"></i> Send</button>
				<button class="btn btn-warning" type="reset"><i class="fa fa-ban"></i> Reset</button>
			</form>
			</div>

		</div>
			<!--empty area for form error/success output-->
			<div class="row">
				<div class="col-xs-12">
					<div id="output-area"></div>
				</div>
			</div>
		</main>
		</div>
	</body>


</html>

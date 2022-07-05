<?php
session_start();

include("php/simple-php-captcha/simple-php-captcha.php");
include("php/php-mailer/PHPMailerAutoload.php");

// Step 1 - Enter your email address below.
$to = 'info@donveneris.cz';

if(isset($_POST['emailSent'])) {

	$subject = $_POST['subject'];

	// Step 2 - If you don't want a "captcha" verification, remove that IF.
	if (strtolower($_POST["captcha"]) == strtolower($_SESSION['captcha']['code'])) {

		$name = $_POST['name'];
		$email = $_POST['email'];

		// Step 3 - Configure the fields list that you want to receive on the email.
		$fields = array(
			0 => array(
				'text' => 'Name',
				'val' => $_POST['name']
			),
			1 => array(
				'text' => 'Email address',
				'val' => $_POST['email']
			),
			2 => array(
				'text' => 'Message',
				'val' => $_POST['message']
			),
			3 => array(
				'text' => 'Radios',
				'val' => $_POST['radios']
			)
		);

		$message = "";

		foreach($fields as $field) {
			$message .= $field['text'].": " . htmlspecialchars($field['val'], ENT_QUOTES) . "<br>\n";
		}

		$mail = new PHPMailer;

		                                  // Set mailer to use SMTP
		$mail->SMTPDebug = 0;                                 // Debug Mode

		// Step 4 - If you don't receive the email, try to configure the parameters below:

		//$mail->Host = 'mail.yourserver.com';				  // Specify main and backup server
		//$mail->SMTPAuth = true;                             // Enable SMTP authentication
		//$mail->Username = 'user@example.com';               // SMTP username
		//$mail->Password = 'secret';                         // SMTP password
		//$mail->SMTPSecure = 'tls';                          // Enable encryption, 'ssl' also accepted
		//$mail->Port = 587;   								  // TCP port to connect to




		$mail->From = $email;
		$mail->FromName = $_POST['name'];
		$mail->AddAddress($to);
		$mail->AddReplyTo($email, $name);

		$mail->IsHTML(true);

		$mail->CharSet = 'UTF-8';

		$mail->Subject = $subject;
		$mail->Body    = $message;

		// Step 5 - If you don't want to attach any files, remove that code below
		if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
			$mail->AddAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
		}

		if($mail->Send()) {
			$arrResult = array('response'=> 'success');
		} else {
			$arrResult = array('response'=> 'error', 'error'=> $mail->ErrorInfo);
		}

	} else {

		$arrResult['response'] = 'captchaError';

	}

}
?>
<!DOCTYPE html><html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Contact Us Advanced | Porto - Responsive HTML5 Template 4.5.0</title>	

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.min.css">
		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.min.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css">
		<link rel="stylesheet" href="css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">
		<link rel="stylesheet" href="css/theme-animate.css">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/default.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="css/custom.css">

		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.min.js"></script>

	</head>
	<body>

		<div class="body">
			<header id="header" class="header-mobile-nav-only" data-plugin-options='{"stickyEnabled": true, "stickyEnableOnBoxed": true, "stickyEnableOnMobile": true, "stickyStartAt": 57, "stickySetTop": "-57px", "stickyChangeLogo": true}'>
				<div class="header-body">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-logo">
									<a href="index.html">
										<img alt="Porto" width="250" height="40" data-sticky-width="150" data-sticky-height="25" data-sticky-top="33" src="img/logo.png">
									</a>
								</div>
							</div>
							<div class="header-column">
								<div class="header-row">
									<div class="header-nav header-nav-top-line">
										<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
											<i class="fa fa-bars"></i>
										</button>
										<ul class="header-social-icons social-icons hidden-xs">
											<li class="social-icons-facebook"><a href="http://www.facebook.com/DonVeneris" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
											<li class="social-icons-twitter"><a href="https://twitter.com/DonVeneris" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
										</ul>
										<div class="header-nav-main header-nav-main-square header-nav-main-effect-3 header-nav-main-sub-effect-1 collapse">
											<nav>
												<ul class="nav nav-pills" id="mainNav">
													<li class="dropdown">
														<a class="dropdown" href="index.html">
															Home
														</a>
													</li>
													<li class="dropdown">
														<a class="dropdown-toggle" href="#">
															Výroba parfémů a kosmetiky
														</a>
														<ul class="dropdown-menu">
															<li class="dropdown-submenu">
																<a href="#">Výroba parfémů</a>
																<ul class="dropdown-menu">
																	<li><a href="vyroba-parfemu.html">Výroba parfémů</a></li>
																	<li><a href="flakony.html"><span>Obaly</span></a></li>
																	<li><a href="caps.html"><span>Příslušenství</span></a></li>
																</ul>
															</li>
															<li class="dropdown-submenu">
																<a href="#">Výroba kosmetiky</a>
																<ul class="dropdown-menu">
																	<li><a href="vyroba-kosmetiky.html">Výroba kosmetiky</a></li>
																	<li><a href="g.bottles.html">Obaly</a></li>
																	<li><a href="g.jars.html">Příslušenství</a></li>
													
															
																	
																</ul>
															</li>
														</ul>
													</li>
													<li class="dropdown">
														<a class="dropdown" href="cenik-vyroby-parfemu-kosmetiky.html">
															O výrobě
														</a>
														
													</li>
											<li class="dropdown">
														<a class="dropdown" href="o-nas.html">
															O nás
														</a>
														
													</li>
									<li class="dropdown active">
														<a class="dropdown" href="kontakty.html">
															Kontaktujte nás
														</a>
														
													</li>
	<li class="dropdown">
														<a class="dropdown" href="page-faq.html">
															FAQ
														</a>
														
													</li>
												</ul>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

			<div role="main" class="main">

				<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="index.html">Home</a></li>
									<li class="active">Kontaktujte nás</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1>Kontaktujte nás</h1>
							</div>
						</div>
					</div>
				</section>

				<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
				<div id="googlemaps" class="google-map"></div>

				<div class="container">

					<div class="row">
						<div class="col-md-6">

							<div class="offset-anchor" id="contact-sent"></div>

							<?php
							if (isset($arrResult)) {
								if($arrResult['response'] == 'success') {
								?>
								<div class="alert alert-success" id="contactSuccess">
									<strong>Odesláno!</strong> Děkujeme za Vaš dotaz/poptávku.
								</div>
								<?php
								} else if($arrResult['response'] == 'error') {
								?>
								<div class="alert alert-danger" id="contactError">
									<strong>Chyba!</strong> Chyba při odesílání zprávy. (<?php echo $arrResult['error'];?>)
								</div>
								<?php
								} else if($arrResult['response'] == 'captchaError') {
								?>
								<div class="alert alert-danger" id="contactError">
									<strong>Chyba!</strong> Ověřování selhalo.
								</div>
								<?php
								}
							}
							?>

							<h2 class="mb-sm mt-sm"><strong>Kontaktujte</strong> Nás</h2>
							<form id="contactFormAdvanced" action="<?php echo basename($_SERVER['PHP_SELF']); ?>#contact-sent" method="POST" enctype="multipart/form-data">
								<input type="hidden" value="true" name="emailSent" id="emailSent">
								<div class="row">
									<div class="form-group">
										<div class="col-md-6">
											<label>Vaše jméno *</label>
											<input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="name" id="name" required>
										</div>
										<div class="col-md-6">
											<label>Váš e-mail *</label>
											<input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>Předmět</label>
											<select data-msg-required="Please enter the subject." class="form-control" name="subject" id="subject" required>
												<option value="">...</option>
												<option value="Option 1">Všeobecný dotaz</option>
												<option value="Option 2">Dotaz na zboží</option>
												<option value="Option 3">Poptávka</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-12">
													<label>Vyberte</label>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="radio-group" data-msg-required="Please select one option.">
														<label class="radio-inline">
															<input type="radio" name="radios" id="inlineRadio1" value="option1"> Nic
														</label>
														<label class="radio-inline">
															<input type="radio" name="radios" id="inlineRadio2" value="option2"> Výroba na klíč
														</label>
														<label class="radio-inline">
															<input type="radio" name="radios" id="inlineRadio3" value="option3"> Skladové zásoby
														</label>
														<label class="radio-inline">
															<input type="radio" name="radios" id="inlineRadio4" value="option4"> Naše produkty
														</label>
														
													</div>
												</div>
											</div>
										</div>
										
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>Příloha</label>
											<input type="file" name="attachment" id="attachment">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-12">
											<label>Zpráva *</label>
											<textarea maxlength="5000" data-msg-required="Please enter your message." rows="6" class="form-control" name="message" id="message" required></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label>Ověření *</label>
									</div>
								</div>
								<div class="row">
									<div class="form-group">
										<div class="col-md-4">
											<div class="captcha form-control">
												<div class="captcha-image">
													<?php
													$_SESSION['captcha'] = simple_php_captcha(array(
														'min_length' => 6,
														'max_length' => 6,
														'min_font_size' => 22,
														'max_font_size' => 22,
														'angle_max' => 3
													));

													$_SESSION['captchaCode'] = $_SESSION['captcha']['code'];

													echo '<img id="captcha-image" src="' . "php/simple-php-captcha/simple-php-captcha.php/" . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
													?>
												</div>
												<div class="captcha-refresh">
													<a href="#" id="refreshCaptcha"><i class="fa fa-refresh"></i></a>
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<input type="text" value="" maxlength="6" data-msg-captcha="Wrong verification code." data-msg-required="Please enter the verification code." placeholder="Opiště kód." class="form-control input-lg captcha-input" name="captcha" id="captcha" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<hr>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<input type="submit" id="contactFormSubmit" value="Send Message" class="btn btn-primary btn-lg pull-right" data-loading-text="Loading...">
									</div>
								</div>
							</form>
						</div>
							
						<div class="col-md-6">

							<h4 class="heading-primary mt-lg">Nebojte se <strong>zeptat!</strong></h4>
							<p>Pokud máte jakýkoliv dotaz neváhejte se na nás obrátit. Rádi zodpovíme každý Váš dotaz! Uvítáme také vaše návrhy a připomínky, které nám pomáhají být stále silnějším partnerem na českém a slovenském trhu.</p>
							<hr>

							<h4 class="heading-primary">Naše <strong>kancelář</strong></h4>
							<ul class="list list-icons list-icons-style-3 mt-xlg">
								<li><i class="fa fa-map-marker"></i> <strong>Address:</strong> Pivovarská 2073, 47001 Česká Lípa, ČR</li>
								<li><i class="fa fa-phone"></i> <strong>Phone:</strong> (+420) 777 981 450</li>
								<li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:donveneris@gmail.com">info@donveneris.cz</a></li>
							</ul>

							<hr>

							

							<div class="row lightbox mt-xl" data-plugin-options='{"delegate": "a", "type": "image", "gallery": {"enabled": true}}'>
								<div class="col-md-4">
									<a class="img-thumbnail" href="img/111.jpg" data-plugin-options='{"type":"image"}'>
										<img class="img-responsive" src="img/111.jpg" alt="Office">
										<span class="zoom">
											<i class="fa fa-search"></i>
										</span>
									</a>
								</div>
								<div class="col-md-4">
									<a class="img-thumbnail" href="img/222.jpg" data-plugin-options='{"type":"image"}'>
										<img class="img-responsive" src="img/222.jpg" alt="Office">
										<span class="zoom">
											<i class="fa fa-search"></i>
										</span>
									</a>
								</div>
								<div class="col-md-4">
									<a class="img-thumbnail" href="img/333.jpg" data-plugin-options='{"type":"image"}'>
										<img class="img-responsive" src="img/333.jpg" alt="Office">
										<span class="zoom">
											<i class="fa fa-search"></i>
										</span>
									</a>
								</div>
							
							</div>

							<hr>

							<h4 class="heading-primary">Provozní <strong>hodiny</strong></h4>
							<ul class="list list-icons list-dark mt-xlg">
								<li><i class="fa fa-clock-o"></i> Pondělí - Pátek 09:00 - 16:00</li>
								
							</ul>

						</div>
					
						<div class="col-md-12">
						<br>	<br>
						<div class="row">
					<div class="col-md-6">
							<div class="testimonial testimonial-primary" data-appear-animation="fadeInLeft" data-appear-animation-delay="500">
								<blockquote>
									<p>Dobrý den, chtěla bych začít vyrábět parfémy vlastní značky. Je v ceně zahrnuto i poradenství pro začínající podnikatele? </p>
								</blockquote>
								<div class="testimonial-arrow-down"></div>
								<div class="testimonial-author">
									<div class="testimonial-author-thumbnail img-thumbnail">
										<img src="img/clients/client-2.jpg" alt="">
									</div>
									<p><strong>Alice Hrzková</strong><span>Quest</span></p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="testimonial testimonial-secondary" data-appear-animation="fadeInRight" data-appear-animation-delay="500">
								<blockquote>
									<p>Samozřejmě! Pokud se stanete naším klientem, rádi vám pomůžeme s kompletní výrobou parfémů. Poradíme od výběru flakonu až po legislativu!</p>
								</blockquote>
								<div class="testimonial-arrow-down"></div>
								<div class="testimonial-author">
									<div class="testimonial-author-thumbnail img-thumbnail">
										<img src="img/clients/client-1.jpg" alt="">
									</div>
									<p><strong>Barbora Soušková</strong><span>Obchodní oddělení</span></p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-9" data-appear-animation-delay="500" data-appear-animation="fadeInLeft">
								<h2>Náš team je vám<strong> kdykoliv k dispozici</strong></h2>
								<h6>
									Stále hledáte odpověď? Neváhejte kontaktovat náš team! Rádi vám poradíme, vysvětlíme nebo doporučíme to nejlepší možné řešení pro Vás!
								</h6>
							</div>
							<div class="col-md-3">
								<img class="hidden-xs img-responsive appear-animation-visible" style="margin-top: -100px;" src="img/updates.png" alt="" data-appear-animation-delay="1200" data-appear-animation="fadeInRight">
							</div>
							</div>
					</div>

				</div>

			</div>

			<section class="call-to-action call-to-action-default with-button-arrow call-to-action-in-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="call-to-action-content">
								<h3>Jsme to <strong>nejlepší</strong> řešení pro všechny <strong>malé</strong> i velké firmy!</h3>
								<p>Přesvědčte se o <strong>kvalitách</strong> DonVeneris i vy! Napište nám a staňte se našim klientem.</p>
							</div>
							<div class="call-to-action-btn">
								<a href="cenik-vyroby-parfemu-kosmetiky.html" target="_blank" class="btn btn-lg btn-primary">O výrobě</a><span class="arrow hlb hidden-xs hidden-sm hidden-md" data-appear-animation="rotateInUpLeft" style="top: -12px;"></span>
							</div>
						</div>
					</div>
				</div>
			</section>

			<footer id="footer">
				<div class="container">
					<div class="row">
						<div class="footer-ribbon">
							<span>Kontakty</span>
						</div>
						<div class="col-md-3">
							<div class="newsletter">
								<h4>Novinky</h4>
								<p>Držte krok s našimi stále se vyvíjejícími funkcemi a technologií našich výrobků.</p>
			
								<div class="alert alert-success hidden" id="newsletterSuccess">
									<strong>Hotovo!</strong> Byl jste přidán k odběru novinek.
								</div>
			
								<div class="alert alert-danger hidden" id="newsletterError"></div>
			
								<form id="newsletterForm" action="php/newsletter-subscribe.php" method="POST">
									<div class="input-group">
										<input class="form-control" placeholder="Email Address" name="newsletterEmail" id="newsletterEmail" type="text">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit">Go!</button>
										</span>
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-3">
							<h4>Poslední tweety</h4>
							<div id="tweet" class="twitter" data-plugin-tweets data-plugin-options='{"username": "DonVeneris", "count": 2}'>
								<p>Please wait...</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="contact-details">
								<h4>Kontaktujte nás</h4>
								<ul class="contact">
									<li><p><i class="fa fa-map-marker"></i> <strong>Address:</strong> Pivovarská 2073, 470 01 Česká Lípa</p></li>
									<li><p><i class="fa fa-phone"></i> <strong>Phone:</strong> (+420) 777 981 450</p></li>
									<li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="info@donveneris.cz">info@donveneris.cz</a></p></li>
									<li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="obchod@donveneris.cz">obchod@donveneris.cz</a></p></li>
								</ul>
							</div>
						</div>
						<div class="col-md-2">
							<h4>Následujte nás</h4>
							<ul class="social-icons">
								<li class="social-icons-facebook"><a href="http://www.facebook.com/DonVeneris" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
								<li class="social-icons-twitter"><a href="http://www.twitter.com/DonVeneris" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="container">
						<div class="row">
							<div class="col-md-1">
								<a href="index.html" class="logo">
									<img alt="Porto Website Template" class="img-responsive" src="img/logo-footer.png">
								</a>
							</div>
							<div class="col-md-7">
								<p>© Copyright 2016. All Rights Reserved.</p>
							</div>
							<div class="col-md-4">
								<nav id="sub-menu">
									<ul>
										<li><a href="page-faq.html">FAQ's</a></li>
										<li><a href="contact-us.html">Contact</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Vendor -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/jquery.appear/jquery.appear.min.js"></script>
		<script src="vendor/jquery.easing/jquery.easing.min.js"></script>
		<script src="vendor/jquery-cookie/jquery-cookie.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/common/common.min.js"></script>
		<script src="vendor/jquery.validation/jquery.validation.min.js"></script>
		<script src="vendor/jquery.stellar/jquery.stellar.min.js"></script>
		<script src="vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
		<script src="vendor/jquery.gmap/jquery.gmap.min.js"></script>
		<script src="vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
		<script src="vendor/isotope/jquery.isotope.min.js"></script>
		<script src="vendor/owl.carousel/owl.carousel.min.js"></script>
		<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="vendor/vide/vide.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>

		<!-- Current Page Vendor and Views -->
		<script src="js/views/view.contact.js"></script>
		
		<!-- Theme Custom -->
		<script src="js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>

		<script src="http://maps.google.com/maps/api/js"></script>
	<script>

			/*
			Map Settings

				Find the Latitude and Longitude of your address:
					- http://universimmedia.pagesperso-orange.fr/geo/loc.htm
					- http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/

			*/

			// Map Markers
			var mapMarkers = [{
				address: "Pivovarská 3157, 470 01",
				html: "<strong>Pivovarská 3157 Kancelář</strong><br>Česká Lípa, 47001",
				icon: {
					image: "img/pin.png",
					iconsize: [26, 46],
					iconanchor: [12, 46]
				},
				popup: true
			}];

			// Map Initial Location
			var initLatitude = 50.68236;
			var initLongitude = 14.54646;

			// Map Extended Settings
			var mapSettings = {
				controls: {
					draggable: (($.browser.mobile) ? false : true),
					panControl: true,
					zoomControl: true,
					mapTypeControl: true,
					scaleControl: true,
					streetViewControl: true,
					overviewMapControl: true
				},
				scrollwheel: false,
				markers: mapMarkers,
				latitude: initLatitude,
				longitude: initLongitude,
				zoom: 16
			};

			var map = $("#googlemaps").gMap(mapSettings);

			// Map Center At
			var mapCenterAt = function(options, e) {
				e.preventDefault();
				$("#googlemaps").gMap("centerAt", options);
			}

		</script>

		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
			ga('create', 'UA-12345678-1', 'auto');
			ga('send', 'pageview');
		</script>
		 -->

	</body>
</html>

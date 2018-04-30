<?php
ob_start();
?>
<!DOCTYPE HTML>
<!-- BEGIN html -->
<html lang = "en">
<!-- BEGIN head -->
<head>
	<title><?php echo $page_title ?></title>
	<!-- Meta Tags -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Web-based information platform that seeks to project people’s positive thoughts, imaginations, knowledge, and experience towards the benefit and education of other people in the society. We are set to ensure this through the showcase of articles, insights of diverse categories and professions, and above all, through the dissemination of public information News to the general public." />
	<meta name="keywords" content="news, board, speck, boardspeck, board speck, training, trainings, insight, campus news, campus, world news, african news, african, africa, nigeria, lagos, mckodev, advertise, web office, web, office, tunse, tworkers, events, programs, event, program, swap, space, data room, factoring company,bail bonds, bail bondsman,bail bonds los angeles, intentions,Insurance, Loans, Mortgage, Attorney, Credit, Lawyer, Donate, Degree, Hosting, Claim, Conference Call, Trading, Software, Recovery, Transfer, Gas/Electicity, Classes, Rehab, Treatment, Cord Blood,">
	<meta name="google-site-verification" content="teMJf1lggL_fqcE-yuhVryJavk92DTijHO9Zet5wePQ" />
	<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5ae4b7436a9348001198613c&product=inline-share-buttons' async='async'></script>
	<?php
	if($page_name == "home"){
		echo '<meta property="og:title" content="BoardSpeck - Home" />
		<meta property="og:image" content="https://boardspeck.com/images/fav.png" />
		<meta property="og:image:width" content="450"/>
		<meta property="og:image:height" content="298"/>
		<meta property="og:description" content="Web-based information platform that seeks to project people’s positive thoughts, imaginations, intentions, knowledge, and experience towards the benefit and education of other people in the society. We are set to ensure this through the showcase of articles, insights of diverse categories and professions, and above all, through the dissemination of public information News to the general public." />';
		echo '<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@boardspeck">
		<meta name="twitter:title" content="Boardspeck - Home">
		<meta name="twitter:description" content="BoardSpeck is an emerging news and information platform, out to provide information to people of different, region, beliefs, cadres and status. ">
		<meta name="twitter:image" content="https://boardspeck.com/images/fav.png">
		<meta name="twitter:image:width" content="280">
		<meta name="twitter:image:height" content="150">';
	}elseif($page_name == "news_post"){
		$bd = previewBody($body, 22);
		$rf = strip_tags($bd);
		echo '<meta property="og:title" content="BoardSpeck - '.$headline.'" />
		<meta property="og:type" content="article" />
		<meta property="og:image" content="https://boardspeck.com/'.$image_1.'" />
		<meta property="og:image:width" content="450"/>
		<meta property="og:image:height" content="298"/>
		<meta property="og:description" content="'.$rf.'" />';
		echo '<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@boardspeck">
		<meta name="twitter:title" content="content="BoardSpeck - '.$headline.'">
		<meta name="twitter:description" content="'.$rf.'">
		<meta name="twitter:image" content="https://boardspeck.com/'.$image_1.'">
		<meta name="twitter:image:width" content="280">
		<meta name="twitter:image:height" content="150">';
	}elseif($page_name == "insight_post"){
		$bd = previewBody($body, 22);
		$rf = strip_tags($bd);
		echo '<meta property="og:title" content="BoardSpeck - '.strtoupper($title).' by '.$author.'" />
		<meta property="og:image" content="https://boardspeck.com/'.$image_1.'" />
		<meta property="og:image:width" content="450"/>
		<meta property="og:image:height" content="298"/>
		<meta property="og:type" content="article" />
		<meta property="og:description" content="'.$rf.'" />';
		echo '<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@boardspeck">
		<meta name="twitter:title" content="BoardSpeck - '.$title.'">
		<meta name="twitter:description" content="'.$rf.'">
		<meta name="twitter:image" content="https://boardspeck.com/'.$image_1.'">
		<meta name="twitter:image:width" content="280">
		<meta name="twitter:image:height" content="150">';
	}elseif($page_name == "event_show"){
		$bd = previewBody($about, 22);
		$rf = strip_tags($bd);
		echo '<meta property="og:title" content="Would you love to attend? - '.$name.' ('.$SDate.')" />
		<meta property="og:description" content="'.$rf.'" />
		<meta property="og:type" content="article" />
		<meta property="og:image" content="https://boardspeck.com/images/fav.png" />';
		echo '<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@boardspeck">
		<meta name="twitter:title" content="content="Would you love to attend? - '.$name.' ('.$SDate.')">
		<meta name="twitter:description" content="'.$rf.'">';
	}elseif($page_name == "view_training"){
		$bd = previewBody($body, 22);
		$rf = strip_tags($bd);
		echo '<meta property="og:title" content="Have you heard of this training? - '.$title.'" />
		<meta property="og:type" content="article" />
		<meta property="og:image" content="https://boardspeck.com/'.$image_1.'" />
		<meta property="og:description" content="'.$rf.'" />';
		echo '<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@boardspeck">
		<meta name="twitter:title" content="content="Have you heard of this training? - '.$title.'">
		<meta name="twitter:image" content="https://boardspeck.com/'.$image_1.'">
		<meta name="twitter:description" content="'.$rf.'">';
	}else{
	}
	?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-116919951-3"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'UA-116919951-3');
</script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
(adsbygoogle = window.adsbygoogle || []).push({
	google_ad_client: "ca-pub-8913707638008127",
	enable_page_level_ads: true
});
</script>
<?php
// 	if($page_name == "article_post"){
// 		$info = getPostInfo($conn,'blog',$_GET['id']);
// 		$bd = previewBody($info['body'], 22);
// 		echo '<meta property="og:title" content="" />
// 		    <meta property="og:image" content=http://philanthropycircuit.com/" />
// 				<meta property="og:image:width" content="450"/>
// 		<meta property="og:image:height" content="298"/>
// 		<meta property="og:description" content="" />';
//
// echo '<meta name="twitter:card" content="summary_large_image">
// <meta name="twitter:site" content="@mckodev">
// <meta name="twitter:title" content="'.$info['title'].'">
// <meta name="twitter:description" content="'.$bd.'">
// <meta name="twitter:image" content="http://philanthropycircuit.com/'.$info['image_1'].'">
// <meta name="twitter:image:width" content="280">
// <meta name="twitter:image:height" content="150">';
// 	}
//
// 	elseif($page_name == "insight_post"){
// 		$info = getPostInfo($conn,'insight',$_GET['id']);
// 		$bd = previewBody($info['body'], 22);
// 		echo '<meta property="og:title" content="'.$info['title'].'" />
// 		    <meta property="og:image" content=http://philanthropycircuit.com/'.$info['image_1'].'" />
// 				<meta property="og:image:width" content="450"/>
// 		<meta property="og:image:height" content="298"/>
// 		<meta property="og:description" content="'.$bd.'" />';
//
// echo '<meta name="twitter:card" content="summary_large_image">
// <meta name="twitter:site" content="@mckodev">
// <meta name="twitter:title" content="'.$info['title'].'">
// <meta name="twitter:description" content="'.$bd.'">
// <meta name="twitter:image" content="http://philanthropycircuit.com/'.$info['image_1'].'">
// <meta name="twitter:image:width" content="280">
// <meta name="twitter:image:height" content="150">';
// }else{
//
//
//
// 	echo '<meta property="og:title" content="'.$page_title.'" />
// 			<meta property="og:image" content=http://philanthropycircuit.com/" />
// 			<meta property="og:image:width" content="450"/>
// 	<meta property="og:image:height" content="298"/>
// 	<meta property="og:description" content="" />';
//
// echo '<meta name="twitter:card" content="summary_large_image">
// <meta name="twitter:site" content="@mckodev">
// <meta name="twitter:title" content="'.$page_title.'">
// <meta name="twitter:description" content="">
// <meta name="twitter:image" content="http://philanthropycircuit.com/">
// <meta name="twitter:image:width" content="280">
// <meta name="twitter:image:height" content="150">';
// }
?>
<!-- Favicon -->
<link rel="shortcut icon" href="images/fav.png" type="image/x-icon" />
<!-- Stylesheets -->
<link type="text/css" rel="stylesheet" href="//fonts.googleapis.com/css?family=Montserrat:400,700+Open+Sans:400,700" />
<link type="text/css" rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons" />
<link type="text/css" rel="stylesheet" href="css/reset.min.css" />
<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" />
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="css/owl.carousel.css" />
<link type="text/css" rel="stylesheet" href="css/animate.css" />
<link type="text/css" rel="stylesheet" href="css/main-stylesheet.min.css" />
<link type="text/css" rel="stylesheet" href="css/ot-lightbox.min.css" />
<link type="text/css" rel="stylesheet" href="css/shortcodes.min.css" />
<link type="text/css" rel="stylesheet" href="css/responsive.min.css" />
<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5a9fde7b9c502900133c1aba&product=inline-share-buttons"></script>
<!-- END head -->
</head>
<!-- BEGIN body -->
<!-- <body> -->
<body class="ot-menu-will-follow">
	<!-- BEGIN .boxed -->
	<div class="boxed">
		<!-- BEGIN .header -->
		<div class="header">
			<!-- BEGIN .wrapper -->
			<div class="wrapper">
				<nav class="header-top">
					<div class="header-content">
						<div class="header-content-logo">
							<a href="#"><img alt="boardspeck" src="images/logo4.png" width="200" height="100"  /></a>
						</div>
						<div class="header-content-o">
							<!--<a href="#" target="_blank"><img src="images/o1.jpg" alt="" /></a>-->
							<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<!-- box ads -->
							<ins class="adsbygoogle"
							style="display:block"
							data-ad-client="ca-pub-8913707638008127"
							data-ad-slot="9737468736"
							data-ad-format="auto"></ins>
							<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</div>
					</div>
					<div class="main-menu-placeholder wrapper">
						<nav id="main-menu">
							<ul>
								<li><a href="index">Homepage</a>
								</li>
								<li><a href="about">About</a></li>
								<li><a href="#"><span>Features</span></a>
									<ul class="sub-menu">
										<!-- <li><a href="#">Witness Report</a></li> -->
										<li><a href="articles">Articles</a></li>
										<li><a href="insight">Insignts</a>
											<ul class="sub-menu">
												<?php fetchFeatureLink($conn,'insights') ?>
											</ul></li>
										</ul>
									</li>
									<li><a href="#"><span>Latest</span></a>
										<ul class="sub-menu ot-mega-menu">
											<li class="lets-do-4">
												<div class="widget-split item">
													<!-- BEGIN .widget -->
													<div class="widget">
														<div class="widget-split item">
															<div class="widget">
																<h3>Latest Insight</h3>
																<div class="widget-content ot-w-article-list">
																	<?php getInsightHeader($conn) ?>
																</div>
															</div>
														</div>
														<!-- END .widget -->
													</div>
												</div>
												<div class="widget-split item">
													<div class="widget">
														<h3>Latest Campus News</h3>
														<div class="widget-content ot-w-article-list">
															<?php getCampusNewsHeader($conn) ?>
														</div>
													</div>
												</div>
												<div class="widget-split item">
													<div class="widget">
														<h3>Latest News</h3>
														<div class="widget-content ot-w-article-list">
															<?php 	getNewsHeader($conn, 'gia5235e9940N73ir') ?>
															<!-- <div class="item">
															<div class="item-header">
															<a href="#" class="img-read-later-button rm-btn-small">Read later</a>
															<a href="#"><img src="images/photos/image-18.jpg" alt="" /></a>
														</div>
														<div class="item-content">
														<h4><a href="#">Meet DC's Legends of Tomorrow</a></h4>
														<span class="item-meta">
														<span class="item-meta-item"><i class="material-icons">access_time</i>January 12, 2015</span>
													</span>
												</div>
											</div>
											<div class="item">
											<div class="item-header">
											<a href="#" class="img-read-later-button rm-btn-small">Read later</a>
											<a href="#"><img src="images/photos/image-19.jpg" alt="" /></a>
										</div>
										<div class="item-content">
										<h4><a href="#">YOU DECIDE: The Best Movie of 2015!</a></h4>
										<span class="item-meta">
										<span class="item-meta-item"><i class="material-icons">access_time</i>January 12, 2015</span>
									</span>
								</div>
							</div> -->
						</div>
					</div>
				</div>
				<div class="widget-split item">
					<div class="widget">
						<div class="widget-split item">
							<div class="widget">
								<h3>Latest Global News</h3>
								<div class="widget-content ot-w-article-list">
									<?php 	getNewsHeader($conn, '8a8ol2G34157b07l') ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>
	</li>
	<li><a href="#"><span>News</span></a>
		<ul class="sub-menu">
			<?php fetchNewsLink($conn,'news') ?>
			<!-- <li><a href="global">Global</a></li>
			<li><a href="africa">Africa</a></li>
			<li><a href="global">Nigeria</a></li> -->
		</ul>
	</li>
	<li><a href="#"><span>Opportunities</span></a>
		<ul class="sub-menu">
			<li><a href="trainings">Trainings</a></li>
			<li><a href="view_event">Programs/Seminars</a></li>
		</ul>
	</li>
	<!-- <li><a href="team">Our Team</a></li> -->
	<!-- <li><a href="archive">Report Event</a></li> -->
	<li><a href="campus"><span>Campus</span></a>
		<ul class="sub-menu">
			<li><a href="#">News</a>
				<ul class="sub-menu">
					<?php fetchCampusLink($conn,'campus_news','news') ?>
				</ul>
			</li>
			<li><a href="#">Articles</a>
				<ul class="sub-menu">
					<?php fetchCampusLink($conn,'campus_articles','article') ?>
				</ul>
			</li>
		</ul>
	</li>
	<li><a href="contact">Contact us</a></li>
</ul>
</nav>
</div>
<!-- END .wrapper -->
</div>
<!-- END .header -->
</div>

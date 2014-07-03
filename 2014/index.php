<?php
	require_once("class.events.php");
	$event = new Events();
	$next = $event->getNextEvent();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>LocationTech Tour | LocationTech</title>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href='//fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css'>
    <link href="assets/css/styles.css" rel="stylesheet" media="screen">

    <link rel="stylesheet" href="components/Leaflet/leaflet.css" />
    <link rel="stylesheet" href="components/Leaflet.label/leaflet.label.css" />

		<meta name="description" content="List of upcoming LocationTech Tour events." />
		<meta name="keywords" content="locationtech tour, locationtech events" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="components/html5shiv/dist/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div id="map" class="visible-md visible-lg">
      <div class="container">
          <div class="row"></div>
      </div>
    </div><!-- /#header-map -->

    <div class="navbar" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="//tour.locationtech.org/"><img src="assets/images/logo.jpg"/></a>
        </div>
        <div class="collapse navbar-collapse pull-right" id="main-menu-bar">
          <ul class="nav navbar-nav">
            <li><a title="Home" href="http://locationtech.org/">Home</a></li>
						<li><a title="Technology" href="http://www.locationtech.org/list-of-projects">Technology</a></li>
						<li><a title="A list of Sponsors" href="http://tour.locationtech.org/2014/sponsors.php">Sponsors</a></li>
						<li><a title="Members" href="http://locationtech.org/members">Members</a></li>
						<li><a title="Events" href="http://locationtech.org/meetings">Events</a></li>
						<li><a title="About Us" href="http://locationtech.org/about">About Us</a></li>
					</ul>
					<!--  <span class="visible-lg pull-right"><?php print $next['registration'];?></span> -->
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div id="main-content">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div id="next-event" class="col-md-12">
							<div id="event-header">
								<h2>Next Event<img src="assets/images/location-sm-icon16x16.gif" alt="locationtech logo"/>
								  <span id="event-location"><?php print $next['city']?></span>
								</h2>
							</div>
							<div class="clearfix visible-xs"></div>
							<div class="col-md-9" id="sponsorship-info">
								<h3>Information</h3>
								<p><strong>Date:</strong> <?php print $next['date_formatted'];?></p>
								<p><?php print $next['body'];?></p>
								<p><?php print $next['registration'];?></p>
								<h3>Speak at an event</h3>
                                                                <p><a href="https://docs.google.com/forms/d/1uqqHpHjtiGCf5WGeNzn_oZWCh-fpAoO1h5s-VfF31sA/viewform">Propose a talk</a></p>
								<h3>Sponsorship Prices</h3>
                <p>Sponsorship is available for single events, or the entire tour (see below).</p>

								<h4>Evening only events</h4>
								<p><strong class="contrast">Single event:</strong> $500 for non-members/$250 for members<br/>

								<h4>Full day events</h4>
								<p><strong class="contrast">Single event:</strong> $1000 for non-members/$500 for members<br/>

								<h4>Sponsor ALL events in the tour</h4>
								<p><strong class="contrast">Entire Tour:</strong> $2K for members/$4.5K for non-members</br>
                <p><a href="mailto:info@locationtech.org">
                	<strong class="contrast">Contact us about sponsoring</strong></a>
                </p>
                <p><a href="http://tour.locationtech.org/2014/assets/agreement/LocationTech_Tour2014_sponsor_agreement.pdf">
                        <strong class="contrast">Sponsor Agreement</strong></a>
                </p>
							</div>
							<div class="visible-md visible-lg col-md-3" id="sponsorship-picture">
								<img src="assets/images/cities/<?php print $next['image'];?>" alt="<?php print $next['city'];?> picture"/>
							</div>

							<div class="clearfix"></div>
							<div id="twitter-feed" class="hidden-xs">
							  <h3>Tweets about "#locationtechtour"</h3>
            	  	<a class="twitter-timeline"  href="//twitter.com/search?q=%23locationtechtour"  data-theme="" data-link-color="" width="" height="" data-chrome="noheader noborders noscrollbar transparent" data-border-color="" lang="" data-tweet-limit="6" data-related="" aria-polite="polite" data-widget-id="375619339128274945">Tweets about "#locationtechtour"</a>
						  </div>
            </div>
          </div><!--/span-->
          <div class="col-md-4 col-md-offset-2" id="other-dates">
          	<div class="row">
						  <div class="col-md-12">
        				<h2>Upcoming Events</h2>
        			</div>
        		</div>
						<div class="row" id="other-dates-container">
						  <div class="col-xs-12">
        				<?php print $event->getFutureEvents();?>

        				<h2>Past Events</h2>
        				<?php print $event->getPastEvents();?>

        				<div class="clearfix"></div>
        				<div class="container">
						  		<span class="st_sharethis_large" displayText="ShareThis"></span>
									<span class="st_facebook_large" displayText="Facebook"></span>
									<span class="st_twitter_large" displayText="Tweet"></span>
									<span class="st_linkedin_large" displayText="LinkedIn"></span>
									<span class="st_plusone_large" displayText="Google +1"></span>
									<span class="st_email_large" displayText="Email"></span>
								</div>
       				</div>
      		  </div>
         	</div><!--/span-->
        </div>
      </div>
    </div>

		<?php include_once('assets/tpl/sponsors.tpl.php');?>

    <footer>
      <div class="container">
        <div class="row">
        	<div class="col-md-8">
          	<div class="col-md-4 col-sm-4">
            	<h4>Sitemap</h4>
            	<ul class="list-unstyled">
            		<li><a title="Home" href="http://locationtech.org/">Home</a></li>
								<li><a title="Projects" href="http://locationtech.org/projects">Projects</a></li>
								<li><a title="Members" href="http://locationtech.org/members">Members</a></li>
								<li><a title="Events" href="http://locationtech.org/meetings">Events</a></li>
								<li><a title="2013 Tour Archive" href="http://tour.locationtech.org/2014/">2013 Tour Archive</a></li>
								<li><a title="Contact Us" href="http://locationtech.org/content/contact-us">Contact Us</a></li>
								<li><a title="About Us" href="http://locationtech.org/about">About Us</a></li>
							</ul>
    	      </div>
      	    <div class="col-md-4 col-sm-4">
        	    <h4>Speakers list</h4>
          	  <ul class="list-unstyled">
            	  <li><a href="https://locationtechnewyork1.eventbrite.com/">Juan Marin, CTO, Boundless</a></li>
            	  <li><a href="https://locationtechnewyork1.eventbrite.com/">Jonathan Simms, Senior Software Engineer, Twitter</a></li>
		  <li><a href="http://locationtechdc1.eventbrite.com/">Eric Gundersen, CEO, Mapbox</a></li>
            	  <li><a href="https://locationtechnewyork1.eventbrite.com/">David Blackman, Senior Software Engineer, Foursquare</a></li>
		  <li><a href="http://locationtechdc1.eventbrite.com/">Charlie Greenbacker, Principal Data Scientist, Altamira</a></li>
<!--
            	  <li><a href="https://locationtechnewyork1.eventbrite.com/">Ed Parsons, Ed Parsons, Geospatial Technologist, Google</a></li>
-->
            	</ul>
	          </div>
  	        <div class="col-md-4 col-sm-4">
    	        <h4>Events</h4>
      	      <ul class="list-unstyled">
      	      	<?php foreach($event->getEvents() as $e) :?>
        	      	<?php print '<li><a href="' . $e['url'] . '">' . $e['city'] . '</a></li>';?>
        	      <?php endforeach; ?>
    	        </ul>
      	    	</div>
        	  </div>
        	  <div class="clearfix visible-sm"></div>
        	  <div class="col-md-4  col-sm-12">
          	<div id="reach-us" class="col-xs-12">
            	<h4>To reach us</h4>
            	<!--
          	  ### PLEASE UPDATE THIS SECTION ###
	            <p>Vivamus porttitor auctor dignissim. Suspendisse non odio quis elit consequat condimentum. Duis iaculis condimentum odio vitae pulvinar.</p>
  	          <p>Please feel free to call her at (613) 555-5555 or send an e-mail to:<br/> <a href="mailto:info@locationtech.org">info@locationtech.org</a>.</p>
    	      	-->
    	      	<ul class="list-inline">
      	    		<li><a href="https://twitter.com/locationtech" target="_blank"><img src="assets/images/social/social_twitter.gif" alt="Follow us on Twitter"/></a></li>
        	  		<li><a href="https://www.facebook.com/groups/401867609865450/" target="_blank"><img src="assets/images/social/social_facebook.gif" alt="Follow us on Facebook"/></a></li>
          		  <li><a href="http://www.linkedin.com/groups/LocationTech-4503139" target="_blank"><img src="assets/images/social/social_linkedin.gif" alt="Follow us on LinkedIn"/></a></li>
          		  <li><a href="https://plus.google.com/105965637326150724888" target="_blank"><img src="assets/images/social/social_google.gif" alt="Follow us on google"/></a></li>
          		</ul>
          	</div>
        	</div>
        </div>
        <div class="row">
        	<div class="col-xs-12">
        		<div id="copyright">Copyright LocationTech &copy; <?php print date('Y');?></div>
        	</div>
      	</div>
      </div>
    </footer>

		<!--jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="components/jquery/jquery.js"><\/script>')</script>

    <script src="components/bootstrap/js/bootstrap.min.js"></script>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

    <!-- leaflet.js -->
    <script src="components/Leaflet/leaflet.js"></script>
    <script src="components/Leaflet.label/leaflet.label.js"></script>
    <script type="text/javascript">
    	var map = L.map('map', {
    		 maxZoom: 7,
    	   minZoom: 1,
    	   scrollWheelZoom: false
      }).setView([40.000000, -55.310000], 3);
   	 	map.doubleClickZoom.disable();
    	L.tileLayer('//api.tiles.mapbox.com/v3/locationtech.i600ihhm/{z}/{x}/{y}.png256', {
    	attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">MapBox</a>',
    	}).addTo(map);
    	<?php print $event->getJavascript();?>
    </script>

		<!-- Sharethis -->
		<script type="text/javascript">var switchTo5x=false;</script>
		<script type="text/javascript" src="//w.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript">stLight.options({publisher: "6f497309-e36c-40c0-af5d-85683e681bdd", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>

    <!-- Google Analytics -->
    <script>
      var _gaq=[['_setAccount','UA-910670-10'],['_trackPageview']];
      (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
      g.src='//www.google-analytics.com/ga.js';
      s.parentNode.insertBefore(g,s)}(document,'script'));
    </script>

  </body>
</html>


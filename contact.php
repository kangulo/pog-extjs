<?php
/**
* @author  Kevin Angulo <kevinangulo@gmail.com> - Kayak Innovations, C.A. 
* @link  http://pogextjs.comyr.com/
* @copyright  Offered under the  BSD license- Kayak Innovations, C.A.
* @abstract  Php Object Generator automatically generates clean and tested Object Oriented code for your PHP4/PHP5 application.
*/
include "./include/class.misc.php";
include "./include/configuration.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="/ico/favicon.ico">

	<title>Php Object Generator (<?=$GLOBALS['configuration']['versionNumber']?><?=$GLOBALS['configuration']['revisionNumber']?>) - Open Source PHP Code Generator</title>

	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="css/dashboard.css" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<link href="css/style.css" rel="stylesheet">
	<!-- Just for debugging purposes. Don't actually copy this line! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
		<!-- Docs master nav -->
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span></button>
				<a class="navbar-brand" href="index.php">POG + ExtJS</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="#contact">Contact</a></li>
				</ul>
				<form class="navbar-form navbar-right">
					<input class="form-control" placeholder="Search..." type=
					"text">
				</form>
			</div>
		</div>
	</div>
<div class="container">
	<br>
	<br>
	<br>
  <div class="row">
    <div class="col-sm-4">
      <h3>
        Contact Me!
      </h3>
      <hr>
      <address>
        <strong>
          Email:
        </strong>
        
        <a href="mailto:kevinangulo@gmail.com">
          kevinangulo@gmail.com
        </a>
        <br>
        <br>
        <strong>
          Phone:
        </strong>
        (555)123-4567
      </address>
    </div>
    
    <div class="col-sm-8 contact-form">
		<?php
        // check for a successful form post
        if (isset($_GET['s'])) echo "<div class=\"alert alert-success\">".$_GET['s']."</div>";
        // check for a form error
        elseif (isset($_GET['e'])) echo "<div class=\"alert alert-error\">".$_GET['e']."</div>";
		?>
      <form id="contact" method="post" action="mailer.php" class="form" role="form">
        <div class="row">
          <div class="col-xs-12 col-md-12 form-group">
            <input class="form-control" id="subject" name="subject" placeholder="POG+ExtJS" value="POG+ExtJS" type="text"/>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6 col-md-6 form-group">
            <input class="form-control" id="name" name="name" placeholder="Name" type="text" required autofocus />
          </div>
          <div class="col-xs-6 col-md-6 form-group">
            <input class="form-control" id="email" name="email" placeholder="Email" type="email" required />
          </div>
        </div>
        <textarea class="form-control" id="message" name="message" placeholder="Message" rows="5"></textarea>
        <br />
        <div class="row">
          <div class="col-xs-12 col-md-12 form-group">
            <button class="btn btn-primary pull-right" type="submit">
              Submit
            </button>
          </div>
        </div>
      </form>
    </div>
    </div><!-- row -->
</div><!-- container -->
</body>
</html>

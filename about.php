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
<body data-spy="scroll" data-target="#navegacion">
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
					<li><a href="#about">About</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
				<form class="navbar-form navbar-right">
					<input class="form-control" placeholder="Search..." type=
					"text">
				</form>
			</div>
		</div>
	</div>

    <div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar" id="navegacion">
				<ul class="nav nav-sidebar">
					<li class="active"><a href="#what-section">What is POG+ExtJS</a></li>
					<li class=""><a href="#how-section">How Use it?</a></li>
					<li class=""><a href="#wishlist-section">Wishlist</a></li>
					<li class=""><a href="#troubleshooting-section">Troubleshooting</a></li>
				</ul>
			</div>
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<section id="what-section">
						<h1 class="page-header">
							About POG+ExtJS
						</h1>
						<h2 class="sub-header">
							What is POG+ExtJS?
							<small>
							RAD Tool for developers
							</small>
						</h2>
						<p>
							Over the years, we realized that a large portion of a PHP programmer's time is wasted on repetitive coding of the Database Access Layer of an application simply because different applications require different objects. 
						</p>
						<p>
							Sencha Ext JS is the leading standard for business-grade web application development. With over 100 examples, 1000 APIs, hundreds of components, a full documentation suite and built in themes, Ext JS provides the tools necessary to build robust desktop applications. Ext JS also brings a rich data package that allows developers to use a model-view-controller (MVC) architecture when building their app. The MVC leverages features like Big Data Grids enabling an entirely new level of interactivity in web apps. 
						</p>
						<ul>
							<li>
								<strong>
								POG+ExtJS
								</strong>
								is a powerful tool that combines the power and flexibility of PHP with the versatility of ExtJS to create your own CRUD forms and pieces of code, totally functional, just doing a couple clicks and ready to go.
							</li>
							<li>
								<strong>
								POG+ExtJS
								</strong>
								is a online tool with a simple interface to build a crud form in just three steps:
								<ol>
									<li>
										Select you type of CRUD Form.
									</li>
									<li>
										Name your object.
									</li>
									<li>
										Define your attributes.
									</li>
								</ol>
							</li>
							<li>
								<strong>
								POG+ExtJS
								</strong>
								Works with the server-side and client-sidefor, POG+ExtJS Generates for you more than 1000 code lines, that save some time isn't? That time you can use it in others aspects of your project.
							</li>
							<li>
								<strong>
								POG+ExtJS
								</strong>
								Make applications prototype quickly with clean and tested code.
							</li>
							<li>
								<strong>
								POG+ExtJS
								</strong>
								It requires no installation and no configuration.
							</li>
							<li>
								<strong>
								POG+ExtJS
								</strong>
								Runs over Apache, works with Php5, MySQL &amp; Secha ExtJS version 3+
							</li>
							<li>
								<strong>
								POG+ExtJS
								</strong>
								Use a (Model-View-Controller design) that make the code more readable, scalable, and maintainable.
							</li>
							<li>
								<strong>
								POG+ExtJS
								</strong>
								Its Open Source
							</li>
						</ul>
						<p>
							<a class="btn btn-small btn-primary" href="generator.php" type="button">
							<span class='glyphicon glyphicon-play'>
							</span>
							Try it!
							</a>
						</p>
					</section>

					<section class="tooltip-examples" id="how-section">
						<br><br>
						<div class="page-header">
							<h1>How Use it? <small>Simple and Easy</small></h1>
						</div>
						<ol>
							<li>
								<p>Follow the three steps previously.
									<a class="text-primary" href="generator.php" type="button"><span class='glyphicon glyphicon-play'></span> Try it!</a>
								</p>
							</li>
							<li><strong>POG+ExtJS</strong> generate a zip file with a folder that have a predefined structure</li>
							</p>
							<li>
								<p>Once downloaded, uncompressed file and copy the folder into your www directory.</p>
							</li>
							<li>
								<p>You must set permissions to the directory to write and to read. (chmod -R 777 /var/www/myapp)</p>
							</li>
							<li>
								<p>Once uncompressed you'll see something like this:</p>
							</li>
							<div class="highlight">
<pre><code class="bash"><strong>myapp</strong>/
├── class/				PHP Classes.
│   ├── class.database.php
│   ├── class.pog_base.php
│   └── <strong>class.myapp.php</strong>
├── controllers/			PHP Controller
│   └── <strong>controller.myapp.php</strong>
├── css/				Style Sheets
├── <label class="label label-danger">extjs/</label>				ExtJS Framework Library <strong>NOT INCLUDE! !important</strong>
├── images/				Images,icons, logos
├── js/
│   └── <strong>myapp.js</strong>			Extjs File Generated
├── <strong>myapp.html</strong>				HTML File Generated
├── configuration.php 			<strong>You must to edit with server, database and connection information</strong>
└── readme.txt
	</code>
	</pre>
							</div>
							<li>Edit <strong>configuration.php</strong> file and change your server and database connection parameters </li>
							<div class="highlight">
								<pre><code class="bash">&lt;?php
	.
	.
	$configuration['db']	= 'test';		//	<- <strong>database name</strong>
	$configuration['host'] 	= 'localhost';		//	<- <strong>database host</strong>
	$configuration['user'] 	= 'root';		//	<- <strong>database user</strong>
	$configuration['pass']	= 'abc123';		//	<- <strong>database password</strong>
	$configuration['port']	= '3306';		//	<- <strong>database port</strong>
	.
	.
?&gt;</code>
	</pre>
							</div>
							<li>Edit <strong>myapp/class/class.myapp.php</strong> file and copy the sql block to create table in database</li>
							<div class="highlight">
								<pre><code class="bash">&lt;?php
	/*
	This SQL query will create the table to store your object.

	CREATE TABLE `myapp` (
	`co_myapp` int(11) NOT NULL auto_increment,
	`name` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`age` INT NOT NULL,
	`address` VARCHAR(255) NOT NULL, PRIMARY KEY  (`co_myapp`)) ENGINE=MyISAM;
	*/
?&gt;</code>
	</pre>
							</div>
							<li>Run your app <code>http://localhost/myapp</code>.</li>
						</ol>
						<p>
							<a class="btn btn-small btn-primary" href="generator.php" type="button"><span class='glyphicon glyphicon-play'></span> Try it!</a>
						</p>
					</section>
					
					<section class="tooltip-examples" id="wishlist-section">
						<br><br>
						<div class="page-header">
							<h1>Wishlist</h1>
						</div>
						<ul>
							<li>Another forms and miniapplications.</li>
							<li>Reports and Charts</li>
						</ul>
					</section>
					
					<section class="tooltip-examples" id="troubleshooting-section">
						<br><br>
						<div class="page-header">
							<h1>Troubleshooting </h1>
						</div>
						<p>Check ExtJS Framework path.</p>
						<div class="highlight">
							<pre><code class="html">&lt;!-- ExtJS library: all widgets MOODE: DEBUG --&gt;
				&lt;script type="text/javascript" src="<strong>extjs-4.2</strong>/ext-all-debug.js"&gt;&lt;/script&gt; 
							</code></pre>
						</div>
					</section>
			</div>
		</div><!-- row -->
	</div><!-- container -->
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>

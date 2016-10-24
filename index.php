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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Php Object Generator (v<?=$GLOBALS['configuration']['versionNumber']?><?=$GLOBALS['configuration']['revisionNumber']?>) - Open Source ExtJs Code Generator</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
      <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link href="css/style.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">

        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">POG + ExtJS</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>


    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" src="img/slide-01.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>What is POG+ExtJS?</h1>
              <p class="lead">Is a RAD tool that will save you time of development, it can make a simple web application or a group of them, using <a href='http://www.phpobjectgenerator.com'>POG Php Object Generator</a> + <a href="http://www.sencha.com/products/extjs/" target="_blank">ExtJS</a> Javascript Framework to make since database table to interface in easy way and quickly just doing a couple of clicks.</p>
              <p>
				  <a class="btn btn-lg btn-primary" href="#" role="button"><span class='icons icons-medium'>h</span> Learn More</a>&nbsp;
				  <a class="btn btn-lg btn-success" href="#opciones" role="button"><span class='glyphicon glyphicon-play'></span> Get Started</a>
              </p>
            </div>
          </div>
        </div>
        <div class="item">
          <img data-src="holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" src="img/slide-02.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Do it simple, fast and clean in less time.</h1>
              <p class="lead">Generates ExtJS Applications fully functionally with clean and tested code for ExtJS Applications and you can choose from several kind of CRUD forms, also has support for differents ExtJS versions. ExtJS code, Php Classes and Controller even a structure definition of the database table.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button"><span class='icons icons-medium'>h</span> Learn More</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img data-src="holder.js/900x500/auto/#555:#5a5a5a/text:Third slide" src="img/slide-03.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Generates Php Code</h1>
              <p>POG+ExtJS works with MVC Model, Create Php Classes and Controller for databases objects with CRUD methods. Based in <a href='http://www.phpobjectgenerator.com' target='_blank'>POG</a> code, POG+ExtJS create all files and you can download it and just paste the files in your www directory and ready!</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button"><span class='icons icons-medium'>h</span> Learn More</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img data-src="holder.js/900x500/auto/#444:#4a4a4a/text:Four slide" src="img/slide-04.jpg" alt="Four slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Free Open Source.</h1>
              <p>For everyone in the community who wants to improve this tool, to make into something that allows us to create easily prototype form with ExtJS as FrontEnd in the Client-Side and <a href="http://www.php.net/" target="_balnk">Php</a> + <a href="http://www.mysql.com" target="_balnk">Mysql</a> in the Server-Side.</p>
              <p>
			  <a class="btn btn-lg btn-primary" href='https://github.com/kangulo/pog-extjs' target='_blank' role="button"><span class='icons-medium icon-github'></span> Github Repository</a>&nbsp;
              <a class="btn btn-lg btn-success" href='https://github.com/kangulo/pog-extjs/archive/master.zip' target='_blank' role="button"><span class="glyphicon glyphicon-cloud-download"></span> Download Now!</a>
              </p>              
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->

    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    <div class="container marketing">
      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
		  <h1 class="icons icons-giant icons-rounded">/</h1>
          <h2>All in One</h2>          
          <p class="text-justify">Everything you need in one package including three powerful tools:</p>
          <ul class="text-justify">
			<li><strong>ExtJS</strong> specially designed for web-based interface applicacions, to build the front-end.</li>
			<li><strong>Php</strong> for manage database objects and classes.</li>
			<li><strong>MySQL</strong> as database manager.</li>
		  </ul>
          <p><a class="btn btn-default" href="http://www.sencha.com/products/extjs/" role="button" target="_blank">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->        
        <div class="col-lg-4">
          <h1 class="icons icons-giant icons-rounded">K</h1>
          <h2>Save Time</h2>
          <p>POG+ExtJS generates more than 1000 automatically code lines for you. Also you can forget about syntax errors. The time you save can be spent on more interesting areas of your project.<br> Once you got your product you can do changes and improvements.</p>
          <p><a class="btn btn-default" href="http://www.php.net/" role="button" target="_blank">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->        
        <div class="col-lg-4">
		  <h1 class="icons icons-giant icons-rounded">j</h1>          
          <h2>Improving your productivity</h2>
          <p>Make quickly prototype for applications, just in minutes, with the basic operations like create, read, update and destroy or delete.
          <br>By generating PHP objects with integrated CRUD methods plus ExtJS interface, POG+ExtJS gives you a head start in any project.</p>
          <p><a class="btn btn-default" href="http://www.mysql.com" role="button" target="_blank">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->
	<section id='opciones'>
      <hr class="featurette-divider">
      
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading" style="margin-top: 30px;">RowEditor Grid.</h2><span class="label label-success">ExtJS v3.2</span>
          <p class="lead">A RESTful Store with JsonWriter which automatically generates CRUD requests to the server with some plugins: RowEditor &amp; Filtering.</p>
          <a class="btn btn-small btn-primary" href="generator.php?extjsVersion=31#object-section" type="button"><span class='glyphicon glyphicon-play'></span> Try it!</a>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" src="img/RowEditor.png" alt="Generic placeholder image">
        </div>
      </div>
	  <p></p>
	  <p class="pull-right"><a href="#">Back to top</a></p>
      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-5">
          <img class="featurette-image img-responsive" data-src="holder.js/656x468/auto" src="img/FormBinding.png" alt="Generic placeholder image">
        </div>
        <div class="col-md-7">
          <h2 class="featurette-heading" style="margin-top: 30px;">FormBinding.</h2><span class="label label-success">ExtJS v3.+</span>
          <p class="lead">A grid embedded within a FormPanel that automatically loads records into the form on row selection.</p>
          <a class="btn btn-small btn-primary" href="generator.php?extjsVersion=30#object-section" type="button"><span class='glyphicon glyphicon-play'></span> Try it!</a>
        </div>
      </div>
	  <p></p>
	  <p class="pull-right"><a href="#">Back to top</a></p>
      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading" style="margin-top: 30px;">FormBinding 4.2 <small><small><span class="text-success new">New!</span></small></small> </h2>
		  <span class="label label-success">ExtJS v4.+</span> 
          <p class="lead">A grid embedded within a FormPanel that automatically loads records into the form on row selection. With Neptune Theme</p>
          <a class="btn btn-small btn-primary" href="generator.php?extjsVersion=42#object-section" type="button"><span class='glyphicon glyphicon-play'></span> Try it!</a>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" src="img/FormBinding42.png" alt="Generic placeholder image">
        </div>
      </div>
      <p></p>
	  <p class="pull-right"><a href="#">Back to top</a></p>
      <hr class="featurette-divider">
      
      <div class="row featurette">
        <div class="col-md-5">
          <img class="featurette-image img-responsive" data-src="holder.js/656x468/auto" src="img/FormBinding.png" alt="Generic placeholder image">
        </div>
        <div class="col-md-7">
            <h2 class="featurette-heading" style="margin-top: 30px;">Responsive Design</h2><span class="label label-success">Jquery</span>&nbsp;<span class="label label-success">Bootstrap</span>
          <p class="lead">Mode Listview with action buttons per record</p>
          <a class="btn btn-small btn-primary" href="generator.php?extjsVersion=JQB#object-section" type="button"><span class='glyphicon glyphicon-play'></span> Try it!</a>
        </div>
      </div>
	  <p></p>
	  <p class="pull-right"><a href="#">Back to top</a></p>
      <hr class="featurette-divider">
	</section>
      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
      <footer>
<!--
        <p class="pull-right"><a href="#">Back to top</a></p>
-->
        <p><a href="mailto:kevinangulo@gmail.com">Kevin Angulo</a> &middot; &copy; 2014 Kayak Innovations,C.A. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="../../assets/js/docs.min.js"></script>
  </body>
</html>

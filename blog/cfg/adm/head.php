<!DOCTYPE html>
<html>
<head>
<title><?php print $title; ?></title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap Core CSS -->
    <link href="<?php print $url; ?>css/bootstrap.css" rel="stylesheet">
    <!--link href="<?php print $url; ?>css/bootstrap.min.css" rel="stylesheet"-->


	<!-- Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">

    <!-- Custom CSS -->
    <!--link href="<?php print $url; ?>css/carousel-home.css" rel="stylesheet"-->
    <link href="<?php print $url; ?>css/w3-light.css" rel="stylesheet">
    <link href="<?php print $url; ?>css/login-modal.css" rel="stylesheet">
    <link href="<?php print $url; ?>css/stile.css" rel="stylesheet">
    <link href="<?php print $url; ?>css/lightbox.min.css" rel="stylesheet"> 


	<style type="text/css">
            .modal-dialog {}
.thumbnail {margin-bottom:6px;}

.carousel-control.left,.carousel-control.right{
  background-image:none;
  margin-top:10%;
  width:5%;
}
        </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



</head>
<body id="myPage">


  
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		
		<div class="container-fluid">
			
			<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
			<a class="navbar-brand" href="<?php print $url;?>cfg/index.php" style="background-color: #046D04; color: #fff"> ADMIN</a>
			</div>
			
			<div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">

					<li>
					<a href="<?php print $urlAdm;?>new_post.php">New post</a>
					</li>

					<li>
					<a href="<?php print $urlAdm;?>new_album.php">New album</a>
					</li>

					<li>
					<a href="<?php print $urlAdm;?>new_img.php">New pic</a>
					</li>

				</ul>					
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php print $url;?>cfg/logout.php"><span class="glyphicon glyphicon-log-in"></span> LOGOUT</a></li>
				</ul>

            </div>
            <!-- /.navbar-collapse -->
        
    </nav>



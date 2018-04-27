<?php
// cookie language (expiring time: 30 days)
if(!isset($_COOKIE["lingua"]) && !isset($ling)) {
	$ling = "en";
	setcookie("lingua",$ling, time() + (86400 * 900), "/");
} else {
	$ling=$_COOKIE["lingua"];
}
if(isset($_GET['ling']) && $_GET['ling']!=$ling){
	$cookie_name = "user";
	$ling = $_GET['ling'];
	setcookie("lingua",$ling, time() + (86400 * 900), "/");
}
$lang_file=$url."languages/".$ling.".php";
include_once $lang_file;

// blog article -> title
if(isset($titleEN) && isset($titleEN) && isset($idArt) && $idArt>0){
	$title="BlogName | ".$titleEN;	
	if ($ling=="it"){ $title="BlogName | ".$titleIT; }
	}
?>




<!DOCTYPE html>
<html>
<head>
<title><?php print $title; ?></title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="Distribution" content="Global" />
	<meta name="author" content="Author" />
	<meta http-equiv="Reply-to" content="BlogName@BlogName" />
	<meta name="Robots" content="ALL" />

    <!-- Bootstrap Core CSS -->
    <link href="<?php print $url; ?>css/bootstrap.css" rel="stylesheet">
    <!--link href="<?php print $url; ?>css/bootstrap.min.css" rel="stylesheet"-->

    <!-- jQuery -->
    <script src="<?php print $url;?>js/jquery-3.2.1.min.js"></script>
    <script src="<?php print $url;?>js/lightbox-plus-jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php print $url;?>js/bootstrap.min.js"></script>

	<!-- Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">

    <!-- Custom CSS -->
    <link href="<?php print $url; ?>css/login-modal.css" rel="stylesheet">
    <link href="<?php print $url; ?>css/stile.css" rel="stylesheet">
    <link href="<?php print $url; ?>css/lightbox.min.css" rel="stylesheet"> 


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


	<!-- disabilita click destro mouse -->
    <script type="text/javascript">

        $(document).ready(function () {

            //Disable full page

            $("body").on("contextmenu",function(e){

                alert("Right click functionality is disabled for this page.");

                return false;

            });        

        });

     </script>

	<!-- disabilita taglia copia e incolla -->
    <script type="text/javascript">

        $(document).ready(function () {       

           //Disable cut copy paste

            $('body').bind('cut copy paste', function (e) {

                alert("Cut, copy and paste functionalities are disabled for this page.");

                e.preventDefault();

            });       

        });

     </script>


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
			<a class="navbar-brand" href="<?php print $url;?>index.php" style="background-color: #D20808; color: #fff"> BlogName</a>
			</div>
			
			<div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">

					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php print $lang['MEN_NEWS'];?><span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php print $url;?>index.php#post" ><?php print $lang['NEWS_LPOST'];?></a></li>
							<li><a href="<?php print $url;?>index.php#album" ><?php print $lang['NEWS_ALBUM'];?></a></li>
							<li><a href="<?php print $url;?>index.php#tag" ><?php print $lang['NEWS_TAG'];?></a></li>
						</ul>
					</li>

					<li>
						<a href="<?php print $url;?>blog/index.php" ><?php print $lang['MEN_BLOG'];?></a>
					</li>

				</ul>
					
				<ul class="nav navbar-nav navbar-right">

					<li class="active">
						<?php
						// id articolo?
						$idRead="";
						if(isset($_GET['idArt']) && $_GET['idArt']>0){ $idRead="&idArt=".$_GET['idArt'];}
						// id tag?
						if(isset($_GET['tag']) && $_GET['tag']!=""){ $idRead="&tag=".trim($_GET['tag']);}
						// search
						if(isset($_POST['w']) && $_POST['w']!=""){ $idRead="&w=".trim($_POST['w']);}

						// lingua
						if ($ling=="en"){
						print "<li><a href='?ling=it";
						}
						else{
						print "<li><a href='?ling=en";
						}
						print $idRead."' title='Click to change'><img src='".$url."lay/".$ling.".gif'> ".$lang['MEN_LANG']."</a></li>";
						?>
					</li>


					<li><a href="#" data-toggle="modal" data-target="#login-modal"><span class="glyphicon glyphicon-log-in"></span> Admin</a></li>
				</ul>

            </div>
            <!-- /.navbar-collapse -->
        
    </nav>



<!-- privacy policy -->
<?php
$bannerLinkURL=$url."cfg/cookpol_".$ling.".php";
$bannerMessage="This site uses <i>cookies</i> to deliver its services.";
$bannerLinkText="Read more";
$bannerButton="OK, understood!";
if ($ling=="it"){
$bannerMessage="Questo sito usa i <i>cookies</i> per funzionare.";
$bannerLinkText="Scopri di più";
$bannerButton="OK, capito!";
}
echo "<script type='text/javascript'>";

print "
C = {
    // Number of days before the cookie expires, and the banner reappears
    cookieDuration : 14,

    // Name of our cookie
    cookieName: 'complianceCookie',

    // Value of cookie
    cookieValue: 'on',

    // Message banner title
    bannerTitle: 'Cookies policy',

    // Message banner message
    bannerMessage: '".$bannerMessage."',

    // Message banner dismiss button
    bannerButton: '".$bannerButton."',

    // Link to your cookie policy.
    bannerLinkURL: '".$bannerLinkURL."',

    // Link text
    bannerLinkText: '".$bannerLinkText."',

    // Text alignment
    alertAlign: 'center',
    
    // Link text
    buttonClass: 'btn-success btn-xs',    

    createDiv: function () {
        var banner = $(
            '<div class=\"alert alert-success alert-dismissible text-'+
             this.alertAlign +' fade in\" ' +
            'role=\"alert\" style=\"position: fixed; bottom: 0; width: 100%; ' +
            'margin-bottom: 0\"><strong>' + this.bannerTitle + '</strong> ' +
            this.bannerMessage + ' <a href=\"' + this.bannerLinkURL + '\">' +
            this.bannerLinkText + '</a> <button type=\"button\" class=\"btn ' +
             this.buttonClass + '\" onclick=\"C.createCookie(C.cookieName, C.cookieValue' +
            ', C.cookieDuration)\" data-dismiss=\"alert\" aria-label=\"Close\">' +
            this.bannerButton + '</button></div>'
        )
        $('body').append(banner)
    },

    createCookie: function(name, value, days) {
        //console.log('Create cookie')
        var expires = ''
        if (days) {
            var date = new Date()
            date.setTime(date.getTime() + (days*24*60*60*1000))
            expires = '; expires=' + date.toGMTString()
        }
        document.cookie = name + '=' + value + expires + '; path=/';
    },

    checkCookie: function(name) {
        var nameEQ = name + '='
        var ca = document.cookie.split(';')
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i]
            while (c.charAt(0)==' ')
                c = c.substring(1, c.length)
            if (c.indexOf(nameEQ) == 0) 
                return c.substring(nameEQ.length, c.length)
        }
        return null
    },

    init: function() {
        if (this.checkCookie(this.cookieName) != this.cookieValue)
            this.createDiv()
    }
}

$(document).ready(function() {
    C.init()
})
";
echo "</script>"; 
?>

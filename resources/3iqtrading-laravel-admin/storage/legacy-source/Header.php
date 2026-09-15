<?php 
session_start();
include('SiteConfig.php');
?>
  <header>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">   
<meta name="viewport" content="width=device-width, user-scalable=no"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@1&display=swap" rel="stylesheet">

  <style>
  *{
      font-family: 'Merriweather', serif;

  }
  
  .form-group{
      margin-bottom: 20px;
            margin-top: 10px;

  }
.navbar-inverse{
background: <?php echo $Background; ?>;
color: white;

}
  .HasError{
	  border: 1px solid red;
	  background: #ff0;
  }
  .dark{
	  
	  background: #666;
	  color: #eee;
	  
  }
    body {
  font-family: IBM Plex Sans;
}
    @media screen and (min-width: 600px){
	 .navbar-collapse{
		 float: right;
		 margin-right: 1cm
	 } 
  }
    .display-7 {
  font-family: 'Jost', sans-serif;
  font-size: 1.5rem;
  line-height: 1.9;
}

.hasError{
background: #ff0;
border: 1px solid #f00;
}

.center{
	text-align: center;
}
.center1{
	float: center;

.bigText{
	font-size: 40pt;
}
.bigText1{
	font-size: 35pt;
}
.red{
	background:#f00;
}

  </style>
 
  </header>
    

<nav class="navbar-inverse" role="navigation">
 <div class="navbar-header">
 <a class="navbar-brand" href="#" style="color: white"><?php echo $SiteName; ?></a>
 </div>
 <div class="collapse navbar-collapse" id="example-navbar-collapse">
 <ul class="nav navbar-nav">
 <li class=""><a href="Index.php">HOME</a></li>
 <?php if(isset($_SESSION['Agent_id'])){
	 echo '<li><a href="#Contract.php">MY CLIENTS</a></li>

 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 OTHERS <b class="caret"></b>
 </a>
 <ul class="dropdown-menu">
 <li><a href="Logout.php">LOGOUT</a></li>
 </ul>
 </li>
 
	 
	 ';
 }else{
	 
	 echo '
	  <li><a data-toggle="modal" data-target="#myModal"href="#">LOGIN</a></li>
	 <li><a href="Index.php">SIGNUP</a></li>

	 ';
 } ?>

 </ul>
 </div>
</nav>


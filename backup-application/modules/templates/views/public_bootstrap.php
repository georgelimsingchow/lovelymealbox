<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fast Food Online</title>
    <!-- Bootstrap -->

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
  <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
 <!--  <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
  <link href="<?php echo base_url();?>assets/css/bootstrap-social.css" rel="stylesheet" type="text/css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" >




  <!-- CUSTOM -->
  <!-- Important Owl stylesheet -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/owl-carousel/owl.carousel.css">
  <!-- Default Theme -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/owl-carousel/owl.theme.css">
  <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <script>

//  global variable
var HTTP_HOST = window.location.host;
var channelURL = '';
if (HTTP_HOST == 'localhost.com') {
  channelURL = 'http://localhost.com/food_2_user';
}else{
  channelURL = 'http://www.lovelymealbox.com';
};

  logInWithFacebook = function() {
    FB.login(function(response) {
      if (response.authResponse) {
        // alert('You are logged in &amp; cookie set!');
        // Now you can redirect the user or do an AJAX request to
        // a PHP script that grabs the signed request from the cookie.
        window.location.href = channelURL+"/login/fb_login";
      } else {
        alert('User cancelled login or did not fully authorize.');
      }
    }, {scope: 'email,user_friends,public_profile'});
    return false;
  };

    window.fbAsyncInit = function() {
      FB.init({
        appId      : '<?php echo $this->config->item("facebook_app_id");?>',
        version    : 'v2.7',
        cookie     : true
      });
    };

    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "//connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  </script>
<header>
  <div id="top">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6" id="top-bar-left">
          <ul class="top_links">
            <li><a class="link"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;010 975 3899</a></li>
            <li><a href="https://www.facebook.com/mymealboxdelivery" class="link"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-6" id="top-bar-right">
          <ul class="top_links">
            <!-- <li><a href="" class="link">RM 400.00</a></li> -->
            <?php if ( ! $this->session->userdata('customer_logged_in')){?>
              <li><a href="<?php echo base_url();?>register" class="link">Register</a></li>
              <li><a href="<?php echo base_url();?>login" class="link">Login</a></li>
            <?php }else{ ?>
              <li><a class="link"><?php echo get_account_no($this->session->customer_id);?></a></li>
              <li><a class="link"><?php echo $name;?></a></li>
              <li><a class="link">RM <?php 
                      $total_amount = get_amount($this->session->customer_id);
                      echo $total_amount ? $total_amount : '0.00';
                      ?></a></li>
              <li><a href="<?php echo base_url();?>account" class="link">Account</a></li>              
              <li><a href="<?php echo base_url();?>cart" class="link">Cart</a></li>
              <li><a href="<?php echo base_url();?>logout" class="link">Logout</a></li>
            <?php } ?> 
            
          </ul>
        </div>
      </div>      
    </div> 
  </div>
  <div id="mid_logo" class="hidden-sm hidden-xs">
    <div class="container ">
      <div class="row">
        
        <div class="col-md-12">
        <a href="<?php echo base_url();?>home" id="logo_box">
          <img src="<?php echo base_url();?>assets/images/logo.png" class="img-responsive">
          <p id="slogan" class="hidden-xs">Lovely Mealbox Deliver to your doorstep</p>
        </a>
          
        </div>
      </div>
    </div>
  </div>
<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">    
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand hidden-lg hidden-md hidden-sm" href="<?php echo base_url();?>home">LOVELYMEAL BOX</a>
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav" id="main_nav">        
        <li class="<?php if($this->uri->uri_string() == 'home') echo "active";?>"><a href="<?php echo base_url()?>home" class="menu_link" >MEAL BOX</a></li>

        <li class="dropdown <?php if($this->uri->segment(1) == 'catering') echo "active";?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CATERING <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()?>catering/monthly_catering">MONTHLY CATERING</a></li>
            <li><a href="<?php echo base_url()?>catering/buffet_catering">BUFFET CATERING</a></li>            
          </ul>
        </li>

        <li class="<?php if($this->uri->segment(2) == 'order') echo "active";?> "><a href="<?php echo base_url()?>how/order" class="menu_link">HOW TO ORDER</a></li>
        <li class="<?php if($this->uri->segment(2) == 'reload') echo "active";?> "><a href="<?php echo base_url()?>how/reload" class="menu_link">HOW TO RELOAD</a></li>
        <li><a href="<?php echo base_url()?>faq" class="menu_link">DELIVERY AREA</a></li>
        <li class="<?php if($this->uri->uri_string() == 'contact') echo "active";?> "><a href="<?php echo base_url()?>contact" class="menu_link">CONTACT US</a></li>
        <li class="<?php if($this->uri->uri_string() == 'faq') echo "active";?> "><a href="<?php echo base_url()?>faq" class="menu_link">FAQ</a></li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>

<div id="content-wrapper">
  <?php if (isset($view_file)) {$this->load->view($view_module.'/'.$view_file);} ?>

</div>
<footer>
    <div class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4  col-md-2 col-sm-4 col-xs-12">
                    <h3> Shortcuts </h3>
                    <ul>
                        <li> <a href="<?php echo base_url();?>home"> Meal Box </a> </li>
                        <li> <a href="<?php echo base_url();?>catering/buffet_catering"> Buffet Catering </a> </li>
                        <li> <a href="<?php echo base_url();?>catering/monthly_catering"> Monthly Catering </a> </li>
                        <!-- <li> <a href="<?php echo base_url();?>home"> Terms & Condition </a> </li> -->
                    </ul>
                </div>
                <div class="col-lg-4  col-md-2 col-sm-4 col-xs-12">
                    <h3> CONTACT INFO </h3>
                    <p><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;010 975 3899</p>
                    <p><i class="fa fa-whatsapp" aria-hidden="true"></i>&nbsp;&nbsp;010 975 3899</p>
                    <p><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;&nbsp;support@lovelymealbox.com</p>

                </div>



                <div class="col-lg-4  col-md-2 col-sm-4 col-xs-12">
                    <h3> Legal Stuff</h3>
                    <ul>
                        <li> <a href="<?php echo base_url();?>privacy"> Privacy Policy </a> </li>
                        <!-- <li> <a href="#"> Terms of Service </a> </li> -->
<!--                         <li> <a href="#"> Terms & Condition </a> </li> -->
                    </ul>
                </div>
            </div>
            <!--/.row--> 
        </div>
        <!--/.container--> 
    </div>
    <!--/.footer-->
    
    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left"> Copyright © Lovely Meal Box 2016. All right reserved. </p>
        </div>
    </div>
    <!--/.footer-bottom--> 
</footer>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
  <script src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>

  <!-- Include js plugin -->
  <script src="<?php echo base_url();?>assets/owl-carousel/owl.carousel.js"></script>
  
<!-- BEGIN PAGE LEVEL PLUGINS -->
  <script src="<?php echo base_url();?>assets/js/moment.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/js/plugins/jquery.countdown/jquery.countdown.js"></script>
  <script src="<?php echo base_url();?>assets/js/plugins/jquery.countdown/jquery.countdown.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/plugins/touchspin/jquery.bootstrap-touchspin.js"></script>
  <!-- END PAGE LEVEL PLUGINS -->

  <!-- Include all compiled plugins (below), or include individual files as needed --> 
  <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
  <script src="<?php echo base_url();?>assets/js/custom.js"></script>
  </body>
</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report</title>
    <!-- Bootstrap -->

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
  <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
 <!--  <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
  <link href="<?php echo base_url();?>assets/css/bootstrap-social.css" rel="stylesheet" type="text/css">

<style>
.foo {
  outline: 1px solid black;
  min-height:100px;
}
</style>



  <!-- CUSTOM -->
  <!-- Important Owl stylesheet -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  <!-- Default Theme -->
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <?php if (isset($view_file)) {$this->load->view($view_module.'/'.$view_file);} ?>
  
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
  <script src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed --> 
  <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
  </body>
</html>
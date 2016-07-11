<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Reserva -  Online Reservation System</title>
    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- site css -->
    <link rel="stylesheet" href="bower_components/Bootflat/css/site.min.css">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="bower_components/Bootflat/js.php5shiv.js"></script>
      <script src="bower_components/Bootflat/js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="js/site.min.js"></script>
    <style> 
      .calendar .days .dates .unit{
        color:green;
      }
      .calendar .days .unit.full,.calendar .days .unit.disabled,.calendar .days .unit.holiday{
        color:red;
      }
    </style>
  </head>
  <body>
  	<div class="container">
  		<div class="row">
  			<div class="col-md-12 text-center">
  				<h1><a href="index.php">Reserva</a></h1>
  				<p>Online Reservation System</p>
  			</div>
  		</div>
  		<div class="row" style="margin-top:10rem;">
  		  <div class="col-md-6 col-md-offset-3">
              <form action="" class="form-vertical col-md-12 text-center">
                  <div class="form-group">
                    <label for="">USERNAME</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="">PASSWORD</label>
                    <input type="password" class="form-control">
                  </div>
              </form>  
              <div class="col-md-6"><button class="btn btn-default pull-left">CANCEL</button></div>
               <div class="col-md-6"><button class="btn btn-primary pull-right">LOGIN</button></div>
        </div>

  		</div>
  	</div>
     <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
  </body>
  </html>
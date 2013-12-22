
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Dashboard of Indicators</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for dashboard template -->
    <link href="css/dashboard.css" rel="stylesheet">

    <!-- Custom styles for leaflet -->
    <link href="css/leaflet.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--a class="navbar-brand" href="#">Dashboard of Indicators</a-->
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav" style="float:right;">
            <li id="dashboard-link"><a class="main-navigation-item" href="#sectors">Dashboard</a></li>
            <li id="map-link"><a class="main-navigation-item" href="#map">Map</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div id="dashboard-container" class="container sector-body"></div>
    <div id="map-container" class="container sector-body"></div>

    <script type="text/javascript">
      document.write('\x3Cscript data-main="js/main.js?'+new Date().getTime()+'" src="js/lib/require.js">\x3C/script>');
    </script>
    
  </body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UTC - Landing Page</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 70px;
            /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
        }

        .form-group div {
            position:relative;
            margin-right:15px;
        }
        .form-group div:after {
            position:absolute;
            content:'*';
            color:red;
            right:-10px;
            top:0;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">UTC</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>

            <form class="navbar-form navbar-right" method="post" action="/logout">
            <i class="glyphicon glyphicon-user white"></i>
            <font style="color:#FFFFFF;font-size:10px;padding-right:5px;"><?php echo $_SESSION['user']; ?></font>
            <input id="logout" type="submit" class="btn btn-success" value="Logout">
            </form>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1>Simple Url Builder</h1>
            <form>
                <!==  =CONCATENATE(E1,
                P1,if(isblank(U1),"REQUIRED FIELD",upper(U1)),
                H1,if(isblank(I1),"REQUIRED FIELD",lower(I1)),
                J1,if(isblank(K1),"REQUIRED FIELD",lower(K1)),
                F1,if(isblank(G1),"REQUIRED FIELD",lower(G1)),
                if(isblank(O1),"",N1&lower(O1)),
                if(isblank(M1),"",L1&lower(M1)))
                ==>
                <div class="form-group">
                    <label for="baseUrl">Base URL (E)<span style="color:red;">*</span></label>
                    <input type="url" class="form-control" id="baseUrl" placeholder="Base Url" required="required">
                </div>
                <div class="form-group">
                    <label for="inputU">gps-source (U)<span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="inputU" placeholder="gps-source" required="required">
                </div>
                <div class="form-group">
                    <label for="inputI">utm_medium (I)<span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="inputI" placeholder="utm_medium" required="required">
                </div>
                <div class="form-group">
                    <label for="inputK">utm_source (K)<span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="inputK" placeholder="utm_source" required="required">
                </div>
                <div class="form-group">
                    <label for="inputG">utm_campaign (G)<span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="inputG" placeholder="utm_campaign" required="required">
                </div>
                <div class="form-group">
                    <label for="inputO">utm_term (O)</label>
                    <input type="text" class="form-control" id="inputO" placeholder="utm_term">
                </div>
                <div class="form-group">
                    <label for="inputP">utm_content (M)</label>
                    <input type="text" class="form-control" id="inputP" placeholder="utm_content">
                </div>
                <div class="text-muted"><em><span style="color:red;">*</span> Indicates required field</em></div>
                <br />
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="3rdParty/jquery/jquery-1.11.2.min.js"><\/script>')</script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>

</body>

</html>

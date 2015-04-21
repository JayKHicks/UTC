<?php $adminUser = true; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UCT - Landing Page</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 70px;
            /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
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
            <a class="navbar-brand" href="#">UCT</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">Market</a>
                </li>
            </ul>

            <form class="navbar-form navbar-right" method="post" action="logout">
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
            <form class="form-horizontal">
                <!--  =CONCATENATE(E1,
                P1,if(isblank(U1),"REQUIRED FIELD",upper(U1)),
                H1,if(isblank(I1),"REQUIRED FIELD",lower(I1)),
                J1,if(isblank(K1),"REQUIRED FIELD",lower(K1)),
                F1,if(isblank(G1),"REQUIRED FIELD",lower(G1)),
                if(isblank(O1),"",N1&lower(O1)),
                if(isblank(M1),"",L1&lower(M1)))

                U = Q.R.S.T
                Q=K
                R=I
                S=G
                U = K.I.G.T
                -->

                <div class="form-group">
                    <label for="baseUrl" class="col-sm-2 control-label">Base URL<span style="color:red;">*</span></label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control" id="BaseURL" placeholder="Base URL" readonly="readonly">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="collapse" data-target="#demo"><span class="caret"></span></button>
                                <!--
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                -->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <?php if ($adminUser) {?>
                            <a class="add" href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                        <?php }?>
                    </div>
                </div>

                <div id="demo" class="collapse out">
                    <div class="col-sm-2">&nbsp;</div>
                    <div class="panel panel-default col-sm-9">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="inputK" class="col-sm-2 control-label">Market<span style="color:red;">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="inputK" placeholder="Market" required="required">
                                        <option value=""></option>
                                        <option value="one">exacttarget</option>
                                        <option value="two">Optln</option>
                                        <option value="three">NJTransit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputK" class="col-sm-2 control-label">Host<span style="color:red;">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="inputK" placeholder="URL Host" required="required">
                                        <option value=""></option>
                                        <option value="one">exacttarget</option>
                                        <option value="two">Optln</option>
                                        <option value="three">NJTransit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputK" class="col-sm-2 control-label">Path<span style="color:red;">*</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="inputK" placeholder="URL Path" required="required">
                                        <option value=""></option>
                                        <option value="one">exacttarget</option>
                                        <option value="two">Optln</option>
                                        <option value="three">NJTransit</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputI" class="col-sm-2 control-label">Campaign Medium<span style="color:red;">*</span></label>
                    <div class="col-sm-9">
                    <select class="form-control" id="inputI" placeholder="Campaign Medium" required="required">
                        <option value=""></option>
                        <option value="AFF">affiliate</option>
                        <option value="BA">display</option>
                        <option value="DML">direct-mail</option>
                        <option value="EML">email</option>
                        <option value="FSI">fsi</option>
                        <option value="MOB">mobile</option>
                        <option value="OFF">offline-other</option>
                        <option value="OOH">out-of-home</option>
                        <option value="PPC">ppc</option>
                        <option value="PRT">print-ad</option>
                        <option value="RAD">radio</option>
                        <option value="SOC">social</option>
                        <option value="TVN">tv</option>
                        <option value="five">overlay</option>
                    </select>
                        </div>
                    <div class="col-sm-1">
                    <a class="add" href="#">
                        <?php if ($adminUser) {?>
                            <a class="add" href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                        <?php }?>
                    </a>
                    </div>
                </div>

                <!-- existing modal -->
                <div id="existingModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Existing Values</h4>
                            </div>
                            <div class="modal-body">
                                <p>Do you want to save changes you made to document before closing?</p>
                                <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Modal -->
                <div id="addModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Add </h4>
                            </div>
                            <div class="modal-body">
                                <p>Do you want to save changes you made to document before closing?</p>
                                <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- URL Modal -->
                <div id="urlModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">URL Builder </h4>
                            </div>
                            <div class="modal-body">
                                <p>Do you want to save changes you made to document before closing?</p>
                                <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputK" class="col-sm-2 control-label">Campaign Source<span style="color:red;">*</span></label>
                    <div class="col-sm-9">
                    <select class="form-control" id="inputK" placeholder="Campaign Source" required="required">
                        <option value=""></option>
                        <option value="one">exacttarget</option>
                        <option value="two">Optln</option>
                        <option value="three">NJTransit</option>
                    </select>
                    </div>
                    <div class="col-sm-1">
                        <a class="add" href="#">
                            <?php if ($adminUser) {?>
                                <a class="add" href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                            <?php }?>
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputG" class="col-sm-2 control-label">Campaign Name<span style="color:red;">*</span></label>
                    <div class="col-sm-9">
                    <select class="form-control" id="inputG" placeholder="Campaign Name" required="required">
                        <option value=""></option>
                        <option value="one">341</option>
                        <option value="two">AL1065</option>
                        <option value="three">AP1702</option>
                        <option value="one">AP1711</option>
                        <option value="two">AP_1638</option>
                        <option value="three">AR1050</option>
                    </select>
                        </div>
                    <div class="col-sm-1">
                    <a class="add" href="#">
                        <?php if ($adminUser) {?>
                            <a class="add" href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                        <?php }?>
                    </a>
                        </div>
                </div>
                <div class="form-group">
                    <label for="inputO" class="col-sm-2 control-label">Campaign Term</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="inputK" placeholder="Campaign Term" required="required">
                            <option value=""></option>
                            <option value="one">exacttarget</option>
                            <option value="two">Optln</option>
                            <option value="three">NJTransit</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                    <a class="search" href="#">
                        <?php if ($adminUser) {?>
                            <a class="add" href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                        <?php }?>
                    </a>
                        </div>
                </div>
                <div class="form-group">
                    <label for="inputP" class="col-sm-2 control-label">Campaign Content</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="inputK" placeholder="Path" required="required">
                            <option value=""></option>
                            <option value="one">exacttarget</option>
                            <option value="two">Optln</option>
                            <option value="three">NJTransit</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                    <a class="search" href="#">
                        <?php if ($adminUser) {?>
                            <a class="add" href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                        <?php }?>
                    </a>
                        </div>
                </div>
                <div class="form-group">
                    <label for="inputU" class="col-sm-2 control-label">gps-source<span style="color:red;">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-control" id="inputK" placeholder="gps-source" required="required">
                            <option value=""></option>
                            <option value="one">exacttarget</option>
                            <option value="two">Optln</option>
                            <option value="three">NJTransit</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <a class="search" href="#">
                            <?php if ($adminUser) {?>
                                <a class="add" href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
                            <?php }?>
                        </a>
                    </div>
                </div>
                <div class="text-muted"><em><span style="color:red;">*</span> Indicates required field</em></div>
                <br />
                <button type="submit" class="btn btn-primary" disabled>Submit</button>
                <button class="btn btn-primary">Clear</button>

            </form>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="3rdParty/jquery/jquery-1.11.2.min.js"><\/script>')</script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".add").on('click', function () {
            //$('#existingModal').removeData('bs.modal');
            //$('#existingModal').modal({remote: 'some/new/context?p=' + $(this).attr('buttonAttr') });
            $('#addModal').modal('show');
        });

        /**
        $(".search").on('click', function () {
            //$('#existingModal').removeData('bs.modal');
            //$('#existingModal').modal({remote: 'some/new/context?p=' + $(this).attr('buttonAttr') });
            $('#existingModal').modal('show');
        });
        */

        $(".url").on('click', function () {
            //$('#existingModal').removeData('bs.modal');
            //$('#existingModal').modal({remote: 'some/new/context?p=' + $(this).attr('buttonAttr') });
            $('#urlModal').modal('show');
        });
    });
</script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="js/ie10-viewport-bug-workaround.js"></script>

</body>

</html>

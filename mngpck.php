<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once'adds/scripts.php'; ?>
    <?php include_once'adds/javascripts.php'; ?>
    
    <script type="text/javascript" src="fullcalendar/lib/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="js/tether.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script> -->
    
</head>


<body>

    <?php include_once'adds/nav.php'; ?>
    
    <!-- Page Content -->
    <div class="container">
        <br>
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-md-12">
            <h3>Menu List</h3>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Course Meal
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#app" data-toggle="tab" class="active">Appetizer</a>
                                </li>
                                <li class="nav-item"><a href="#ent" data-toggle="tab">Entrée</a>
                                </li>
                                <li class="nav-item"><a href="#mai" data-toggle="tab">Main course</a>
                                </li>
                                <li class="nav-item"><a href="#des" data-toggle="tab">Dessert</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="app">
                                    <h4>Appetizer [<a data-toggle="modal" data-target="#appm">Add</a>]</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
<!--                                             <th>Code</th> -->
                                            <th>Name</th>
                                            <th>Variety</th>
                                            <th>Price/Serve</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $appid1; ?>
                                    </tbody>
                                </table>
                            </div>
                                </div>
                                <div class="tab-pane fade" id="ent">
                                    <h4>Entrée [<a data-toggle="modal" data-target="#appm1">Add</a>]</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
<!--                                             <th>Code</th> -->
                                            <th>Name</th>
                                            <th>Variety</th>
                                            <th>Price/Serve</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $appid2; ?>
                                    </tbody>
                                </table>
                            </div>
                                </div>
                                <div class="tab-pane fade" id="mai">
                                    <h4>Main course [<a data-toggle="modal" data-target="#appm2">Add</a>]</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                    <thead>
                                        <tr>
                                            <th>#</th>
<!--                                             <th>Code</th> -->
                                            <th>Name</th>
                                            <th>Variety</th>
                                            <th>Price/Serve</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $appid3; ?>
                                    </tbody>
                                </table>
                            </div>
                                </div>
                                <div class="tab-pane fade" id="des">
                                    <h4>Dessert [<a data-toggle="modal" data-target="#appm3">Add</a>]</h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                                    <thead>
                                        <tr>
                                            <th>#</th>
<!--                                             <th>Code</th> -->
                                            <th>Name</th>
                                            <th>Variety</th>
                                            <th>Price/Serve</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $appid4; ?>
                                    </tbody>
                                </table>
                            </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
        </div>
        <!-- /.row -->
<!-- Modal -->
<div class="modal fade" id="appm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Appetizer</h4>
      </div>
      <div class="modal-body">
            <form method="post" action="action.php?act=addapp&vid=1" enctype="multipart/form-data" role="form">
                <fieldset>
                    <div class="form-group">
                    <input class="form-control" placeholder="Name" name="mnname" id="mnname" onblur="checkmnname();" required>
                    <span id="mnnamestatus" class="status"></span>
                    </div>
                    
                    <div class="form-group">
                        <label>Variety</label>
                        <select class="form-control" name="mnvar" id="mnvar" required>
                            <option value="Dips">Dips</option>
                            <option value="Vegetable and Fruit Trays">Vegetable and Fruit Trays</option>
                            <option value="Meal and Cheese Trays">Meal and Cheese Trays</option>
                            <option value="Hot Appetizers">Hot Appetizers</option>
                        </select>
                    </div>
                    
                    <div class="form-group input-group">
                    <span class="input-group-addon">₱</span>
                    <input type="text" class="form-control" name="mnpps" id="mnpps" onkeyup="restrict('mnpps')" maxlength="4" required>
                    <span class="input-group-addon">.00</span>
                    </div>
                    <input type="submit" value="Add" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="appm1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Entree</h4>
      </div>
      <div class="modal-body">
            <form method="post" action="action.php?act=addapp&vid=2" enctype="multipart/form-data" role="form">
                <fieldset>
                    <div class="form-group">
                    <input class="form-control" placeholder="Name" name="mnname" id="mnname" onblur="checkmnname();" required>
                    <span id="mnnamestatus" class="status"></span>
                    </div>
                    
                    <div class="form-group">
                        <label>Variety</label>
                        <select class="form-control" name="mnvar" id="mnvar" required>
                            <option value="Chicken">Chicken</option>
                            <option value="Beef">Beef</option>
                            <option value="Pork">Pork</option>
                            <option value="Pasta">Pasta</option>
                        </select>
                    </div>
                    
                    <div class="form-group input-group">
                    <span class="input-group-addon">₱</span>
                    <input type="text" class="form-control" name="mnppsz" id="mnppsz" onkeyup="restrict('mnppsz')" maxlength="4" required>
                    <span class="input-group-addon">.00</span>
                    </div>
                    <input type="submit" value="Add" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="appm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Main Course</h4>
      </div>
      <div class="modal-body">
            <form method="post" action="action.php?act=addapp&vid=3" enctype="multipart/form-data" role="form">
                <fieldset>
                    <div class="form-group">
                    <input class="form-control" placeholder="Name" name="mnname" id="mnname" onblur="checkmnname();" required>
                    <span id="mnnamestatus" class="status"></span>
                    </div>
                    
                    <div class="form-group">
                        <label>Variety</label>
                        <select class="form-control" name="mnvar" id="mnvar" required>
                            <option value="Chicken">Chicken</option>
                            <option value="Beef">Beef</option>
                            <option value="Pork">Pork</option>
                            <option value="Seafood">Seafood</option>
                            <option value="Pasta">Pasta</option>
                            <option value="Vegetable">Vegetable </option>
                        </select>
                    </div>
                    
                    <div class="form-group input-group">
                    <span class="input-group-addon">₱</span>
                    <input type="text" class="form-control" name="mnppsx" id="mnppsx" onkeyup="restrict('mnppsx')" maxlength="4" required>
                    <span class="input-group-addon">.00</span>
                    </div>
                    <input type="submit" value="Add" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="appm3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myModalLabel">Dessert</h4>
      </div>
      <div class="modal-body">
            <form method="post" action="action.php?act=addapp&vid=4" enctype="multipart/form-data" role="form">
                <fieldset>
                    <div class="form-group">
                    <input class="form-control" placeholder="Name" name="mnname" id="mnname" onblur="checkmnname();" required>
                    <span id="mnnamestatus" class="status"></span>
                    </div>
                    
                    <div class="form-group">
                        <label>Variety</label>
                        <select class="form-control" name="mnvar" id="mnvar" required>
                            <option value="Custards and Puddings">Custards and Puddings</option>
                            <option value="Frozen Desserts">Frozen Desserts</option>
                            <option value="Cakes">Cakes</option>
                            <option value="Pies">Pies</option>
                            <option value="Cookies">Cookies</option>
                            <option value="Chocolates and Candies">Chocolates and Candies</option>
                            <option value="Pastries">Pastries</option>
                            <option value="Miscellaneous Desserts">Miscellaneous Desserts</option>
                        </select>
                    </div>
                    
                    <div class="form-group input-group">
                    <span class="input-group-addon">₱</span>
                    <input type="text" class="form-control" name="mnppsc" id="mnppsc" onkeyup="restrict('mnppsc')" maxlength="4" required>
                    <span class="input-group-addon">.00</span>
                    </div>
                    <input type="submit" value="Add" class="btn btn-md btn-success btn-block" />
                </fieldset>
            </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

        <br />
        <br />
        <br />
        <br />

    </div>
    <!-- /.container -->

</body>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    $(document).ready(function() {
        $('#dataTables-example1').dataTable();
    });
    $(document).ready(function() {
        $('#dataTables-example2').dataTable();
    });
    $(document).ready(function() {
        $('#dataTables-example3').dataTable();
    });
    </script>
</html>
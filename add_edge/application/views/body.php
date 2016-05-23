<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>EDGE CONTROL PAGE</title>
<link href="http://nagios01.priv.yospace.net/add_edge/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="http://nagios01.priv.yospace.net/add_edge/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="http://nagios01.priv.yospace.net/add_edge/js/jquery.filer.min.js"></script>
</head>
<body>
<nav id="myNavbar" class="navbar navbar-default navbar-inverse" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://nagios01.priv.yospace.net/add_edge/add/insert">Yospace</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="nav navbar-nav">
                <li <?php if ($_pgheader == 'AddController') { echo 'class="active"'; } ?>><a href="http://nagios01.priv.yospace.net/add_edge/add/insert">add edges</a></li>
                <li <?php if ($_pgheader == 'RemoveController') { echo 'class="active"'; } ?>><a href="http://nagios01.priv.yospace.net/add_edge/remove/delete">remove edges</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="page-header">
                <h4>Yospace Technologies</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-6">
            <h2><?php if ($_pgheader == 'AddController') { echo 'Add edges'; } ?>
                <?php if ($_pgheader == 'RemoveController') { echo 'Delete edges'; } ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <form action="<?php if ($_pgheader == 'AddController') { echo 'http://nagios01.priv.yospace.net/add_edge/add/uploader'; } elseif ($_pgheader == 'RemoveController') { echo 'http://nagios01.priv.yospace.net/add_edge/remove/uploader'; } else { echo 'noform'; } ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="files[]" id="filer_input" multiple="multiple">
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>    
    <div class="row">
        <div class="col-sm-12">
            <footer>
                <p>&copy; Copyright Yosapce Technologies</p>
            </footer>
        </div>
    </div>
</div>

<script>
$('#filer_input').filer({
        limit: 3,
        maxSize: 3,
        extensions: ['text','txt'],
        changeInput: true,
        showThumbs: true
});
</script>
</body>
</html>                                		


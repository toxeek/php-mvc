<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>EDGE CONTROL PAGE</title>
<link href="http://example.com/add_cdn_node/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="http://example.com/add_cdn_node/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="http://example.comt/add_cdn_node/js/jquery.filer.min.js"></script>
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
            <a class="navbar-brand" href="http://example.com/add_cdn_node/add/insert">Yospace</a>
        </div>
        <!-- new comment as test -->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <!-- another test comment -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="nav navbar-nav">
                <li <?php if ($_pgheader == 'AddController') { echo 'class="active"'; } ?>><a href="http://example.com/add_cdn_node/add/insert">add edges</a></li>
                <li <?php if ($_pgheader == 'RemoveController') { echo 'class="active"'; } ?>><a href="http://example.com/add_cdn_node/remove/delete">remove edges</a></li>
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
            <h2><?php if ($_pgheader == 'AddController') { echo 'Add CDN nodes'; } ?>
                <?php if ($_pgheader == 'RemoveController') { echo 'Delete CDN nodes'; } ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
            <form action="<?php if ($_pgheader == 'AddController') { echo 'http://example.com/add_cdn_node/add/uploader'; } elseif ($_pgheader == 'RemoveController') { echo 'http://example.com/add_cdn_node/remove/uploader'; } else { echo 'noform'; } ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="files[]" id="filer_input" multiple="multiple">
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>    
    <div class="row">
        <div class="col-sm-12">
            <footer>
                <p>&copy; Copyright Example Technologies</p>
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


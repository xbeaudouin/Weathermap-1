<?php

//Create array of maps that begin with overview*.png

$overviews = glob('plugins/Weathermap/output/overview*.png');

// Assume that this should only be printed if it's not setup correctly.
if(! is_writable('plugins/Weathermap/configs')) {
  print_error("The map config directory is not writable by the web server user. You will not be able to edit any files until this is corrected.");
  $readme = @file_get_contents('plugins/Weathermap/INSTALL.md');
  $readme = nl2br($readme);
  echo('<h3>Please ensure you follow the installation instructions below.</h3>');
  echo('<div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Installation instructions</h3>
    </div>
    <div class="panel-body">
      <code>
        '.$readme.'
      </code>
    </div>
  </div>');
// If an overview*.png file(s) exist, don't show the editor link and only
// show the maps that match overview*.png in the Weathermap main page
// Editor can be accessed in the Plugins>Weathermap>WM Editor
} elseif ($overviews) {
  $directory = 'plugins/Weathermap/output/';
  $images = glob($directory . "overview*.png");
  echo('<div class="container">
    <ul class="list-inline">');
  foreach($images as $image) {
    $overlib = pathinfo($image);
    $overlib = $overlib['dirname'] . '/' . substr($overlib['basename'], 0, strrpos($overlib['basename'], '.')) . '.html';
    echo('<li><a href="' . $overlib . '"><img class="img-responsive" src="' . $image . '"/></a></li>');
  }
  echo('</ul>
    </div>');
// If you aren't using an overview* map, default to the previous style
} else {
  echo ('Click <a href="plugins/Weathermap/editor.php">here to access the editor</a> where you can create and manage maps.');
  $directory = 'plugins/Weathermap/output/';
  $images = glob($directory . "*.png");
  echo('<div class="container">
    <ul class="list-inline">');
  foreach($images as $image) {
    $overlib = pathinfo($image);
    $overlib = $overlib['dirname'] . '/' . substr($overlib['basename'], 0, strrpos($overlib['basename'], '.')) . '.html';
    echo('<li><a href="' . $overlib . '"><img class="img-responsive" src="' . $image . '"/></a></li>');
  }
  echo('</ul>
    </div>');
}


?>


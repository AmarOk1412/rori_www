<?php
if (isset($_POST['type'])) {
  $module_file = $_POST['type'].'.json';
  if (file_exists($module_file)) {
    $module_file = fopen($module_path, "r") or die("Unable to open file (read)!");
    $json_module = fread($module_file, filesize($module_path));
    $modules = json_decode($json_module);
    fclose($module_file);
  } else {
    $modules = array();
  }
  $module = json_decode($_POST['json_module']);
  array_push($modules, $module);
  echo json_encode($modules, JSON_PRETTY_PRINT);
  $myfile = fopen($module_file, "w+") or die("Unable to open file (write)!");
  fwrite($myfile, str_replace("\\/", "/", json_encode($modules, JSON_PRETTY_PRINT)));
  fclose($myfile);
  header('Location: configure.php');
}
?>

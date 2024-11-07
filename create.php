<?php
session_start();
$user_info = $_SESSION['username'];
$file_name = $user_info . '.php';
$myfile = fopen($file_name, "w");
$txt = "<?php echo('hello $user_info'); ?>";
fwrite($myfile, $txt);
fclose($myfile);
header("Location: " . $file_name);
?>

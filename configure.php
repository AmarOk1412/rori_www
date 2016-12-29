<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>RORI: Configure</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>


			<?php
			$pathfile = "configure_part.json";
			$configurefile = fopen($pathfile, "r") or die("Unable to open file!");
			$json_path = fread($configurefile , filesize($pathfile));
			$parsed_path = json_decode($json_path);
			fclose($configurefile);
			?>
		<!-- Sidebar -->
			<section id="sidebar">
				<div class="inner">
					<div id="logolink">
						<a href="index.php">
							<img src="images/rori.png" alt="logo rori" data-position="center center"/>
						</a>
					</div>
					<nav>
						<ul>
							<?php
					     foreach($parsed_path as $key => $val)
					     {
								  echo '<li><a href="#'.$key.'">'.$key.'</a></li>';
					     }
							 ?>
						</ul>
					</nav>
				</div>
			</section>

		<!-- Wrapper -->
			<div id="wrapper">
				<?php
				$file_path = $parsed_path->{'General'};
				$general_conf_file = fopen($file_path, "r") or die("Unable to open file!");
				$json_content = fread($general_conf_file,filesize($file_path));
				$parsed = json_decode($json_content);
				fclose($general_conf_file);
				?>
					<section id="General" class="wrapper style1 fullscreen fade-up">
						<div class="inner">
							<h1>General</h1>
							<input type="hidden" name="path" value="<?php echo $file_path; ?>">
							<form name="htmlform" method="post" action="save_general.php">
								<div id="midscreen">
									<h2>Server</h2>
									<p>
									 IP: <input type="text" name="ip" value="<?php echo $parsed->{'ip'}; ?>"><br>
									 Port: <input type="text" name="port" value="<?php echo $parsed->{'port'}; ?>"><br>
								 	</p>
								</div>
								<div id="midscreen">
									<h2>API</h2>
									<p>
									 IP: <input type="text" name="api_ip" value="<?php echo $parsed->{'api_ip'}; ?>"><br>
									 Port: <input type="text" name="api_port" value="<?php echo $parsed->{'api_port'}; ?>"><br>
								 	</p>
								</div>
								<ul class="actions">
									<li><input type="submit" value="Save"></li>
								</ul>
							</form>
						</div>
					</section>

				<!--  modules -->
					<?php
					 $cpt_mod = 0;
					 foreach($parsed_path as $key => $val) {
						 if($key != "General") {
							 echo'<section id="'.$key.'" class="wrapper style2 spotlights">';
		 						$module_path = $val;
		 						$module_file = fopen($module_path, "r") or die("Unable to open file!");
		 						$json_module = fread($module_file, filesize($module_path));
		 						$modules = json_decode($json_module);
		 						fclose($module_file);
		 						$cpt = 0;
		 						$typemod = $val;
		 						foreach ($modules as $module) {
		 							$content_desc = json_encode($module, JSON_PRETTY_PRINT);
		 							echo '<section>
		 								<div class="image"><img src="'.$module->{'img'}.'" alt="" data-position="center center"/></div>
		 								<div class="content">
		 									<div class="inner">
		 										<h2>'.$module->{'name'}.'</h2>
		 										<p>'.$module->{'desc'}.'</p>
		 										<form id="moduleform'.$cpt_mod.'" method="post" action="save_module.php">
		 										<input type="hidden" name="typemod" value="'.$typemod.'">
		 										<textarea name="json_module'.$cpt.'" form="moduleform'.$cpt_mod.'" rows="4" cols="50">'.str_replace("\\/", "/", $content_desc).'</textarea>
		 										<ul class="actions">
		 											<li><input type="submit" value="Save"></li>
		 										</ul>
		 										</form>
		 									</div>
		 								</div>
		 							</section>';
		 							$cpt += 1;
		 						}
		 					echo '</section>';
						 }
						 $cpt_mod += 1;
					 }
					?>
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>

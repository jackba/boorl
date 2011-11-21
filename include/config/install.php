<?php

if (INSTALL != 1) {
	
	$apache_modules = apache_get_modules();
	$php_modules = get_loaded_extensions();
	$flag = true;
	
	// Check if mod_rewrite for Apache is installed/enabled
	if (in_array("mod_rewrite", $apache_modules))
		echo "mod_rewrite enabled.<br/>";
	else $flag = false;
	// Check if mysql extension for PHP is installed/enabled
	if (in_array('mysql', $php_modules)) 
		echo "MySQL enabled.<br/>";
	else $flag = false;
	// Check if PHP Data Objects (PDO) is installed/enabled
	if (in_array('PDO', $php_modules)) 
		echo "PDO enabled.<br/>";
	else $flag = false;
	// Check if pdo_mysql driver is installed/enabled
	if (in_array('pdo_mysql', $php_modules)) 
		echo "pdo_mysql enabled.<br/>";
	else $flag = false;
	
	// If some module isn't installed, show a message that installation can't proceed without installing all needed modules.
	if ($flag) {
		if (validate()) {
			echo '<br /> Let\'s try to install BooRL.';
			$host = $_POST['host'];
			$database = $_POST['database'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$domain = $_POST['domain'];
			$gaCode = $_POST['gaCode'];
			try {
				$dbh = new PDO("mysql:host=$host;", $username, $password);
				echo '<br /> Connected to database. ';
				$dbSQL = file_get_contents('include/config/database.sql');
				$dbSQL = str_replace('##dbname##', $database, $dbSQL);
				$dbSQL = split(';', $dbSQL);
				$dbSQL = array_slice($dbSQL, 0, sizeof($dbSQL) - 1);
				for ($i = 0; $i < sizeof($dbSQL); $i++) {
					$dbh->exec($dbSQL[$i] . ";");
				}
				$dbh->exec("USE $database");
				echo '<br /> Database successfully created. ';
				
				$config = file_get_contents('include/config/config.php');
				$config = str_replace('##0##', 1, $config);
				$config = str_replace('##1##', $host, $config);
				$config = str_replace('##2##', $database, $config);
				$config = str_replace('##3##', $username, $config);
				$config = str_replace('##4##', $password, $config);
				$config = str_replace('##5##', $domain, $config);
				$config = str_replace('##6##', $gaCode, $config);
				if (!file_put_contents('include/config/config.php', $config)) {
					throw new Exception('Could not write configuration file.');	
				}
				echo '<br /> Installation successful. '; 
				echo '<br /> <input type="button" value="Reload" onClick="window.location.reload()">';
			} catch (Exception $e) {
				echo '<br /> Installation failed. ' . $e->getMessage();
			}
		} else {
		?>
		<br />
		<form name="input" action="" method="post">
			Host: <input type="text" name="host" /> <br />
			Database: <input type="text" name="database" /> <br />
			Username: <input type="text" name="username" /> <br />
			Password: <input type="text" name="password" /> <br />
			Domain (without www, Optional): <input type="text" name="domain" /> <br />
			Google Analytics Code (Optional): <input type="text" name="gaCode" /> <br />
			<input type="submit" value="Submit" /> <br />
		</form>
		<?php 
		}
	} else {
		echo "<br/>Install all the needed extensions/modules.<br/>";
	}
}

/**
 * Check if all the parameters are given
 */
function validate() {
	if (strlen($_POST['host']) > 0 &&
		strlen($_POST['database']) > 0 &&
		strlen($_POST['username']) > 0 &&
		strlen($_POST['password']) > 0) {
		return true;
	} else {
		return false;
	}
}

?>
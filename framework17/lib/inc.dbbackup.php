<?php



	$dbBackup = new dbBackup(); // Auto instantiation of dbBackup class


	// 
	// Shell execution of this script (i.e. for cron tasks)
	//
	// Can usually be called like this: 
	// /usr/bin/php /path/to/inc.dbbackup.php command [options]
	//

	if($_SERVER['argc']>1) {
		
		#ver_variable($_SERVER['argv']);
		$action_db=$_SERVER['argv'][1];
		
		if($action_db=='--help' || $action_db=='-h') 
			// display manual if class called with --help
			echo "\n  Class dbBackup v1.0 (13/07/2004)\n\n".
				 "  Perform quick backups/restores of MySQL bases\n".
				 "  and/or tables with or without compression ...\n\n".
				 "      USAGE: inc.dbbackup.php ...command... \n\n COMMAND IS:\n\n".
				 "dump [table1 table2...]\n".
				 "     Create back up archives [from specified table(s)]\n\n".
				 "dumpifneeded [table1 table2...]\n".
				 "     Create back up archives [from specified table(s)]\n\n".
				 "restore file\n".
				 "     Restore base from backup archive 'file'\n\n".
				 "fromlast [regexp]\n".
				 "     Restore base from last backup archive [matching specified regexp]\n\n".
				 "delete file\n".
				 "     Delete backup archive 'file'\n\n".
				 "cleanup [days]\n".
				 "     Delete backup archives [older than specified days]\n\n".
				 "listbackups [regexp]\n".
				 "     Return array with backup archives [matching specified regexp]\n\n".
				 "lastbackup [regexp]\n".
				 "     Return last backup archive name and timestamp [matching specified regexp]\n\n".
				 "lastmodif [table1 table2...]\n".
				 "     Return last backup archive name and timestamp [matching specified regexp]\n\n";
		elseif($action_db=='dump') { $t=$_SERVER['argv']; 
			array_shift($t); array_shift($t); $r = $dbBackup->dump(join(' ',$t)); }
		elseif($action_db=='dumpifneeded') 
			$r=$dbBackup->dumpifneeded($_SERVER['argv'][2]);
		elseif($action_db=='restore' && $_SERVER['argv'][2]) 
			$dbBackup->restore($_SERVER['argv'][2]);
		elseif($action_db=='delete' && $_SERVER['argv'][2]) 
			$r=$dbBackup->delete($_SERVER['argv'][2]);
		elseif($action_db=='cleanup') 
			$dbBackup->cleanup($_SERVER['argv'][2]);
		elseif($action_db=='listbackups') 
			$r=$dbBackup->listbackups($_SERVER['argv'][2]);
		elseif($action_db=='lastbackup') 
			$r=$dbBackup->lastbackup($_SERVER['argv'][2]);
		elseif($action_db=='fromlast') 
			$r=$dbBackup->fromlast($_SERVER['argv'][2]);
		elseif($action_db=='lastmodif') 
			$r=$dbBackup->lastmodif($_SERVER['argv'][2]);
		if($r) print_r($r);
		exit;
	}




class dbBackup {


	//        Class dbBackup v1.0 (15/07/2004)
	//
	// Perform quick backups/restores of MySQL bases 
	// and/or tables with or without compression ...
	//
	// Created by Michel Poulain - www.lashampoo.net


	var $_dbhost = CONFIG_DATABASE_HOST; #"localhost"; // DB host
	var $_dbuser = CONFIG_DATABASE_USER; #"";          // DB user
	var $_dbpass = CONFIG_DATABASE_PASS; #"";          // DB password
	var $_dbname = CONFIG_DATABASE_NAME; #"";          // DB name


	var $_backupdir = 'backup'; // Backup directory (writing permissions)


	#var $_mysqldump = '/usr/local/mysql/bin/mysqldump';
	#var $_mysql     = '/usr/local/mysql/bin/mysql';
	var $_mysqldump = 'D:\\xampp\\mysql\\bin\\mysqldump.exe';
	var $_mysql     = 'D:\\xampp\\mysql\\bin\\mysql.exe';	
	var $_compress  = '/usr/bin/gzip';     // Compression utility
	var $_uncomprs  = '/usr/bin/gzip -cd'; // De-compression utility
	var $_ext       = 'gz';                // Compression extension



	//
	// dbBackup::dump(string $tables)           Backup DB [only these tables] to file
	//
	function dump($tables=''){
		@set_time_limit(0); // No time limit
		if(@is_dir($this->_backupdir) && @is_writable($this->_backupdir)) {
			if(!$tables) 
				$options='[.all-tables.]';
			elseif(substr_count($tables,'`')>=1)
				$options='['.ereg_replace("`[ \t]*`",'.',substr($tables,1,-1)).']';
			else
				$options='['.ereg_replace(' ','.',$tables).']';
			$file = $this->_dbname.'.'.$options.'.'.date('Y-m-d-H-i-s').'.sql';
			$file=ereg_replace('"','\"',$file);
			$action_db="$this->_mysqldump -u$this->_dbuser ".
				"-p$this->_dbpass `$this->_dbname` $tables --opt ";
			if($this->_compress) { 
				$file   .= ".$this->_ext";
				$action_db .= "| $this->_compress";
			}
			system("$action_db > \"$this->_backupdir/$file\"");
			return $file;    // Return archive name
		} else return false;

	}



	//
	// dbBackup::dumpifneeded(string $tables)   Backup DB [only these tables] to file
	//                                          if tables modified since last backup
	//
	function dumpifneeded($tables=''){

		if(substr_count($tables,'`')>=1 && $tables)
			$regexp=ereg_replace("`[ \t]*`",'.',substr($tables,1,-1));
		elseif($tables)
			$regexp=ereg_replace(' ','.',$tables);
		else
			$regexp="\.all-tables\.";

		if($regexp!=".*")
			$regexp=preg_replace("|[\[\]\(\)\$\*]|",'.',$regexp); 
		
		list($file,$date) = $this->lastbackup($regexp);
		$last = $this->lastmodif($tables);
		
		if($file=='none' && $last>$date)
			return $this->dump($tables);
		if($file && $last)
			return 'not needed';
		else
			return 'error';
	}




	//
	// dbBackup::restore(string $file)          Restore DB from a backup file
	//
	function restore($file){
		@set_time_limit(0); // No time limit
		$file = $this->_backupdir.'/'.$file;
		if(@is_file($file)) {
			$info = pathinfo($file);
			$info['size'] = filesize($file);
			if ($info['size']) { // File existe, import it
				if($info['extension']==$this->_ext
					&& $this->_uncomprs) { 
					$r = @system("$this->_uncomprs $file ".
						"| $this->_mysql -u$this->_dbuser ".
						"-p$this->_dbpass $this->_dbname ");
				} else { 
					$r = @system("$this->_mysql -u$this->_dbuser ".
						"-p$this->_dbpass $this->_dbname < $file");
				}
				return $r;   // Return result
			} else return 1; // Error
		} else return 1; // Error
	}


	//
	// dbBackup::listbackups(string $regexp)    Return list of previous backups
	//                                          matching regexp (if regexp given)
	//
	function listbackups($regexp='.*') {
		$dates = ''; $files = ''; // Reset
		if(!$regexp) $regexp='.*';
		if (@is_dir($this->_backupdir) && @is_writable($this->_backupdir)) {
			$directory = dir($this->_backupdir);
			while (false !== ($temp = $directory->read())) {
				if ($temp{0}!='.' and ereg($regexp,$temp)
					and (ereg(".sql$",$temp) or ereg(".$this->_ext$",$temp))) {
						$dates[]=filemtime($this->_backupdir.'/'.$temp);
						$files[]=$temp;
				}
			}
		if($dates) 
			return array($files,$dates); // Return array of Dates and Files
		else 
			return array('none','none'); // Return nothing

		} else return false;             // Return error
	}
	


	//
	// dbBackup::fromlast(string $tables)       Restore DB from last backup file
	//                                          matching regexp (if regexp given)
	//
	function fromlast($regexp='.*'){
		list($file,$date) = $this->lastbackup($regexp);
		if($file!='none') 
			return $this->restore($file);
		elseif($file=='none') 
			return 'none';
		else
			return 1;
	}




	//
	// dbBackup::lastbackup(string $regexp)     Return last backup archive
	//                                          matching regexp (if regexp given)
	//
	function lastbackup($regexp='.*'){
		if(!$regexp) $regexp='.*';
		if (@is_dir($this->_backupdir) && @is_readable($this->_backupdir)) {
			$directory = dir($this->_backupdir);
			while (false !== ($temp = $directory->read())) {
				$date=filemtime($this->_backupdir.'/'.$temp);
				if ($temp{0}!='.' and ereg($regexp,$temp)
					and (ereg(".sql$",$temp) or ereg(".$this->_ext$",$temp))
					and  $max<=$date) {
						 $max=filemtime($this->_backupdir.'/'.$temp);
						$file=$temp;
				}
			}
		if($max) 
			return array($file,$max); // Return array of Dates and Files
		else 
			return array('none','none'); // Return nothing

		} else return false;          // Return error
	}



	//
	// dbBackup::delete(string $file)           Delete a backup file based on its name
	//
	function delete($file){
		$file=$this->_backupdir.'/'.$file;
		if (@is_file($file)) {
			if(unlink($file))
				return 0; // Return no error
		} else return 1;  // Return error (no file deleted)
	}



	//
	// dbBackup::retrieve(string $file)         Send a backup file to browser 
	//
	function retrieve($file){
		$file=$this->_backupdir.'/'.$file;
		if (@is_file($file)) {
			header("Location: $file");
			exit;         // Exit
		} else return 1;  // Return error (no file detected)
	}



	//
	// dbBackup::clean(int $days)               Keep backup files for a limited  
	//                                          period of days and remove all others
	//
	function cleanup($days = 7) {
		$error = 0; // Reset error counter
		if (@is_dir($this->_backupdir)) {
			$directory = dir($this->_backupdir);
			while (false !== ($file = $directory->read())) {
				if ($file{0}!='.' and (ereg(".sql$",$file) 
				or ereg(".$this->_ext$",$file))) {
					if ((filemtime($this->_backupdir.'/'.$file)) 
						< (strtotime('-'.$days.' days'))) {
						$error += $this->delete($file);
					}
				}
			}
		} else return 1;  // Return error (no backup directory)
		return $error;    // Return whatever if error found
	}
	


	//
	// dbBackup::dumpandget(string $tables)     Backup DB [only these tables] to file
	//                                          and send result to browser
	//
	function dumpandget($tables=''){
		$file = $this->dump($tables);
		$this->retrieve($file);
	}



	//
	// dbBackup::listtables()                   Return tables in database
	//
	function listtables(){
		$mysql=mysql_connect($this->_dbhost,$this->_dbuser,$this->_dbpass);
			if(!$mysql) return false;
		$db=mysql_select_db($this->_dbname,$mysql);
			if(!$db) return false;
		$result=mysql_query('SHOW TABLES'); 
		for($i=0; $line=@mysql_result($result,$i,$column); $i++)
			$array[] = $line;
		mysql_free_result($result);
		mysql_close($mysql);
		return $array;
	}




	//
	// dbBackup::lastmodified(string $tables)   Return last modification timestamp 
	//                                          [of selected tables]
	//
	function lastmodif($tables='') {
		$last = 0; // Reset
		$mysql=mysql_connect($this->_dbhost,$this->_dbuser,$this->_dbpass);
			if(!$mysql) return false;
		$db=mysql_select_db($this->_dbname,$mysql);
			if(!$db) return false;
		$result=mysql_query('SHOW TABLE STATUS');
		
		if(substr_count($tables,"`")<=1 && $tables !='')
			$tables='`'.ereg_replace(" ","` `",$tables).'`';
		
		for($i=0; $table=mysql_fetch_object($result); $i++)
			if($last<=$table->Update_time
				&& (substr_count($tables,'`'.$table->Name.'`') 
				|| $tables==''))
					$last=$table->Update_time;

		mysql_free_result($result); 
		mysql_close($mysql);
		if($last) 
			return strtotime($last);  // Return last modification timestamp
		else return false;            // Return error
	}
	




} // End of Class



?>
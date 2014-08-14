<?php


	// Feel free to translate this file in your own language
	// then back the localized example to my email address
	// avalaible on my website - www.lashampoo.net
	#ver_variable($_REQUEST);
	$action = $_REQUEST['action']  = 'respaldo'; 
	$action_db=$_REQUEST['action_db']; 
	$file=$_REQUEST['file']; 
	$all=$_REQUEST['all']; 
	if(is_array($_REQUEST['table']))
		$tables='`'.join('` `',$_REQUEST['table']).'`';
	$tables=DeQuote($tables);
	$file=DeQuote($file);
	$all=DeQuote($all);
	if($tables==$all)$tables='';
	
	function   Quote($texte) { return str_replace('"','&quote;',$texte); }
	function DeQuote($texte) { return str_replace('&quote;','"',$texte); }
	
	require('lib/inc.dbbackup.php'); // Instantiation of dbBackup class
	
	// Execute action
	if($action_db=='retrieve' && $file) $r=$dbBackup->retrieve($file);
	elseif($action_db=='delete' && $file) $r=$dbBackup->delete($file);
	elseif($action_db=='restore' && $file) $r=$dbBackup->restore($file);
	elseif($action_db=='fromlast') $r=$dbBackup->fromlast();
	elseif($action_db=='dump') $r=$dbBackup->dump($tables);
	elseif($action_db=='dumpifneeded') $r=$dbBackup->dumpifneeded($tables);

	    // Explication des erreurs ou résultats
	    if($action_db=='retrieve' && $r) $error="Backup file doesn't seem to exist or be readable";
	elseif($action_db=='delete' && $r) $error="Couldn't delete backup file";
	elseif($action_db=='delete') $error="Backup file deleted";
	elseif($action_db=='restore' && $r) $error="Backup file doesn't seem to exist or be readable";
	elseif($action_db=='restore') $error="Database restored from backup file";
	elseif($action_db=='fromlast' && $r=='none') $error="Backup directory seems to be empty, no last backup";
	elseif($action_db=='fromlast' && $r) $error="Backup directory seems not to be readable or not to exist";
	elseif($action_db=='fromlast') $error="Database restored from last backup file";
	elseif($action_db=='dumpifneeded' && $r=='error') $error="Impossible to create backup file";
	elseif($action_db=='dumpifneeded' && $r=='not needed') $error="No backup needed";
	elseif($action_db=='dumpifneeded' && !$r) $error="Impossible to create backup file";
	elseif($action_db=='dumpifneeded' && $r) $error="Backup file created";
	elseif($action_db=='dump' && !$r) $error="Impossible to deleted backup file";
	elseif($action_db=='dump') $error="Backup file created";


	list($files,$dates)=$dbBackup->listbackups(); // Retrieve backups list
	

?>
		<style type="text/css" media="All"><!--

body,select,input	{ 
	font-size: 12px;
	background-color: #FFFFFF;
	font-family: verdana, helvetica, arial;
-->
		</style>
<script language="JavaScript">
<!--

var ok=false;

function test(ok) {

	var n = document.backup;
	var action=n.elements[0].value;
	var file=n.elements[1].value;
	    file='.'+file.substring(file.indexOf('.[')+2,file.indexOf('].'))+'.'; 
		
	var all=file.indexOf('..all-tables..');

	if(ok=='files') for (var i = 0; i < n.elements.length; i++) {

		if(n.elements[i].type=='checkbox') { 
			if (file.indexOf('.'+n.elements[i].value+'.')>=0 || all>=0)
				 n.elements[i].checked=true;
			else n.elements[i].checked=false;
		}

	}

	if(action=='dump')     action='respaldar la Base de Datos';
	if(action=='dumpifneeded')  action='sauvegarder la base de données si nécessaire';
	if(action=='restore')  action='restore database from backup file';
	if(action=='fromlast') action='restore database from last backup';
	if(action=='delete')   action='delete the backup file';
	if(action=='retrieve') action='download the backup file';
	
	if(n.elements[0].value!='dump' 
		&& n.elements[0].value!='fromlast' 
		&& n.elements[0].value!='dumpifneeded' 
		&& n.elements[0].value !='' 
		&& n.elements[1].value == ''
		&& ok==true) 
	 { alert('You must select a backup file'); return false; }

	else if(n.elements[0].value == '' 
		&& n.elements[1].value != ''
		&& ok==true) { 
			alert('You must select an action to perform'); 
			return false;
	}

	else if( n.elements[0].value=='dump' 
		  || n.elements[0].value=='fromlast' 
		  || n.elements[0].value=='dumpifneeded' 
		  || (n.elements[0].value !='' 
		      && n.elements[1].value != '')) {
	
		if(confirm('Confirma el proceso de '+action+' ?')) 
			if(confirm('Realmente desea '+action+' ?')) n.submit();
			else return false;

		else return false;
	
	} else return false;

}

//-->
</script>




<h1>Respaldo de Informacion</h1>
<form action="admin.php?action=respaldo" name="backup" method="GET" onSubmit="return test('end');">


<?php if($error) { ?><b><?=$error?></b><br><br><?php } ?>

<?php if($files==false) { ?>
<b>The backup folder doesn't seem to exist and/or to be writable by Apache</b><br>
Please check the configuration settings in inc.dbbackup.php<br><br><?php } ?>

<select name="action_db" onChange="if(this.value!='')test('action_db');">
<option value=""></option>
<option value="dump">Backup database</option>


<?php if($files!='none') { ?>

<option value="dumpifneeded">Backup database if needed</option>
<option value="restore">Restore from backup file:</option>
<option value="fromlast">Restore from last backup</option>
<option value="delete">Delete backup file:</option>
<option value="retrieve">Download backup file:</option>
</select> 

<select name="file" onChange="if(this.value!='')test('files');">
<option value=""></option>

<?php foreach ($files AS $file) { 

	$name=ereg_replace("^.*\.\[(.*)\]\..*$",'\1',$file); 
	$name=ereg_replace(".all-tables.","base complête",$name); 
	if(substr_count($name,'.')>=1)$name=(substr_count($name,'.')+1)." tables";
	elseif($name!="base complête")$name="only 1 table"; 
	
	echo "<option value=\"".Quote($file)."\">".
	date('\d\u d/m/Y à H\hi, ',array_pop($dates)).$name."</option>\n";

}} ?>

</select><input type="submit" value="ok"><br>


<?php $tables=$dbBackup->listtables(); 

	if($tables) foreach($tables AS $table) { ?>
	<ul>
    <li>
		<input type="checkbox" name="table[]" value="<?=Quote($table)?>" checked><?=$table?> <br>
    </li>
    </ul>

<?php } else { ?>

	No table to select, this databse seems empty.

	<?php } ?>

<input type="hidden" name="all" value="<?='`'.Quote(join('` `',$tables)).'`'?>"></form>
<input name="action" type="hidden" value="respaldo">

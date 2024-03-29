<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir = dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('orders');
	if(!$table_perms[0]){ die('// Access denied!'); }

	$mfk = $_GET['mfk'];
	$id = makeSafe($_GET['id']);
	$rnd1 = intval($_GET['rnd1']); if(!$rnd1) $rnd1 = '';

	if(!$mfk){
		die('// No js code available!');
	}

	switch($mfk){

		case 'CustomerID':
			if(!$id){
				?>
				$j('#ShipName<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#ShipAddress<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#ShipCity<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#ShipRegion<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#ShipPostalCode<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#ShipCountry<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `customers`.`CustomerID` as 'CustomerID', `customers`.`CompanyName` as 'CompanyName', `customers`.`ContactName` as 'ContactName', `customers`.`ContactTitle` as 'ContactTitle', `customers`.`Address` as 'Address', `customers`.`City` as 'City', `customers`.`Region` as 'Region', `customers`.`PostalCode` as 'PostalCode', `customers`.`Country` as 'Country', `customers`.`Phone` as 'Phone', `customers`.`Fax` as 'Fax', `customers`.`TotalSales` as 'TotalSales' FROM `customers`  WHERE `customers`.`CustomerID`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#ShipName<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['CompanyName']))); ?>&nbsp;');
			$j('#ShipAddress<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['Address']))); ?>&nbsp;');
			$j('#ShipCity<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['City']))); ?>&nbsp;');
			$j('#ShipRegion<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['Region']))); ?>&nbsp;');
			$j('#ShipPostalCode<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['PostalCode']))); ?>&nbsp;');
			$j('#ShipCountry<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(array("\r", "\n"), '', nl2br($row['Country']))); ?>&nbsp;');
			<?php
			break;


	}

?>
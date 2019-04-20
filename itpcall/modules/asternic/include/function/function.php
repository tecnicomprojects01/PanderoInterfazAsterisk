<?Php 
class CFunction{

	function searchAnnex($prmTable, $prmField, $prmFielCompare, $prmValueCompare){
		$like = ($prmValueCompare ? " where like = '".$prmValueCompare."'" : ""); 
		$rs = mysql_query("select ".$prmField." from bd_alotaxi.".$prmTable." ".$prmFielCompare." ".$like);
		//echo "select ".$prmField." from bd_alotaxi.".$prmTable." ".$prmFielCompare." ".$like;
		return $rs;
	}

	function searchTable($prmTable, $prmField, $prmFielCompare, $prmValueCompare){
		$like = ($prmValueCompare ? " where ".$prmFielCompare." like  '".$prmValueCompare."'" : ""); 
		$rs = mysql_query("select ".$prmField." from ".$prmTable." ".$prmFielCompare." ".$like);
		//echo "select ".$prmField." from ".$prmTable." ".$prmFielCompare." ".$like;
		return $rs;
	}

	function searchDoubleTable($prmTable1, $prmTable2, $prmField, $prmFielCommon, $prmFielCompare, $prmValueCompare){

		$like = ($prmValueCompare ? " where like = '".$prmValueCompare."'" : ""); 
		$rs = mysql_query("select ".$prmField." from ".$prmTable1." inner join  ".$prmTable2." on ".$prmTable1.".".$prmFielCommon." = ".$prmTable2.".".$parameterrmFielCommon);
		//echo "select ".$prmField." from ".$prmTable1." inner join  ".$prmTable2." on ".$prmTable1.".".$prmFielCommon." = ".$prmTable2.".".$prmFielCommon;
		//echo "select ".$prmField." from ".$prmTable1." inner join  ".$prmTable2." on ".$prmTable1.".".$prmFielCommon." = ".$prmTable2.".".$prmFielCommon."  ".$prmFielCompare." ".$like.";";
		//$rs = mysql_query("select ".$prmField." from bd_alotaxi.".$prmTable." ".$prmFielCompare." ".$like);
		//echo "select ".$prmField." from bd_alotaxi.".$prmTable." ".$prmFielCompare." ".$like;
		return $rs;
	}

	function insertAnnex($prmTable, $prmField, $prmValue){
		$rs = mysql_query("insert into ".$prmTable." (".$prmField.") values (".$prmValue.");");
		//echo "insert ".$prmTable." (".$prmField.") values (".$prmValue.");";
		return 0;
	}

	function insertParameter($valueParameter, $typeParameter){
		$parameter = NULL;
		switch($typeParameter){
			case 0: $parameter="[".$valueParameter."]"; break;
			case 1: $parameter="callerid=".$valueParameter; break;
			case 2: $parameter="type=".$valueParameter; break;
			case 3: $parameter="host=".$valueParameter; break;
			case 4: $parameter="context=".$valueParameter; break;
			case 5: $parameter="secret=".$valueParameter; break;
			case 6: $parameter="canreinvite=".$valueParameter; break;
			case 7: $parameter="qualify=".$valueParameter; break;
			case 8: $parameter="nat=".$valueParameter; break;	
			case 9: $parameter="call-limit=".$valueParameter; break;
			case 10: $parameter="dtmfmode=".$valueParameter; break;
			case 11: $parameter="callgroup=".$valueParameter; break;
			case 12: $parameter="pickupgroup=".$valueParameter; break;
			case 13: $parameter="mailbox=".$valueParameter; break;
			case 14: $parameter="setvar=".$valueParameter; break;
			case 15: $parameter="disallow=".$valueParameter; break;
			case 16: $parameter="allow=".$valueParameter; break;
			case 17: $parameter="username=".$valueParameter; break;
			case 18: $parameter="group=".$valueParameter; break;
		}
		return $parameter;
	}

	function insertaAccountSip($prmFileRoute, $prmAccountSip){

		$file = fopen("/etc/asterisk/sip.anexos.test.conf","r+");
		$arrAccountExist = array();
		$i=0;
		while(($line=fgets($file))!==false){		
			$arrAccountExist[$i] = $line;;
			//echo $line;
			$i++;
		}
		array_push($arrAccountExist, "");

		for($i=0;$i<count($prmAccountSip);$i++){
			array_push($arrAccountExist, $prmAccountSip[$i]);						
		}

		$ruta="/etc/asterisk/sip.anexos.test.conf";
		$file=fopen($ruta, "a+");

		for($j=0;$j<count($prmAccountSip);$j++){
			$esc=fwrite($file, $prmAccountSip[$j].PHP_EOL);
		}

		return $arrAccountExist;
	}

	function insertaAccountUser($prmUser, $prmKey){
		$newAccount=$prmUser.":".$prmKey;		
		$file=fopen("/etc/asterisk/claves", "a+");
		fwrite($file, $newAccount.PHP_EOL);
	}

	function formatField($prmField, $prmTipo){
		$sFildInsert = NULL;

		if($prmTipo==1){
			for($i=0;$i<count($prmField);$i++){
				$sFildInsert .= $prmField[$i].","; 				
			}
				$sFildInsert = substr($sFildInsert,0,strlen($sFildInsert)-1);
 				return $sFildInsert;
			
		}else if($prmTipo==2){
			for($i=0;$i<count($prmField);$i++){
				$sFildInsert .= "'".$prmField[$i]."',"; 				
			}
				$sFildInsert = substr($sFildInsert,0,strlen($sFildInsert)-1);
 				return $sFildInsert;
		}
	}


	function formatDateMysql($date, $tipo){
		if($tipo==1){
			$dateformat = substr($date,6,4)."-".substr($date,3,2)."-".substr($date,0,2);
		}else if($tipo==1){
			$dateformat = substr($date,8,4)."/".substr($date,5,2)."/".substr($date,0,4);
		}
		return $dateformat;
	}

	
function archivo($nombre, $tipo, $texto="", $tamanio="") {
    $tipo = strtolower($tipo);
    $permiso = array('leer'=>'r','sustituir'=>'w+','grabar'=>'a+', 'borrar'=>'0');
    if($permiso[$tipo] != '0'){
        if($permiso[$tipo] == 'r'){
            //leer
            $read = @file_get_contents($nombre);
            return $read;
        } else {
            //grabar
            $fp = fopen($nombre,$permiso[$tipo]);
            $read = fwrite($fp, $texto, $tamanio);
            fclose($fp);
            return $read;
        }
    } else {
        $read = unlink($nombre);
        return $read;
    }
}

}

?>

<?
include_once(dirname(__FILE__) . "/lib/defines.php");
include_once(dirname(__FILE__) . "/lib/Class.Table.php");


// correct 31 +1 = 32 for the date
//session_start();

getpost_ifset(array('posted', 'Period', 'frommonth', 'fromstatsmonth', 'tomonth', 'tostatsmonth', 'fromday', 'fromstatsday_sday', 'fromstatsmonth_sday', 'today', 'tostatsday_sday', 'tostatsmonth_sday', 'dsttype', 'sourcetype', 'clidtype', 'channel', 'resulttype', 'stitle', 'atmenu', 'current_page', 'order', 'sens', 'dst', 'src', 'clid', 'userfieldtype', 'userfield', 'accountcodetype', 'accountcode', 'billsec1', 'billsec1type', 'billsec2', 'billsec2type'));

//echo "'posted=$posted', 'Period=$Period', 'frommonth=$frommonth', 'fromstatsmonth=$fromstatsmonth', 'tomonth=$tomonth', 'tostatsmonth=$tostatsmonth', 'fromday=$fromday', 'fromstatsday_sday=$fromstatsday_sday', 'fromstatsmonth_sday=$fromstatsmonth_sday', 'today=$today', 'tostatsday_sday=$tostatsday_sday', 'tostatsmonth_sday=$tostatsmonth_sday', 'dsttype=$dsttype', 'sourcetype=$sourcetype', 'clidtype=$clidtype', 'channel=$channel', 'resulttype=$resulttype', 'stitle=$stitle', 'atmenu=$atmenu', 'current_page=$current_page', 'order=$order', 'sens=$sens', 'dst=$dst', 'src=$src', 'clid=$clid', 'userfieldtype=$userfieldtype', 'userfield=$userfield', 'accountcodetype=$accountcodetype', 'accountcode=$accountcode', 'billsec1=$billsec1', 'billsec1type=$billsec1type', 'billsec2=$billsec2', 'billsec2type=$billsec2type'";

 

if (!isset ($current_page) || ($current_page == "")){	
		$current_page=0; 
	}


// this variable specifie the debug type (0 => nothing, 1 => sql result, 2 => boucle checking, 3 other value checking)
$FG_DEBUG = 0;

// The variable FG_TABLE_NAME define the table name to use
$FG_TABLE_NAME=DB_TABLENAME;



// THIS VARIABLE DEFINE THE COLOR OF THE HEAD TABLE
$FG_TABLE_HEAD_COLOR = "#D1D9E7";


$FG_TABLE_EXTERN_COLOR = "#7F99CC"; //#CC0033 (Rouge)
$FG_TABLE_INTERN_COLOR = "#EDF3FF"; //#FFEAFF (Rose)




// THIS VARIABLE DEFINE THE COLOR OF THE HEAD TABLE
$FG_TABLE_ALTERNATE_ROW_COLOR[] = "#FFFFFF";
$FG_TABLE_ALTERNATE_ROW_COLOR[] = "#F2F8FF";



//$link = DbConnect();
$DBHandle  = DbConnect();

// The variable Var_col would define the col that we want show in your table
// First Name of the column in the html page, second name of the field
$FG_TABLE_COL = array();


/*******
Calldate Clid Src Dst Dcontext Channel Dstchannel Lastapp Lastdata Duration Billsec Disposition Amaflags Accountcode Uniqueid Serverid
*******/

$FG_TABLE_COL[]=array ("Calldate", "calldate", "18%", "center", "SORT", "19");
//$FG_TABLE_COL[]=array ("Channel", "channel", "25%", "center", "", "30", "", "", "", "", "", "display_acronym"); /* para mostrar de manera encriptada el channel*/
$FG_TABLE_COL[]=array ("Channel", "channel", "25%", "center", "", "30");
$FG_TABLE_COL[]=array ("Source", "src", "10%", "center", "", "30");
$FG_TABLE_COL[]=array ("Clid", "clid", "12%", "center", "", "30");
$FG_TABLE_COL[]=array ("Lastapp", "lastapp", "8%", "center", "", "30");

//$FG_TABLE_COL[]=array ("Lastdata", "dst", "12%", "center", "", "30");
//$FG_TABLE_COL[]=array ("Lastdata", "lastdata", "12%", "center", "", "30");
$FG_TABLE_COL[]=array ("Dst", "dst", "9%", "center", "SORT", "30");
//$FG_TABLE_COL[]=array ("APP", "dst", "9%", "center", "", "30","list", $appli_list);
//$FG_TABLE_COL[]=array ("Serverid", "serverid", "7%", "center", "", "30");
$FG_TABLE_COL[]=array ("Disposition", "disposition", "9%", "center", "", "30");
//if ((!isset($resulttype)) || ($resulttype=="min")) $minute_function= "display_minute";
//$FG_TABLE_COL[]=array ("Duration", "billsec", "6%", "center", "SORT", "30", "", "", "", "", "", "$minute_function");

$FG_TABLE_COL[]=array ("Duration", "billsec", "9%", "center", "", "30");

$FG_TABLE_COL[]=array ("Userfield", "userfield", "8%", "center", "", "20");
$FG_TABLE_COL[]=array ("Accountcode", "accountcode", "8%", "center", "", "20");

$FG_TABLE_DEFAULT_ORDER = "calldate";
$FG_TABLE_DEFAULT_SENS = "DESC";

// This Variable store the argument for the SQL query
//$FG_COL_QUERY='calldate, channel, src, clid, lastapp, lastdata, dst, dst, serverid, disposition, billsec';
//$FG_COL_QUERY='calldate, channel, src, clid, lastapp, dst, dst, dst, disposition, billsec, userfield, accountcode';
//$FG_COL_QUERY="calldate,channel,src,clid,lastapp, dst,disposition,duration,userfield,accountcode";
$FG_COL_QUERY="calldate,channel,src,clid,lastapp, dst,disposition,(TIME(CONCAT(CAST((billsec DIV (60*60) ) AS CHAR(8)),':',CAST((billsec%(60*60) DIV 60) AS CHAR(8)),':',  CAST((billsec%(60*60)% 60) AS CHAR(8)))))  AS duracion,userfield,accountcode";
//$FG_COL_QUERY="channel,src,clid,lastapp, dst,disposition,(TIME(CONCAT(CAST((billsec DIV (60*60) ) AS CHAR(8)),':',CAST((billsec%(60*60) DIV 60) AS CHAR(8)),':',  CAST((billsec%(60*60)% 60) AS CHAR(8)))))  AS duracion,userfield,accountcode";


$NOMBREARCHIVO='src'."-".'dst';

//JJ//$FG_COL_QUERY='calldate, channel, src, clid, lastapp, lastdata, dst, dst, disposition, billsec, userfield, accountcode';
$FG_COL_QUERY_GRAPH='calldate, billsec';

// The variable LIMITE_DISPLAY define the limit of record to display by page
$FG_LIMITE_DISPLAY=25;

// Number of column in the html table
$FG_NB_TABLE_COL=count($FG_TABLE_COL);

// The variable $FG_EDITION define if you want process to the edition of the database record
$FG_EDITION=true;

//This variable will store the total number of column
$FG_TOTAL_TABLE_COL = $FG_NB_TABLE_COL;
if ($FG_DELETION || $FG_EDITION) $FG_TOTAL_TABLE_COL++;

//This variable define the Title of the HTML table
$FG_HTML_TABLE_TITLE=" - Call Logs - ";

//This variable define the width of the HTML table
$FG_HTML_TABLE_WIDTH="100%";




if ($FG_DEBUG == 3) echo "<br>Table : $FG_TABLE_NAME  	- 	Col_query : $FG_COL_QUERY";
$instance_table = new Table($FG_TABLE_NAME, $FG_COL_QUERY);
$instance_table_graph = new Table($FG_TABLE_NAME, $FG_COL_QUERY_GRAPH);


if ( is_null ($order) || is_null($sens) ){
	$order = $FG_TABLE_DEFAULT_ORDER;
	$sens  = $FG_TABLE_DEFAULT_SENS;
}

if ($posted==1){

  function do_field_billsec($sql,$fld, $fldsql){
  		$fldtype = $fld.'type';
		global $$fld;
		global $$fldtype;				
        if (isset($$fld) && ($$fld!='')){
                if (strpos($sql,'WHERE') > 0){
                        $sql = "$sql AND ";
                }else{
                        $sql = "$sql WHERE ";
                }
				$sql = "$sql $fldsql";
				if (isset ($$fldtype)){                
                        switch ($$fldtype) {
							case 1:	$sql = "$sql ='".$$fld."'";  break;
							case 2: $sql = "$sql <= '".$$fld."'";  break;
							case 3: $sql = "$sql < '".$$fld."'";  break;							
							case 4: $sql = "$sql > '".$$fld."'";  break;
							case 5: $sql = "$sql >= '".$$fld."'";  break;
						}
                }else{ $sql = "$sql = '".$$fld."'"; }
		}
        return $sql;
  }

  function do_field($sql,$fld){
  		$fldtype = $fld.'type';
		global $$fld;
		global $$fldtype;
        if (isset($$fld) && ($$fld!='')){
                if (strpos($sql,'WHERE') > 0){
                        $sql = "$sql AND ";
                }else{
                        $sql = "$sql WHERE ";
                }
				$sql = "$sql $fld";
				if (isset ($$fldtype)){                
                        switch ($$fldtype) {
							case 1:	$sql = "$sql='".$$fld."'";  break;
							case 2: $sql = "$sql LIKE '".$$fld."%'";  break;
							case 3: $sql = "$sql LIKE '%".$$fld."%'";  break;
							case 4: $sql = "$sql LIKE '%".$$fld."'";
						}
                }else{ $sql = "$sql LIKE '%".$$fld."%'"; }
		}
        return $sql;
  }  
  $SQLcmd = '';
  
  $SQLcmd = do_field($SQLcmd, 'clid');
  $SQLcmd = do_field($SQLcmd, 'src');
  $SQLcmd = do_field($SQLcmd, 'dst');
  $SQLcmd = do_field($SQLcmd, 'userfield');
  $SQLcmd = do_field($SQLcmd, 'accountcode');
  $SQLcmd = do_field($SQLcmd, 'channel');
  $SQLcmd = do_field_billsec($SQLcmd, 'billsec1', 'billsec');
  $SQLcmd = do_field_billsec($SQLcmd, 'billsec2', 'billsec');
	
	
  
}

$dia=date("d");
$arrayMeses = array('January', 'February', 'March', 'April', 'May', 'June','July', 'August', 'September', 'October', 'November', 'Dicember');
$mesnow=$arrayMeses[date('m')]."-".date('Y');

$date_clause='';
// Period (Month-Day)
if (DB_TYPE == "postgres"){		
	 	$UNIX_TIMESTAMP = "";
}else{		
		$UNIX_TIMESTAMP = "UNIX_TIMESTAMP";
}

if ($Period=="Month"){
	if ($period=$mesnow){
		if ($frommonth && isset($fromstatsmonth)) $date_clause.=" AND $UNIX_TIMESTAMP(calldate) >= $UNIX_TIMESTAMP('$fromstatsmonth-01')";
		if ($tomonth && isset($tostatsmonth)) $date_clause.=" AND $UNIX_TIMESTAMP(calldate) <= $UNIX_TIMESTAMP('$tostatsmonth-$dia 23:59:59')";
	}else{
		if ($frommonth && isset($fromstatsmonth)) $date_clause.=" AND $UNIX_TIMESTAMP(calldate) >= $UNIX_TIMESTAMP('$fromstatsmonth-01')";
		if ($tomonth && isset($tostatsmonth)) $date_clause.=" AND $UNIX_TIMESTAMP(calldate) <= $UNIX_TIMESTAMP('$tostatsmonth-31 23:59:59')";
	}
}else{
		if ($fromday && isset($fromstatsday_sday) && isset($fromstatsmonth_sday)) $date_clause.=" AND $UNIX_TIMESTAMP(calldate) >= $UNIX_TIMESTAMP('$fromstatsmonth_sday-$fromstatsday_sday')";
		if ($today && isset($tostatsday_sday) && isset($tostatsmonth_sday)) $date_clause.=" AND $UNIX_TIMESTAMP(calldate) <= $UNIX_TIMESTAMP('$tostatsmonth_sday-".sprintf("%02d",intval($tostatsday_sday)/*+1*/)." 23:59:59')";
}
//echo "<br>$date_clause<br>";
/*
Month
fromday today
frommonth tomonth (true)
fromstatsmonth tostatsmonth

fromstatsday_sday
fromstatsmonth_sday
tostatsday_sday
tostatsmonth_sday
*/


  
if (strpos($SQLcmd, 'WHERE') > 0) { 
	$FG_TABLE_CLAUSE = substr($SQLcmd,6).$date_clause; 
}elseif (strpos($date_clause, 'AND') > 0){
	$FG_TABLE_CLAUSE = substr($date_clause,5); 
}



if (!isset ($FG_TABLE_CLAUSE) || strlen($FG_TABLE_CLAUSE)==0){
		
		$cc_yearmonth = sprintf("%04d-%02d",date("Y"),date("n")); 	
		$FG_TABLE_CLAUSE=" $UNIX_TIMESTAMP(calldate) >= $UNIX_TIMESTAMP('$cc_yearmonth-01')";
}
//--$list_total = $instance_table_graph -> Get_list ($FG_TABLE_CLAUSE, null, null, null, null, null, null);


if ($posted==1){
	//> function Get_list ($clause=null, $order=null, $sens=null, $field_order_letter=null, $letters = null, $limite=null, $current_record = NULL)
	$list = $instance_table -> Get_list ($FG_TABLE_CLAUSE, $order, $sens, null, null, $FG_LIMITE_DISPLAY, $current_page*$FG_LIMITE_DISPLAY);
	
	$_SESSION["pr_sql_export"]="SELECT $FG_COL_QUERY FROM $FG_TABLE_NAME WHERE $FG_TABLE_CLAUSE";
	
	
	/************************/
	$QUERY = "SELECT substring(calldate,1,10) AS day, sum(billsec) AS calltime, count(*) as nbcall FROM cdr WHERE ".$FG_TABLE_CLAUSE." GROUP BY substring(calldate,1,10)"; //extract(DAY from calldate) 
	//echo "$QUERY";
	
	
			$res = $DBHandle -> query($QUERY);
			$num = $DBHandle -> num_rows();
			for($i=0;$i<$num;$i++)
				{				
					$DBHandle -> next_record();
					$list_total_day [] =$DBHandle -> Record;				 
				}
				
	if ($FG_DEBUG == 3) echo "<br>Clause : $FG_TABLE_CLAUSE";
	$nb_record = $instance_table -> Table_count ($FG_TABLE_CLAUSE);

}

//$nb_record = count($list_total);
if ($FG_DEBUG >= 1) var_dump ($list);


if ($nb_record<=$FG_LIMITE_DISPLAY){ 
	$nb_record_max=1;
}else{ 
	if ($nb_record % $FG_LIMITE_DISPLAY == 0){
		$nb_record_max=(intval($nb_record/$FG_LIMITE_DISPLAY));
	}else{
		$nb_record_max=(intval($nb_record/$FG_LIMITE_DISPLAY)+1);
	}	
}


if ($FG_DEBUG == 3) echo "<br>Nb_record : $nb_record";
if ($FG_DEBUG == 3) echo "<br>Nb_record_max : $nb_record_max";

?>

<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

//-->
</script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/table.css" />
<style type="text/css">.links3{background-color: #FFF3B3 !important;}</style>
<!-- ** ** ** ** ** Part for the research ** ** ** ** ** -->
<body onload="reportes()">
	<?php
	/*<FORM METHOD=POST ACTION="<?=$PHP_SELF?>?s=<?=$s?>&t=<?=$t?>&order=<?=$order?>&sens=<?=$sens?>&current_page=<?=$current_page?>">*/
	?>
	<FORM METHOD=POST ACTION="<?php echo base_url();?>asterisk-stats/index/s=1&t=<?=$t?>&order=<?=$order?>&sens=<?=$sens?>&current_page=<?=$current_page?>">
	<INPUT TYPE="hidden" NAME="posted" value=1>
	<INPUT TYPE="hidden" NAME="current_page" value=0>

<table width="99%" cellspacing="3" cellpading="3" border="0">
	<caption>REPORTE CDR</caption>
	<thead>
		<tr>
			<td valign="top" width="70%" class="cont-table">
				<table width="100%" cellspacing="3" cellpading="3" border="0">
<tbody><tr align="left">
        		<td>

					<input type="radio" name="Period" value="Month" <? if (($Period=="Month") || !isset($Period)){ ?>checked="checked" <? } ?>> 
					<b>Selection of the month</b>
				</td>
      			<td  colspan="4">
					
	  				<input type="checkbox" name="frommonth" value="true" <? if ($frommonth){ ?>checked<?}?>> 
					From : <select name="fromstatsmonth">
					<?	$year_actual = date("Y");  	
						for ($i=$year_actual;$i >= $year_actual-1;$i--)
						{		   
							   $monthname = array( "January", "February","March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
							   if ($year_actual==$i){
									$monthnumber = date("n")-1; // Month number without lead 0.
							   }else{
									$monthnumber=11;
							   }		   
							   for ($j=$monthnumber;$j>=0;$j--){	
										$month_formated = sprintf("%02d",$j+1);
							   			if ($fromstatsmonth=="$i-$month_formated"){$selected="selected";}else{$selected="";}
										echo "<OPTION value=\"$i-$month_formated\" $selected> $monthname[$j]-$i </option>";				
							   }
						}
					?>		
					</select>
					</td><td  colspan="8">
					<input type="checkbox" name="tomonth" value="true" <? if ($tomonth){ ?>checked<?}?>> 
					To : <select name="tostatsmonth">
					<?	$year_actual = date("Y");  	
						for ($i=$year_actual;$i >= $year_actual-1;$i--)
						{		   
							   $monthname = array( "January", "February","March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
							   if ($year_actual==$i){
									$monthnumber = date("n")-1; // Month number without lead 0.
							   }else{
									$monthnumber=11;
							   }		   
							   for ($j=$monthnumber;$j>=0;$j--){	
										$month_formated = sprintf("%02d",$j+1);
							   			if ($tostatsmonth=="$i-$month_formated"){$selected="selected";}else{$selected="";}
										echo "<OPTION value=\"$i-$month_formated\" $selected> $monthname[$j]-$i </option>";				
							   }
						}
					?>
					</select>
					
	  			</td>
    		</tr>
			
			<tr align="left">
        		<td>
					<input type="radio" name="Period" value="Day" <? if ($Period=="Day"){ ?>checked="checked" <? } ?>> 
					<b>Selection of the day</b>
				</td>
      			<td  colspan="4">
					
	  				<input type="checkbox" name="fromday" value="true" <? if ($fromday){ ?>checked<?}?>> From : 
					<select name="fromstatsday_sday">
						<? 
							for ($i=1;$i<=31;$i++){
								if ($fromstatsday_sday==sprintf("%02d",$i)){$selected="selected";}else{$selected="";}
								echo '<option value="'.sprintf("%02d",$i)."\"$selected>".sprintf("%02d",$i).'</option>';
							}
						?>	
					</select>
				 	<select name="fromstatsmonth_sday">
					<?	$year_actual = date("Y");  	
						for ($i=$year_actual;$i >= $year_actual-1;$i--)
						{		   
							   $monthname = array( "January", "February","March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
							   if ($year_actual==$i){
									$monthnumber = date("n")-1; // Month number without lead 0.
							   }else{
									$monthnumber=11;
							   }		   
							   for ($j=$monthnumber;$j>=0;$j--){	
										$month_formated = sprintf("%02d",$j+1);
							   			if ($fromstatsmonth_sday=="$i-$month_formated"){$selected="selected";}else{$selected="";}
										echo "<OPTION value=\"$i-$month_formated\" $selected> $monthname[$j]-$i </option>";				
							   }
						}
					?>
					</select>
					</td><td  colspan="8">
					<input type="checkbox" name="today" value="true" <? if ($today){ ?>checked<?}?>> To : 
					<select name="tostatsday_sday">
					<? 
						for ($i=1;$i<=31;$i++){
							if ($tostatsday_sday==sprintf("%02d",$i)){$selected="selected";}else{$selected="";}
							echo '<option value="'.sprintf("%02d",$i)."\"$selected>".sprintf("%02d",$i).'</option>';
						}
					?>						
					</select>
				 	<select name="tostatsmonth_sday">
					<?	$year_actual = date("Y");  	
						for ($i=$year_actual;$i >= $year_actual-1;$i--)
						{		   
							   $monthname = array( "January", "February","March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
							   if ($year_actual==$i){
									$monthnumber = date("n")-1; // Month number without lead 0.
							   }else{
									$monthnumber=11;
							   }		   
							   for ($j=$monthnumber;$j>=0;$j--){	
										$month_formated = sprintf("%02d",$j+1);
							   			if ($tostatsmonth_sday=="$i-$month_formated"){$selected="selected";}else{$selected="";}
										echo "<OPTION value=\"$i-$month_formated\" $selected> $monthname[$j]-$i </option>";				
							   }
						}
					?>
					</select>
	  			</td>
    		</tr>
			<tr align="left">
				<td ><b>Destination</b></td>				
				<td colspan="4"><INPUT TYPE="text" NAME="dst" value="<?=$dst?>"></td>
				<td colspan="2"><input type="radio" NAME="dsttype" value="1" <?if((!isset($dsttype))||($dsttype==1)){?>checked<?}?>>Exact</td>
				<td colspan="2"><input type="radio" NAME="dsttype" value="2" <?if($dsttype==2){?>checked<?}?>>Begins with</td>
				<td colspan="2"><input type="radio" NAME="dsttype" value="3" <?if($dsttype==3){?>checked<?}?>>Contains</td>
				<td colspan="2"><input type="radio" NAME="dsttype" value="4" <?if($dsttype==4){?>checked<?}?>>Ends with</td>
			</tr>			
			<tr align="left">
				<td><b>Source</b></td>				
				<td colspan="4"><INPUT TYPE="text" NAME="src" value="<?echo "$src";?>"></td>
				<td colspan="2"><input type="radio" NAME="sourcetype" value="1" <?if((!isset($sourcetype))||($sourcetype==1)){?>checked<?}?>>Exact</td>
				<td colspan="2"><input type="radio" NAME="sourcetype" value="2" <?if($sourcetype==2){?>checked<?}?>>Begins with</td>
				<td colspan="2"><input type="radio" NAME="sourcetype" value="3" <?if($sourcetype==3){?>checked<?}?>>Contains</td>
				<td colspan="2"><input type="radio" NAME="sourcetype" value="4" <?if($sourcetype==4){?>checked<?}?>>Ends with</td>
			</tr>
			<tr align="left">
				<td><b>Cli</b></td>				
				<td colspan="4"><INPUT TYPE="text" NAME="clid" value="<?=$clid?>"></td>
				<td colspan="2"><input type="radio" NAME="clidtype" value="1" <?if((!isset($clidtype))||($clidtype==1)){?>checked<?}?>>Exact</td>
				<td colspan="2"><input type="radio" NAME="clidtype" value="2" <?if($clidtype==2){?>checked<?}?>>Begins with</td>
				<td colspan="2"><input type="radio" NAME="clidtype" value="3" <?if($clidtype==3){?>checked<?}?>>Contains</td>
				<td colspan="2"><input type="radio" NAME="clidtype" value="4" <?if($clidtype==4){?>checked<?}?>>Ends with</td>
			</tr>
			<tr align="left">
				<td><b>Userfield</b></td>				
				<td colspan="4"><INPUT TYPE="text" NAME="userfield" value="<?echo "$userfield";?>"></td>
				<td colspan="2"><input type="radio" NAME="userfieldtype" value="1" <?if((!isset($userfieldtype))||($userfieldtype==1)){?>checked<?}?>>Exact</td>
				<td colspan="2"><input type="radio" NAME="userfieldtype" value="2" <?if($userfieldtype==2){?>checked<?}?>>Begins with</td>
				<td colspan="2"><input type="radio" NAME="userfieldtype" value="3" <?if($userfieldtype==3){?>checked<?}?>>Contains</td>
				<td colspan="2"><input type="radio" NAME="userfieldtype" value="4" <?if($userfieldtype==4){?>checked<?}?>>Ends with</td>
			</tr>
			<tr align="left">
				<td><b>Accountcode</b></td>				
				<td colspan="4"><INPUT TYPE="text" NAME="accountcode" value="<?=$accountcode?>"></td>
				<td colspan="2"><input type="radio" NAME="accountcodetype" value="1" <?if((!isset($accountcodetype))||($accountcodetype==1)){?>checked<?}?>>Exact</td>
				<td colspan="2"><input type="radio" NAME="accountcodetype" value="2" <?if($accountcodetype==2){?>checked<?}?>>Begins with</td>
				<td colspan="2"><input type="radio" NAME="accountcodetype" value="3" <?if($accountcodetype==3){?>checked<?}?>>Contains</td>
				<td colspan="2"><input type="radio" NAME="accountcodetype" value="4" <?if($accountcodetype==4){?>checked<?}?>>Ends with</td>
			</tr>			
			<tr align="left">
			<td><b>Channel</b></td>				
				<td colspan="4"><INPUT TYPE="text" NAME="channel" value="<?=$channel?>"></td>
				<td colspan="8">&nbsp;</td>
			</tr>

			<tr align="left">
				<td><b>Duration</b></td>
				<td><INPUT TYPE="text" NAME="billsec1" size="4" value="<?=$billsec1?>"></td>	
				<td><input type="radio" NAME="billsec1type" value="4" <?if($billsec1type==4){?>checked<?}?>>&gt;</td>
				<td><input type="radio" NAME="billsec1type" value="5" <?if($billsec1type==5){?>checked<?}?>>&gt; egal</td>
				<td><input type="radio" NAME="billsec1type" value="1" <?if((!isset($billsec1type))||($billsec1type==1)){?>checked<?}?>>Egal</td>
				<td><input type="radio" NAME="billsec1type" value="2" <?if($billsec1type==2){?>checked<?}?>>&lt; egal</td>
				<td><input type="radio" NAME="billsec1type" value="3" <?if($billsec1type==3){?>checked<?}?>>&lt;</td>	
				<td>&nbsp;</td>
				
				<td><INPUT TYPE="text" NAME="billsec2" size="4" value="<?=$billsec2?>"></td>			
				<td><input type="radio" NAME="billsec2type" value="4" <?if($billsec2type==4){?>checked<?}?>>&gt;</td>
				<td><input type="radio" NAME="billsec2type" value="5" <?if($billsec2type==5){?>checked<?}?>>&gt; egal</td>								
				<td><input type="radio" NAME="billsec2type" value="2" <?if($billsec2type==1){?>checked<?}?>>&lt; egal</td>
				<td><input type="radio" NAME="billsec2type" value="3" <?if($billsec2type==3){?>checked<?}?>>&lt;</td>	
				</td>
			</tr>	


			<tr>

				<td colspan="13" align="center">
					<!--input type="image"  name="image16" align="top" border="0" src="images/button-search.gif" /-->
					<input type="submit" name="image16" value="Enviar" class="btn-person">
					Result : Minutes<input type="radio" NAME="resulttype" value="min" <?if((!isset($resulttype))||($resulttype=="min")){?>checked<?}?>> - Seconds <input type="radio" NAME="resulttype" value="sec" <?if($resulttype=="sec"){?>checked<?}?>>
	  			</td>
    		</tr>
		</tbody>					
				</table>
			</td>
			<td valign="top" width="30%" class="cont-table">
				<div style="width:100%; display:block;"></div>
			</td>
		</tr>
	</thead>
</table>


	</FORM>



<br><br>

<!-- ** ** ** ** ** Part to display the CDR ** ** ** ** ** -->

			<center>Number of calls : <? if (is_array($list) && count($list)>0){ echo $nb_record; }else{echo "0";}?></center>
      <table width="<?=$FG_HTML_TABLE_WIDTH?>" border="0" align="center" cellpadding="0" cellspacing="0">
      	<CAPTION><?=$FG_HTML_TABLE_TITLE?> <IMG alt="Back to Top" border=0 height=12 src="<?php echo base_url();?>modules/asterisk-stats/images/btn_top_12x12.gif" width=12></CAPTION>

        
      	<thead>
                <TR bgColor=#F0F0F0> 
				  <th width="<?=$FG_ACTION_SIZE_COLUMN?>" align=center class="tableBodyRight" style="PADDING-BOTTOM: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px; PADDING-TOP: 2px"></th>					
				  
                  <?php 
				  	if (is_array($list) && count($list)>0){
					
				  	for($i=0;$i<$FG_NB_TABLE_COL;$i++){ 
						//$FG_TABLE_COL[$i][1];			
						//$FG_TABLE_COL[]=array ("Name", "name", "20%");
					?>				
				  
					
                  <th width="<?=$FG_TABLE_COL[$i][2]?>" align=middle class="tableBody" style="PADDING-BOTTOM: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px; PADDING-TOP: 2px"> 
                    <center><strong> 
                    <? if (strtoupper($FG_TABLE_COL[$i][4])=="SORT"){?>
                    <a href="<?php echo base_url() ."asterisk-stats/index/s=1&t=$t&stitle=$stitle&atmenu=$atmenu&current_page=$current_page&order=".$FG_TABLE_COL[$i][1]."&sens="; if ($sens=="ASC"){echo"DESC";}else{echo"ASC";} 
					echo "&posted=$posted&Period=$Period&frommonth=$frommonth&fromstatsmonth=$fromstatsmonth&tomonth=$tomonth&tostatsmonth=$tostatsmonth&fromday=$fromday&fromstatsday_sday=$fromstatsday_sday&fromstatsmonth_sday=$fromstatsmonth_sday&today=$today&tostatsday_sday=$tostatsday_sday&tostatsmonth_sday=$tostatsmonth_sday&dsttype=$dsttype&sourcetype=$sourcetype&clidtype=$clidtype&channel=$channel&resulttype=$resulttype&dst=$dst&src=$src&clid=$clid";?>
                    <span class="liens"><? } ?>
                    <?=$FG_TABLE_COL[$i][0]?> 
                    <?if ($order==$FG_TABLE_COL[$i][1] && $sens=="ASC"){?>
                    &nbsp;<img src="<?php echo base_url();?>modules/asterisk-stats/images/icon_up_12x12.GIF" width="12" height="12" border="0"> 
                    <?}elseif ($order==$FG_TABLE_COL[$i][1] && $sens=="DESC"){?>
                    &nbsp;<img src="<?php echo base_url();?>modules/asterisk-stats/images/icon_down_12x12.GIF" width="12" height="12" border="0"> 
                    <?}?>
                    <? if (strtoupper($FG_TABLE_COL[$i][4])=="SORT"){?>
                    </span></a> 
                    <?}?>
                    </strong></center></th>
				   <?php } ?>		
				  	
                </TR>
            </thead>
            <TBODY>    
                <TR> 
                  <TD bgColor=#e1e1e1 colSpan=<?=$FG_TOTAL_TABLE_COL?> height=1><IMG 
                              height=1 
                              src="<?php echo base_url();?>modules/asterisk-stats/images/clear.gif" 
                              width=1></TD>
                </TR>
				<?php
				
				
				  
				  	 $ligne_number=0;					 
					 //print_r($list);
				  	 foreach ($list as $recordset){ 
						 $ligne_number++;

						 $item = $cont + 1;
						if (($item) % 2 == 0){
						    $est_td = "odd";
						}else{
						    $est_td = "";
						}
						echo "<tr class=\"$est_td\">";
				?>
				
               		 <!--TR bgcolor="<?=$FG_TABLE_ALTERNATE_ROW_COLOR[$ligne_number%2]?>"  onMouseOver="bgColor='#C4FFD7'" onMouseOut="bgColor='<?=$FG_TABLE_ALTERNATE_ROW_COLOR[$ligne_number%2]?>'"--> 
						<TD vAlign=top align="<?=$FG_TABLE_COL[$i][3]?>" class=tableBody><? echo $ligne_number+$current_page*$FG_LIMITE_DISPLAY.".&nbsp;"; ?></TD>
							 
				  		<?php for($i=0;$i<$FG_NB_TABLE_COL;$i++){ ?>
						
						  
						<?	//$FG_TABLE_COL[$i][1];			
							//$FG_TABLE_COL[]=array ("Name", "name", "20%");
							
							
							if ($FG_TABLE_COL[$i][6]=="lie"){


									$instance_sub_table = new Table($FG_TABLE_COL[$i][7], $FG_TABLE_COL[$i][8]);
									$sub_clause = str_replace("%id", $recordset[$i], $FG_TABLE_COL[$i][9]);																																	
									$select_list = $instance_sub_table -> Get_list ($sub_clause, null, null, null, null, null, null);
									
									
									$field_list_sun = split(',',$FG_TABLE_COL[$i][8]);
									$record_display = $FG_TABLE_COL[$i][10];
									//echo $record_display;
									
									for ($l=1;$l<=count($field_list_sun);$l++){										
										$record_display = str_replace("%$l", $select_list[0][$l-1], $record_display);	
									}
								
							}elseif ($FG_TABLE_COL[$i][6]=="list"){
									$select_list = $FG_TABLE_COL[$i][7];
									$record_display = $select_list[$recordset[$i]][0];
							
							}else{
									$record_display = $recordset[$i];
							}
							
							
							if ( is_numeric($FG_TABLE_COL[$i][5]) && (strlen($record_display) > $FG_TABLE_COL[$i][5])  ){
								$record_display = substr($record_display, 0, $FG_TABLE_COL[$i][5]-3)."";  
															
							}
							
							
				 		 ?>
                 		 <TD vAlign=top align="<?=$FG_TABLE_COL[$i][3]?>" class=tableBody><?
				 
				 
				 
						 if (isset ($FG_TABLE_COL[$i][11]) && strlen($FG_TABLE_COL[$i][11])>1){
						 		call_user_func($FG_TABLE_COL[$i][11], $record_display);
						 }else{
					//	 		echo stripslashes($record_display);
//						  if (strlen($record_display)==3){ echo stripslashes("<a href=http://10.10.10.14/".$record_display.".wav".">".$record_display."</a>");}
  if ($i==2) $NA1=$record_display; else 0;
  if ($i==6) $NA2=$record_display; else 0;
//  if ($i==0) $NA3=$record_display; else 0; "\n"
  if ($i==0) $NA3=split(" ",$record_display); else 0;
  $NA31=split("-",$NA3[0]); 
  $NA32=split(":",$NA3[1]);   
  $NOMBREARCHIVO=$NA1."-".$NA2."-".$NA31[0].$NA31[1].$NA31[2]."-".$NA32[0].$NA32[1].$NA32[2].".gsm";
//  $NOMBREARCHIVO=$NA1."-".$NA2."-".$NA3.".gsm";

						  if ($i==10){ echo stripslashes("");}
						  else{	 		echo stripslashes($record_display);}

						 }						 
						 ?></TD>
				 		 <? } ?>
                  
					</TR>
				<?php
				$cont ++;
					 }//foreach ($list as $recordset)
					 while ($ligne_number < $FG_LIMITE_DISPLAY){
					 	$ligne_number++;
				?>
					<TR bgcolor="<?=$FG_TABLE_ALTERNATE_ROW_COLOR[$ligne_number%2]?>"> 
				  		<?php for($i=0;$i<$FG_NB_TABLE_COL;$i++){ 
							//$FG_TABLE_COL[$i][1];			
							//$FG_TABLE_COL[]=array ("Name", "name", "20%");
				 		 ?>
                 		 <TD vAlign=top class=tableBody>&nbsp;</TD>
				 		 <? } ?>
                 		 <TD align="center" vAlign=top class=tableBodyRight>&nbsp;</TD>				
					</TR>
									
				<?php					 
					 } //END_WHILE
					 
				  }else{
				  		echo "No data found !!!";				  
				  }//end_if
				 ?>
                <TR> 
                  <TD class=tableDivider colSpan=<?=$FG_TOTAL_TABLE_COL?>><IMG height=1 
                              src="<?php echo base_url();?>modules/asterisk-stats/images/clear.gif" 
                              width=1></TD>
                </TR>
                <TR> 
                  <TD class=tableDivider colSpan=<?=$FG_TOTAL_TABLE_COL?>><IMG height=1 
                              src="<?php echo base_url();?>modules/asterisk-stats/images/clear.gif" 
                              width=1></TD>
                </TR>

              

        
         
                <TR> 
                  <TD colspan="11" align="right"><SPAN style="COLOR: #ffffff; FONT-SIZE: 11px"><B> 
                    <?if ($current_page>0){?>
                    <img src="<?php echo base_url();?>modules/asterisk-stats/images/fleche-g.gif" width="5" height="10"> <a href="<?php echo base_url();?>asterisk-stats/index/s=1&t=<?=$t?>&order=<?=$order?>&sens=<?=$sens?>&current_page=<? echo ($current_page-1)?><? if (!is_null($letter) && ($letter!="")){ echo "&letter=$letter";} 
					echo "&posted=$posted&Period=$Period&frommonth=$frommonth&fromstatsmonth=$fromstatsmonth&tomonth=$tomonth&tostatsmonth=$tostatsmonth&fromday=$fromday&fromstatsday_sday=$fromstatsday_sday&fromstatsmonth_sday=$fromstatsmonth_sday&today=$today&tostatsday_sday=$tostatsday_sday&tostatsmonth_sday=$tostatsmonth_sday&dsttype=$dsttype&sourcetype=$sourcetype&clidtype=$clidtype&channel=$channel&resulttype=$resulttype&dst=$dst&src=$src&clid=$clid&channel=$channel&resulttype=$resulttype&dst=$dst&src=$src&clid=$clid&userfieldtype=$userfieldtype&userfield=$userfield&accountcodetype=$accountcodetype&accountcode=$accountcode&billsec1=$billsec1&billsec1type=$billsec1type&billsec2=$billsec2&billsec2type=$billsec2type";?>"> 
                    Previous </a> - 
                    <?}?>
                    <?echo ($current_page+1);?> / <? echo $nb_record_max;?> 
                    <?if ($current_page<$nb_record_max-1){?>
                    - <a href="<?php echo base_url();?>asterisk-stats/index/s=1&t=<?=$t?>&order=<?=$order?>&sens=<?=$sens?>&current_page=<? echo ($current_page+1)?><? if (!is_null($letter) && ($letter!="")){ echo "&letter=$letter";} 
					echo "&posted=$posted&Period=$Period&frommonth=$frommonth&fromstatsmonth=$fromstatsmonth&tomonth=$tomonth&tostatsmonth=$tostatsmonth&fromday=$fromday&fromstatsday_sday=$fromstatsday_sday&fromstatsmonth_sday=$fromstatsmonth_sday&today=$today&tostatsday_sday=$tostatsday_sday&tostatsmonth_sday=$tostatsmonth_sday&dsttype=$dsttype&sourcetype=$sourcetype&clidtype=$clidtype&channel=$channel&resulttype=$resulttype&dst=$dst&src=$src&clid=$clid&channel=$channel&resulttype=$resulttype&dst=$dst&src=$src&clid=$clid&userfieldtype=$userfieldtype&userfield=$userfield&accountcodetype=$accountcodetype&accountcode=$accountcode&billsec1=$billsec1&billsec1type=$billsec1type&billsec2=$billsec2&billsec2type=$billsec2type";?>"> 
                    Next </a> <img src="<?php echo base_url();?>modules/asterisk-stats/images/fleche-d.gif" width="5" height="10"> 
                    </B></SPAN> 
                    <?}?>
                  </TD>
             
            
        </TR> </TBODY>
      </table>

<!-- ** ** ** ** ** Part to display the GRAPHIC ** ** ** ** ** -->
<br><br>

<?

if (is_array($list_total_day) && count($list_total_day)>0){
/*if (is_array($list) && count($list)>0){

$table_graph=array();
$numm=0;
foreach ($list_total as $recordset){
		$numm++;
		$mydate= substr($recordset[0],0,10);
		//echo "$mydate<br>";
		
		if (is_array($table_graph[$mydate])){
			$table_graph[$mydate][0]++;
			$table_graph[$mydate][1]=$table_graph[$mydate][1]+$recordset[1];
		}else{
			$table_graph[$mydate][0]=1;
			$table_graph[$mydate][1]=$recordset[1];
		}
		
}*/


$mmax=0;
$totalcall==0;
$totalminutes=0;
foreach ($list_total_day as $data){	
	if ($mmax < $data[1]) $mmax=$data[1];
	$totalcall+=$data[2];
	$totalminutes+=$data[1];
}
//echo "<br/>$totalcall-$totalminutes";


/*foreach ($table_graph as $tkey => $data){	
	if ($mmax < $data[1]) $mmax=$data[1];
	$totalcall+=$data[0];
	$totalminutes+=$data[1];
}*/
//print_r($table_graph);

?>


<!-- TITLE GLOBAL -->
<center>
		  
<!-- FIN TITLE GLOBAL MINUTES //-->
	<br>	

<table width="99%" cellspacing="3" cellpading="3" border="0">
	<caption>TOTAL - ASTERISK MINUTES</caption>
	<thead>
		<tr>
			<td valign="top" width="50%" class="cont-table">
				<table width="100%" cellspacing="3" cellpading="3" border="0">
<thead>
	<tr>
		<th>DATE</th>
        <th>DURATION</th>
		<th>GRAPHIC</th>
		<th>CALLS</th>
		<th> <acronym title="Average Connection Time">ACT</acronym> </th>
                			
		<!-- LOOP -->
	<? 		
		$i=0;
		// #ffffff #cccccc
		foreach ($list_total_day as $data){	
		$i=($i+1)%2;		
		$tmc = $data[1]/$data[2];		
		
		if ((!isset($resulttype)) || ($resulttype=="min")){  
			$tmc = sprintf("%02d",intval($tmc/60)).":".sprintf("%02d",intval($tmc%60));		
		}else{
		
			$tmc =intval($tmc);
		}
		
		if ((!isset($resulttype)) || ($resulttype=="min")){  
				$minutes = sprintf("%02d",intval($data[1]/60)).":".sprintf("%02d",intval($data[1]%60));
		}else{
				$minutes = $data[1];
		}
		$widthbar= intval(($data[1]/$mmax)*200); 
		
		//bgcolor="#336699" 
	?>
		</tr>
	</thead>
<?php 

$item = $cont + 1;
if (($item) % 2 == 0){
    $est_td = "odd";
}else{
    $est_td = "";
}
echo "<tr class=\"$est_td\">";
?>
		
		<td align="right" nowrap="nowrap"><?=$data[0]?></td>
		<td align="right" nowrap="nowrap"><?=$minutes?> </td>
        <td align="left" nowrap="nowrap" width="<?=$widthbar+60?>">
	        <img src="<?php echo base_url();?>modules/asterisk-stats/images/spacer.gif" width="<?=$widthbar?>" height="6">
    	</td>
        <td align="right" nowrap="nowrap"><?=$data[2]?></td>
        <td align="right" nowrap="nowrap"><?=$tmc?> </td>
     <?	 
     	$cont ++;
 		}	 	 	
	 	
		if ((!isset($resulttype)) || ($resulttype=="min")){  
			$total_tmc = sprintf("%02d",intval(($totalminutes/$totalcall)/60)).":".sprintf("%02d",intval(($totalminutes/$totalcall)%60));				
			$totalminutes = sprintf("%02d",intval($totalminutes/60)).":".sprintf("%02d",intval($totalminutes%60));
		}else{
			$total_tmc = intval($totalminutes/$totalcall);			
		}
	 
	 ?>                   	
	</tr>
	<!-- FIN DETAIL -->		
	
				
				<!-- FIN BOUCLE -->

	<!-- TOTAL -->
	<tr>
		<td align="right" nowrap="nowrap"><b>TOTAL</b></td>
		<td align="center" nowrap="nowrap" colspan="2"><b><?=$totalminutes?> </b></td>
		<td align="center" nowrap="nowrap"><b><?=$totalcall?></b></td>
		<td align="center" nowrap="nowrap"><b><?=$total_tmc?></b></td>                        
	</tr>
	<!-- FIN TOTAL -->


	  <!-- Fin Tableau Global //-->

</td></tr>					
				</table>
			</td>
			<td valign="top" width="50%" class="cont-table">
				<div style="width:100%; display:block;"></div>
			</td>
		</tr>
	</thead>
</table>



<br/>
<table align="left" style="width:50% !important;"><tr><td>
<a href="<?php echo base_url();?>asterisk-stats/export_pdf" target="_blank"><img src="<?php echo base_url();?>modules/asterisk-stats/images/pdf.gif	" border="0"/></a> <a href="<?php echo base_url();?>asterisk-stats/export_pdf" target="_blank">Export PDF file</a>
</td>
<td>
<a href="<?php echo base_url();?>asterisk-stats/export_csv" target="_blank" ><img src="<?php echo base_url();?>modules/asterisk-stats/images/excel.gif" border="0"/></a> <a href="<?php echo base_url();?>asterisk-stats/export_csv" target="_blank">Export CSV file</a>
</td></tr></table>


<? }else{ ?>
	<center><h3>No calls in your selection.</h3></center>
<? } ?>
</center>
</body>

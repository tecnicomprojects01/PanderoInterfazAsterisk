<?Php 
	//include_once("datos.llamadas.grabadas.php");
?>
	<script>
	$(function() {
		$( "#txtFechaDesde" ).datepicker({ dateFormat: 'dd/mm/yy' });
		$( "#txtFechaHasta" ).datepicker({ dateFormat: 'dd/mm/yy' });

	});
	</script>
<!--<div class="demo">

<p>Date: <input id="datepicker" type="text"></p>

</div>-->
		<table class="lvtBg" width="80%" cellspacing="1" cellpadding="0" border="0">
			<tbody>
				<tr>
					<td width='100%'>
						<table class="layerPopupTransport" width="80%" border="0">
							<tbody>
								<tr>
								  <td class="small" align="left" width="80%" nowrap=""> 										
										 Origen
										<input  type="text" id="txtAnexo" name="txtAnexo" style="width:60px" >
										| Destino
										<input  type="text" id="txtNumero" name="txtNumero" style="width:60px">
									

<!---modificado 09/10/2013-->

								<!--	<select class="small" style='width:130px' tabindex="" name="cbCola" id="cbCola">
										<?Php while($flConsultaQueue = mysql_fetch_array($rsConsultaQueue)){ ?>
											<option value="<?Php echo $flConsultaQueue['iId_Queue'] ?>" selected="selected"><?Php echo $flConsultaQueue['vNombre_Queue']; ?></option>
										<?Php } ?>
										<option value="0" selected="selected">--Seleccione Cola--</option>																	
									</select> |
									Agentes 
									<select class="small" tabindex="" name="cbAgente" id="cbAgente">
										<?Php while($flConsultaAgent = mysql_fetch_array($rsConsultaAgent)){ ?>
											<option value="<?Php echo $flConsultaAgent['iid_agent'] ?>" selected="selected"><?Php echo $flConsultaAgent['vnick_user']." - ".$flConsultaAgent['vlastname_agent'].", ".$flConsultaAgent['vfirstname_agent'] ?></option>
										<?Php } ?>
										<option value="0" selected="selected">--Seleccione Agente--</option>																	
									</select> |
                                  -->  
<!--fin de la modificacion -->                                   
									<!--<div class="demo">-->
											Desde : <input  type="text" id="txtFechaDesde" name="txtFechaDesde" style="width:80px" value="<?Php echo date('d/m/Y'); ?>">
									<!--</div>-->
									<select id="cbHoraDesde" name="cbHoraDesde">
											<?Php  
												for($horaDesde=0;$horaDesde<=23;$horaDesde++){
													echo "<option value=".($horaDesde<10? "0".$horaDesde : $horaDesde ).">".($horaDesde<10? "0".$horaDesde : $horaDesde )."</option>";
												}
											?>										
									</select>	
									<select id="cbMinDesde" name="cbMinDesde">
										<?Php 
											for($minDesde=0;$minDesde<60;$minDesde++){
												echo "<option value=".($minDesde<10? "0".$minDesde : $minDesde ).">".($minDesde<10? "0".$minDesde : $minDesde )."</option>";
											}
										?>											
									</select>
									<!--<input style='width:55px' type="text" name="txtHoraDesde" id="txtHoraDesde" value="<?Php echo date('h:m:s'); ?>">-->
									<!--<div class="demo">-->
											Hasta : <input  type="text" id="txtFechaHasta" name="txtFechaHasta" style="width:80px" value="<?Php echo date('d/m/Y'); ?>">
									<!--</div>-->
									<select id="cbHoraHasta" name="cbHoraHasta">
											<?Php  
												for($horaHasta=0;$horaHasta<=23;$horaHasta++){
													if($horaHasta==23){
														echo "<option selected='selected' value=".($horaHasta<10? "0".$horaHasta : $horaHasta ).">".($horaHasta<10? "0".$horaHasta : $horaHasta )."</option>";	
													}else{
													  echo "<option value=".($horaHasta<10? "0".$horaHasta : $horaHasta ).">".($horaHasta<10? "0".$horaHasta : $horaHasta )."</option>";
												}
												}
											?>										
									</select>
									<select id="cbMinHasta" name="cbMinHasta">
                                      <?Php 
											for($minHasta=0;$minHasta<60;$minHasta++){
												if($minHasta==59){
													echo "<option selected='selected' value=".($minHasta<10? "0".$minHasta : $minHasta ).">".($minHasta<10? "0".$minHasta : $minHasta )."</option>";
												}else{
												echo "<option value=".($minHasta<10? "0".$minHasta : $minHasta ).">".($minHasta<10? "0".$minHasta : $minHasta )."</option>";
											}
											}
										?>
                                    </select>
									<!--Estado 
									<select class="small" tabindex="" name="cbEstado" id="cbEstado">
										<option value="1" selected="selected">Contestada</option>
										<option value="2" selected="selected">No Contestada</option>
										<option value="3" selected="selected">Ocupado</option>
										<option value="0" selected="selected">--Seleccione Estado--</option>															
									</select>-->
									
                                   <!-- Recursos: <select class="small" tabindex="" name="cbtipo" id="cbtipo">
                                      <option value="1" selected="selected">Entrante</option>
                                      <option value="2" selected="selected">Saliente</option>
                                      <option value="0" selected="selected"></option>
                                     </select>--> 
                              		Entrante <input type='checkbox' checked='checked' name='chkEntSal' id='chkEnt'> / Salientes <input type='checkbox' name='chkEntSal' id='chkSal'>
                                      </Form>
                                    </td>							
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td>						

						<table class="small" width="80%" cellspacing="0" cellpadding="2" border="0">
							<tbody>
								<tr>
									<td nowrap="" style="padding-right:20px">
										<input class="crmbutton small edit" type="button" onclick="consultarReporte(4,'lista_reportes')" value="Search">


										<input class="crmbutton small delete" type="button" onclick="return massDelete('Leads')" value="Cancel">
										<!--<input class="crmbutton small edit" type="button" onclick="generaExcel(2);" value="Exp a Excel">
										<input class="crmbutton small edit" type="button" onclick="ShowPage('apps/colas/form/colas.nuevo.php','content')" value="Exp a Pdf">-->
										
										<div id='iddescarga'></div>
											
									</td>
									<td align="right" style="padding: 5px;">
														<!--<img align="absmiddle" border="0" src="themes/images/start_disabled.gif">
														<img align="absmiddle" border="0" src="themes/images/previous_disabled.gif">
														<input class="small" type="text" onkeypress="return VT_disableFormSubmit(event);" onchange="getListViewEntries_js('Leads','parenttab=Marketing&start='+this.value+'');" style="width: 3em;margin-right: 0.7em;" value="1" name="pagenum">
														<span class="small" style="white-space: nowrap;" name="Leads_listViewCountContainerName">of 1</span>
														<img align="absmiddle" border="0" src="themes/images/next_disabled.gif">
														<img align="absmiddle" border="0" src="themes/images/end_disabled.gif">-->
													</td>
								</tr>
							</tbody>
						</table>

<div id='recarga' name='recarga'></div>
						<div id='lista_reportes'>
							<?Php include_once('llamadas.grabadas.lista.php'); ?>
						</div>


					</td>
				</tr>				
			</tbody>
		</table>


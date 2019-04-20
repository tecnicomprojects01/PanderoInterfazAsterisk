<?Php 
	include_once("apps/reportes/datos/reporte.llamadas.grabadas.php");
?>

<div class="demo">

<p>Date: <input id="datepicker" type="text"></p>

</div>
		<table class="lvtBg" width="100%" cellspacing="1" cellpadding="0" border="1">
			<tbody>
				<tr>
					<td width='100%'>
						<table class="layerPopupTransport" width="100%" border=1>
							<tbody>
								<tr>
									<td class="small" align="left" width="100%" nowrap=""> Cola 
									<select class="small" style='width:130px' tabindex="" name="cbCola" id="cbCola">
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
									</select> | Desde 
									<input style='width:67px' type="text" name="txtFechaDesde" id="txtFechaDesde" value="<?Php echo date('d/m/Y'); ?>">
									<input style='width:55px' type="text" name="txtHoraDesde" id="txtHoraDesde" value="<?Php echo date('h:m:s'); ?>">
												Hasta 
									<input style='width:67px' type="text" name="txtFechaHasta" id="txtFechaHasta" value="<?Php echo date('d/m/Y'); ?>">
									<input style='width:55px' type="text" name="txtHoraHasta" id="txtHoraHasta" value="<?Php echo date('h:m:s'); ?>">
									|
									Ent <input type='checkbox' checked='checked' name='chkEntSal' id='chkEnt'> / Sal <input checked='checked' type='checkbox' name='chkEntSal' id='chkSal'> 
									|
									Estado 
									<select class="small" tabindex="" name="cbEstado" id="cbEstado">
										<option value="1" selected="selected">Contestada</option>
										<option value="2" selected="selected">No Contestada</option>
										<option value="3" selected="selected">Ocupado</option>
										<option value="0" selected="selected">--Seleccione Estado--</option>															
									</select>
									</td>							
									
								</tr>
							</tbody>
						</table>


					</td>
				</tr>
				<tr>
					<td>						

						<table class="small" width="100%" cellspacing="0" cellpadding="2" border="0">
							<tbody>
								<tr>
									<td nowrap="" style="padding-right:20px">
										<input class="crmbutton small edit" type="button" onclick="consultarReporte(4,'lista_reportes')" value="Search">
										<input class="crmbutton small edit" type="button" onclick="generaExcel(2);" value="Exp a Excel">
										<input class="crmbutton small edit" type="button" onclick="ShowPage('apps/colas/form/colas.nuevo.php','content')" value="Exp a Pdf">
										<input class="crmbutton small delete" type="button" onclick="return massDelete('Leads')" value="Cancel">										
										<a href="#" onclick="javascript:mostrarrr('apps/reportes/form/compdes.php');"><input class="crmbutton small delete" type="button" onclick="" value="Download"></a>
										<div id='iddescarga'></div>
										
									</td>
									<td align="right" style="padding: 5px;">
														<img align="absmiddle" border="0" src="themes/images/start_disabled.gif">
														<img align="absmiddle" border="0" src="themes/images/previous_disabled.gif">
														<input class="small" type="text" onkeypress="return VT_disableFormSubmit(event);" onchange="getListViewEntries_js('Leads','parenttab=Marketing&start='+this.value+'');" style="width: 3em;margin-right: 0.7em;" value="1" name="pagenum">
														<span class="small" style="white-space: nowrap;" name="Leads_listViewCountContainerName">of 1</span>
														<img align="absmiddle" border="0" src="themes/images/next_disabled.gif">
														<img align="absmiddle" border="0" src="themes/images/end_disabled.gif">
													</td>
								</tr>
							</tbody>
						</table>



						<div id='lista_reportes'>
							<?Php include_once('reporte.llamadas.grabadas.lista.php'); ?>
						</div>


						<table width="100%" cellspacing="0" cellpadding="2" border="0">
							<tbody>
								<tr>
									<td nowrap="" style="padding-right:20px">
										<input class="crmbutton small edit" type="button" onclick="consultarReporte(4,'lista_reportes')" value="Search">
										<input class="crmbutton small edit" type="button" onclick="generaExcel(2);" value="Exp a Excel">
										<input class="crmbutton small edit" type="button" onclick="ShowPage('apps/colas/form/colas.nuevo.php','content')" value="Exp a Pdf">
										<input class="crmbutton small delete" type="button" onclick="return massDelete('Leads')" value="Cancel">										
									</td>
									<td align="right" width="40%">
										<table class="small" cellspacing="0" cellpadding="0" border="0">
											<tbody>
												<tr>
													<td>
														<table class="small" cellspacing="0" cellpadding="0" border="0">
															<tbody>
																<tr>
																	<td align="right" style="padding: 5px;">
																		<img align="absmiddle" border="0" src="themes/images/start_disabled.gif">
																		<img align="absmiddle" border="0" src="themes/images/previous_disabled.gif">
																		<input class="small" type="text" onkeypress="return VT_disableFormSubmit(event);" onchange="getListViewEntries_js('Leads','parenttab=Marketing&start='+this.value+'');" style="width: 3em;margin-right: 0.7em;" value="1" name="pagenum">
																		<span class="small" style="white-space: nowrap;" name="Leads_listViewCountContainerName">of 1</span>
																		<img align="absmiddle" border="0" src="themes/images/next_disabled.gif">
																		<img align="absmiddle" border="0" src="themes/images/end_disabled.gif">
																	</td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>				
			</tbody>
		</table>
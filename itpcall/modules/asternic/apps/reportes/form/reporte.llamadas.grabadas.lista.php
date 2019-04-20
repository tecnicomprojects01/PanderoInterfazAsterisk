<?Php include_once('apps/reportes/datos/reporte.llamadas.grabadas.lista.php') ?>
<table class="lvt small" width="100%" cellspacing="1" cellpadding="3" border="0">
							<tbody>
								<tr>
									<td class="lvtCol">
										<input id="chk0" type="checkbox" onclick="checktodos();" name="chk0">
									</td>
									<td class="lvtCol">
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lead_no&start=&sorder=ASC");" href="javascript:;">Agente</a>
									</td>
									<td class="lvtCol">
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">Cola</a>
									</td>
									<td class="lvtCol">
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">Usuario</a>
									</td>
									<td class="lvtCol">
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">Fecha</a>
									</td>
									<td class="lvtCol">
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">Time</a>
									</td>
									<td class="lvtCol">
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">Dur Tot</a>
									</td>
									<td class="lvtCol">
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">Dur Llamada</a>
									</td>
									<td class="lvtCol">
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">Ent /Sal</a>
									</td>
									<td class="lvtCol">
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">State</a>
									</td>
									<td class="lvtCol">
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">File Name</a>
									</td>

									<td class="lvtCol">Action</td>
									</tr>
									<tr>
										<td id="linkForSelectAll" class="linkForSelectAll" colspan="15" style="display:none;">
											<span id="selectAllRec" class="selectall" onclick="toggleSelectAll_Records('Leads',true,'selected_id')" style="display:inline;">
												Select All
											<span id="count"> </span>
												records in Leads
											</span>
											<span id="deSelectAllRec" class="selectall" onclick="toggleSelectAll_Records('Leads',false,'selected_id')" style="display:none;">Deselect all Leads</span>
										</td>
									</tr>

									<?Php 
									$x=1;	
									while($flGrabacionLlamadaAgente=mysql_fetch_array($rsGrabacionLlamadaAgente)){ ?>

									<tr id="row_2" class="lvtColData" bgcolor="white" onmouseout="this.className='lvtColData'" onmouseover="this.className='lvtColDataHover'">
										<td width="2%">
											<input id="chk<?Php echo $x; ?>" type="checkbox" onclick="check_object(this)" value="<?Php echo $flGrabacionLlamadaAgente['vfilename_eventlog']; ?>" name="chk<?Php echo $x; ?>">
										</td>
										<td onmouseout="vtlib_listview.trigger('cell.onmouseout', $(this))" onmouseover="vtlib_listview.trigger('cell.onmouseover', $(this))">
											<?=$flGrabacionLlamadaAgente['vfirstname_agent'].", ".$flGrabacionLlamadaAgente['vlastname_agent'];  ?>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>
										<td onmouseout="vtlib_listview.trigger('cell.onmouseout', $(this))" onmouseover="vtlib_listview.trigger('cell.onmouseover', $(this))">
											<?=$flGrabacionLlamadaAgente['vnombre_queue'];  ?>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>

										<td onmouseout="vtlib_listview.trigger('cell.onmouseout', $(this))" onmouseover="vtlib_listview.trigger('cell.onmouseover', $(this))">
											<?=$flGrabacionLlamadaAgente['vuser_eventlog'];  ?>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>

										<td onmouseout="vtlib_listview.trigger('cell.onmouseout', $(this))" onmouseover="vtlib_listview.trigger('cell.onmouseover', $(this))">
											<?=$flGrabacionLlamadaAgente['ddate_eventlog'];  ?>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>

										<td onmouseout="vtlib_listview.trigger('cell.onmouseout', $(this))" onmouseover="vtlib_listview.trigger('cell.onmouseover', $(this))">
											<?=$flGrabacionLlamadaAgente['dtime_eventlog'];  ?>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>

										<td onmouseout="vtlib_listview.trigger('cell.onmouseout', $(this))" onmouseover="vtlib_listview.trigger('cell.onmouseover', $(this))">
											<?=$flGrabacionLlamadaAgente['duraciontotal'];  ?>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>
										<td onmouseout="vtlib_listview.trigger('cell.onmouseout', $(this))" onmouseover="vtlib_listview.trigger('cell.onmouseover', $(this))">
											<?Php echo $flGrabacionLlamadaAgente['duracion'];  ?>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>
										<td onmouseout="vtlib_listview.trigger('cell.onmouseout', $(this))" onmouseover="vtlib_listview.trigger('cell.onmouseover', $(this))">
											<?Php 
												if($flGrabacionLlamadaAgente['vcallsense_eventlog'] == "in"){
														echo "Input";
												}else if($flGrabacionLlamadaAgente['vcallsense_eventlog'] == "out"){
														echo "Output";
												}	
											 ?>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>
										<td onmouseout="vtlib_listview.trigger('cell.onmouseout', $(this))" onmouseover="vtlib_listview.trigger('cell.onmouseover', $(this))">
											<?Php echo $flGrabacionLlamadaAgente['vstatus_eventlog'];  ?>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>

										<td onmouseout="vtlib_listview.trigger('cell.onmouseout', $(this))" onmouseover="vtlib_listview.trigger('cell.onmouseover', $(this))">
											<?Php 
											$file = $flGrabacionLlamadaAgente['vfilename_eventlog'];
											echo substr($file,strrpos($file,'/'), strlen($file) -  strrpos($file,'/') );  ?>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>										
										
										</td>										
										<td onmouseout="vtlib_listview.trigger('cell.onmouseout', $(this))" onmouseover="vtlib_listview.trigger('cell.onmouseover', $(this))">										
											<a href="<?Php echo $flGrabacionLlamadaAgente['vfilename_eventlog']; ?>" target="_blank">
											<img src="themes/images/arrow_down.png" width='13px'></a>
											|
											<a href="javascript:popup('apps/reportes/form/reproduction.php?rutaaudio=<?Php echo $flGrabacionLlamadaAgente['vfilename_eventlog']; ?>',320,200)"><img src="themes/images/small_right.gif" width='13px'></a>
																							
										</td>										
									</tr>
									<?Php $x++; } ?>		
									<input id='totalgrab' name='totalgrab' type='hidden' value='<?Php echo $x; ?>'>
									

									

								</tbody>
							</table>

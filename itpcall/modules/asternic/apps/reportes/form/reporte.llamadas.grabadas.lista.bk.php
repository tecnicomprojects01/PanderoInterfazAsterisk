<?Php include_once('../datos/reporte.llamadas.grabadas.lista.php') ?>

<a href="javascript:popup('apps/reportes/form/reproduction.php?rutaaudio=audio.gsm',320,200)">Reproduccion</a>
<a href="apps/reportes/form/audio.gsm" target="_blank">Descarga</a>
<table class="lvt small" width="100%" cellspacing="1" cellpadding="3" border="0">
							<tbody>
								<tr>
									<td class="lvtCol">
										<input id="selectCurrentPageRec" type="checkbox" onclick="toggleSelect_ListView(this.checked,"selected_id")" name="selectall">
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

									<?Php while($flGrabacionLlamadaAgente=mysql_fetch_array($rsGrabacionLlamadaAgente)){ ?>

									<tr id="row_2" class="lvtColData" bgcolor="white" onmouseout="this.className='lvtColData'" onmouseover="this.className='lvtColDataHover'">
										<td width="2%">
											<!--<input id="2" type="checkbox" onclick="check_object(this)" value="2" name="selected_id">-->
											<a href="#"><img align="absmiddle" border="0" src="themes/images/Rolesadd.gif"></a>
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
											$file = $flGrabacionLlamadaAgente['vfilename_eventlog'];
											echo substr($file,strrpos($file,'/'), strlen($file) -  strrpos($file,'/') );  ?>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>										
										
										</td>										
										<td onmouseout="vtlib_listview.trigger('cell.onmouseout', $(this))" onmouseover="vtlib_listview.trigger('cell.onmouseover', $(this))">
											<img src="themes/images/arrow_down.png" width='13px'>
											|
											<img src="themes/images/small_right.gif" width='13px'>
																						
										</td>										
									</tr>
									<?Php } ?>		
									

									

								</tbody>
							</table>
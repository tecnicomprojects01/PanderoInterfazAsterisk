<div id='recarga' name='recarga'></div>
<!--<?Php include_once('datos.llamadas.grabadas.lista.php') ?>-->
<table class="lvt small" width="80%" cellspacing="1" cellpadding="3" border="0">
							<tbody>
									<tr>
									<td class="lvtCol" width='10%'>
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lead_no&start=&sorder=ASC");" href="javascript:;">Numero</a>
									</td>
									<td class="lvtCol" width='10%'>
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">Agente</a>
									</td>
									<td class="lvtCol" width='10%'>
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">Fecha</a>
									</td>
									<td class="lvtCol" width='10%'>
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">Hora</a>
									</td>
									<td class="lvtCol" width='10%'>
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">Duration</a>
									</td>
									<td class="lvtCol" width='10%'>
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">Estado</a>
									</td>
									<td class="lvtCol" width='10%'>
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">Origen</a>
									</td>
									<td class="lvtCol" width='20%'>
										<a class="listFormHeaderLinks" onclick="getListViewEntries_js("Leads","parenttab=Marketing&foldername=Default&order_by=lastname&start=&sorder=ASC");" href="javascript:;">Archivo</a>
									</td>
									<td class="lvtCol" width='5%'>Tipo</td>
                                    <td class="lvtCol" width='5%'>Acción</td>
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
									while($flGrabacionLlamadaAgente=mysql_fetch_array($rsGrabacionLlamadaAgente)){ 
																
										
										$directorio = ($flGrabacionLlamadaAgente['recorddate'] == date("Y-m-d") ? "monitor1" : "monitor");
										/*$subdirectorio = ($flGrabacionLlamadaAgente['recordsource'] == "IN" ? "IN" : "OUT");*/
										$path = "../".$directorio."/".$subdirectorio."/".$flGrabacionLlamadaAgente['recordfile'];
										$path2 = "/var/www/html/".$directorio."/".$subdirectorio."/".$flGrabacionLlamadaAgente['recordfile'];

										

									?>	
									<tr id="row_2" class="lvtColData" bgcolor="white" onmouseout="this.className='lvtColData'" onmouseover="this.className='lvtColDataHover'">
										<td>
											<?=$flGrabacionLlamadaAgente['origen'];  ?>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>
										<td>
											<a title="Leads" href="#"><?=$flGrabacionLlamadaAgente['destino'];  ?></a>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>

										<td>
											<?=$flGrabacionLlamadaAgente['recorddate'];  ?>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>

										<td>
											<a title="Leads" href="#"><?=$flGrabacionLlamadaAgente['recordtime'];  ?></a>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>

										<td>
											<?=timeformat($flGrabacionLlamadaAgente['billsec']);  ?>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>

										<td>
											<a title="Leads" href="#"><?=$flGrabacionLlamadaAgente['event'];  ?></a>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>

										<td>
											<a title="Leads" href="#"><?=$flGrabacionLlamadaAgente['queue'];  ?></a>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>



										<td>											
											<a title="Leads" href="#"><?Php 
											$file = $path;
											echo $flGrabacionLlamadaAgente['recordfile'];  ?></a>
											<span style="display:none;" vtmodule="Leads" vtfieldname="lead_no" vtrecordid="2" type="vtlib_metainfo"></span>
										</td>										
										<td>	
                                        <? if($flGrabacionLlamadaAgente['tipo']=='i'){$tipo="IN";}else {$tipo="OUT";}
                                        		?>							
											<?=$tipo ?>
																							
										</td>	
										</td>										
										<td>										
											<a href="#"  onclick="descarga_audio('<?Php echo $flGrabacionLlamadaAgente['recordfile']; ?>','<?Php echo $flGrabacionLlamadaAgente['recorddate']; ?>','<?Php echo $pais; ?>','<?Php echo $flGrabacionLlamadaAgente['recordsource']; ?>');">
											<img src="themes/images/arrow_down.png" width='13px'></a>
											
																							
										</td>										
									</tr>
									<?Php $x++; } ?>		
									<input id='totalgrab' name='totalgrab' type='hidden' value='<?Php echo $x; ?>'>
									

									

								</tbody>
							</table>




<a href="downloadExcel.php?sql=<?Php echo $sExcel;?>" target='_parent' ><input class="crmbutton small delete" type="button"   value="DownloadNew"></a>

<?Php

echo "<table width='500'><center><br>";
if(($num_pag - 1) > 0)
{
echo "<a href='grabacion.php?pagina=".($num_pag-1)."&where=".$sWhere."'>< Anterior</a>";
}

for ($i=1; $i<=$total_paginas; $i++)
{
if ($num_pag == $i)
{
echo "<b><p class='style1'>Pag.".$num_pag."</b> ";
}
else
{
echo "<a href='grabacion.php?pagina=".$i."&where=".$sWhere."'>$i</a>";
}
}

if(($num_pag + 1)<=$total_paginas)
{
echo "<a href='grabacion.php?pagina=".($num_pag+1)."&where=".$sWhere."'>Siguiente ></a>";
}
echo "</center></table>";

?>

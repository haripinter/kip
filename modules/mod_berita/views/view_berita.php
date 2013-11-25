<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function Bottons($id){
	return '<div class="btn-group dropup">
		<button type="button" class="btn dropdown-toggle span12" data-toggle="dropdown">
		Menu&nbsp;<span class="caret"></span>
		</button>
		<ul class="dropdown-menu pull-right">
			<li>
				<a class="bt bt-edit-data" name="'.$id.'"><span class="icon-edit"></span> Edit</a>
			</li>
			<li>
				<a class="bt bt-delete-data" name="'.$id.'"><span class="icon-remove"></span> Delete</a>
			</li>
		</ul>
	</div>';
}

$popup_action = site_url().'shot-berita';
$action = site_url().'admin/berita/input/';
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> BERITA / INFORMASI</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<table class="table table-bordered table bootstrap-datatable datatable">
				<thead>
					<tr>                                   
						<th width="1px">No</th>                                     
						<th>Judul</th>                                     
						<th width="145px">Masa Aktif</th>                                     
						<th width="50px">Text Berjalan*</th>
						<th width="70px">&nbsp;</th>
					</tr>
				</thead>   
				<tbody>
				<?php
				$n = 1;
				foreach($berita as $brt){
					$id = $brt['post_id'];
					$title = $brt['post_title'];
					$start = datetime_tgl($brt['post_start']);
					$stop = datetime_tgl($brt['post_stop']);
					$aktif = $start;
					if($stop!='') $aktif .= ' - '.$stop;
					$marq = $brt['post_marquee'];
					?>
					<tr>
						<td><center><?php echo $n; ?></center><span class="rowstbl<?php echo $id; ?>"></span></td>         
						<td><?php echo $title; ?></td>         
						<td><?php echo $aktif; ?></td>         
						<td><?php echo $marq; ?></td>         
						<td><?php echo Bottons($id); ?></td> 
					</tr>       
					<?php
					$n++;
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<input type="hidden" class="Bottons" value="<?php echo htmlspecialchars(Bottons(0));?>">
<script>
$(document).ready(function(){

	action_edit($('.datatable .bt-edit-data'));
	action_delete($('.datatable .bt-delete-data'));
	
	function action_edit(dom){
		dom.click(function(){
			var btn = $(this);
			var id = btn.attr('name');
			window.location='<?php echo $action; ?>'+id;
		});
	}
	
	function action_delete(dom){
		dom.click(function(){
			var btn = $(this);
			var tbl = btn.parents('.datatable');
			var tr  = btn.parents('.datatable tbody tr');
			var box = tbl.parent();
			
			// edit this
			var urls = '<?php echo $popup_action; ?>';
			var tipe = box.parent().attr('id');
			
			var data = {action:'delete',id:this.name};
			bootbox.confirm("Anda yakin akan menghapus Berita ini?", function(result) {
				if(result==true){
					var post = $.post(urls,data);
					post.done(function(data){
						data = $.parseJSON(data);
						if(data['status']=='success'){
							tbl = tbl.dataTable();
							tbl.fnDeleteRow(tbl.fnGetPosition(tr[0]));
							sort_tabel(tbl);
						}
					});
				}
			});
		});
	}
	
	$('.datatable').dataTable({
		"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid bawah-datatabel'<'span8'i><'span4 bt-datatable-add'><'span12 center'p><'modalZ'>>",
		"sPaginationType": "bootstrap",
		"aoColumnDefs": [ { "sType": "numeric", "aTargets": [ 0 ] } ],
		"oLanguage": {
			"sLengthMenu": "_MENU_ Tampilan Perhalaman"
		}
	});
	
	$("div.bt-datatable-add").html('<a class="btn btn-info pull-right bt-add-data" name="0"><span class="icon-plus icon-white"></span> Tambah Data</a>');
	
	$('.bt-datatable-add .bt-add-data').click(function(){
		var btn = $(this);
		window.location='<?php echo $action; ?>0';
	});
	
	function sort_tabel(tbl){
		var trs = tbl.fnGetNodes();
		var num = 1;
		$(trs).each(function(){
			var tds = $(this).find('td');
			var spa = $(tds[0]).children('span');
			var cen = $(tds[0]).children('center');
			cen.html(num);
			
			var isi = $('<div>').append(cen).append(spa);
			tbl.fnUpdate(isi.html(),tbl.fnGetPosition(this),0);
			isi.remove();
			num++;
		});
	}
	
	function sort_tabel_biasa(tbody){
		var trs = $(tbody).children('tr');
		var nnn = 1;
		$(trs).each(function(){
			var tds = $(this).children('td');
			$(tds[0]).children('center').html(nnn);
			nnn++;
		});
	}
});
</script>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<?php
include_once('root_local_function.php');
$_app = $site_url.'/index.php/root/';
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> Foto</h2>
			<div class="custom_loader1"></div>
		</div>
		<div class="box-content">
			<div>
				<a class="btn bt-tambah">TAMBAH</a> 
			</div>
			<br/>
			<div id="thiscontent">
				<table class="table table-bordered" id="tgroup_user">
					<thead>
						<tr>
							<th>&nbsp;</th>                                      
							<th>Judul</th>                                      
							<th>External Link</th>                                      
							<th>Jenis</th>                                      
							<th width="150px">Actions</th>                                      
						</tr>
					</thead>   
					<tbody id="bimg" class="ccontent">
						<?php
						$content = array();
						//$content = get_data("SELECT fi_id,fi_judul,fi_filename,fi_url,fi_jenis FROM fixed_image ORDER BY fi_id,fi_jenis");
						$n = 1;
						foreach($content as $content){
						?>
						<tr class="trcg">
							<td><div class="center"><img height="50px" src="img/foto/<?php //echo// $content['fi_filename']; ?>"></img></div>
								<input type="hidden" class="imgid" name="imgid" id="imgid" value="<?php //echo $content['fi_id']; ?>">
							</td>
							<td><?php //echo $content['fi_judul']; ?></td>         
							<td><?php// echo $content['fi_url']; ?></td>         
							<td><?php// echo $content['fi_jenis']; ?></td>         
							<td>
								<a class="btn btn-info editThisRow" name="<?php //echo $content['fi_id']; ?>" title="Edit">
									<i class="icon-edit icon-white"></i>          
								</a>
								<a class="btn btn-danger delThisRow" name="<?php //echo $content['fi_id']; ?>" title="Delete">
									<i class="icon-trash icon-white"></i>
								</a>
							</td>         
						</tr>       
						<?php
						}
						?>
					</tbody>
				</table> 
				<div class="pagination pagination-centered"><ul class="cpage_navigation"></ul></div>
			</div>
		</div>
	</div><!--/span-->

</div><!--/row-->
<script>
	$('.bt-tambah').click(function(){
		location.href='<?php echo $_app; ?>gambar/0/input';
	});
	$('.bt-edit').click(function(){
		var post_id = this.name;
		bootbox.confirm("Anda yakin akan mengedit konten ini?", function(result) {
			if(result==true){
				location.href='<?php echo $_app; ?>gambar/'+post_id+'/input';
			}
		});
	});
	$('.bt-remove').click(function(){
		var post_id = this.name;
		bootbox.confirm("Anda yakin akan menghapus konten ini?", function(result) {
			if(result==true){
				location.href='<?php echo $_app; ?>gambar/'+post_id+'/delete';
			}
		});
	});
</script>
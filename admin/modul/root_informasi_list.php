<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('root_local_function.php');
$_app = $site_url.'/index.php/root/';
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> BERITA / INFORMASI</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<div>
				<a class="btn bt-tambah">TAMBAH</a>
			</div>
			<br/>
			<div id="informasi-berita">
				<table class="table table-bordered table bootstrap-datatable datatable" id="tslideshow">
					<thead>
						<tr>                                   
							<th>No</th>                                     
							<th>Judul</th>                                     
							<th>Tanggal Posting</th>                                      
							<th>Tanggal Kadaluarsa</th>                                      
							<th>Text Berjalan*</th>                              
							<!--th>Aktif</th-->
							<th width="72px">&nbsp;</th>                                      
						</tr>
					</thead>   
					<tbody id="bslideshow">
						<?php
						$n = 1;
						if(count($berita)>0){
							foreach($berita as $berita){
							?>
							<tr class="trcg">
								<td><?php echo $n++; ?></td>         
								<td><?php echo $berita['post_title']; ?></td>         
								<td><?php echo datetime_tgl($berita['post_created']); ?></td>         
								<td><?php echo datetime_tgl($berita['post_expired']); ?></td>         
								<td><?php echo $berita['post_marquee']; ?></td>         
								<td>
									<a class="btn btn-info bt-edit" name="<?php echo $berita['post_id']; ?>" title="Edit">
										<i class="icon-edit icon-white"></i>          
									</a>
									<a class="btn btn-danger bt-remove" name="<?php echo $berita['post_id']; ?>" title="Delete">
										<i class="icon-trash icon-white"></i>
									</a>
								</td>         
							</tr>       
							<?php
							}
						}
						?>
					</tbody>
				</table> 
			</div>
		</div>
	</div>
</div>
<script>
	$('.bt-tambah').click(function(){
		location.href='<?php echo $_app; ?>informasi/0/input';
	});
	$('.bt-edit').click(function(){
		var post_id = this.name;
		bootbox.confirm("Anda yakin akan mengedit konten ini?", function(result) {
			if(result==true){
				location.href='<?php echo $_app; ?>informasi/'+post_id+'/input';
			}
		});
	});
	$('.bt-remove').click(function(){
		var post_id = this.name;
		bootbox.confirm("Anda yakin akan menghapus konten ini?", function(result) {
			if(result==true){
				location.href='<?php echo $_app; ?>informasi/'+post_id+'/delete';
			}
		});
	});
</script>
<?php
	if(!empty($lab_articles)){
?>
<table class="table text-center">
	<thead class="bg-light">
		<tr>
			<th>Title</th>
			<th>Images</th>
			<th>Document</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($lab_articles as $key=>$value){
		?>
		<tr>
			<td style="width: 30%;"><p><?php echo $value['title'];?></p></td>
			<td style="width: 40%;">
				<div class="row">
				<?php
					$images = json_decode($value['images']);
					foreach ($images as $k => $v) {
				?>
					<div class="col-lg-6 col-md-6 col-sm-6 margin-bottom-10 text-center">
						<a href="<?php echo base_url();?>includes/images/labarticles/images/<?php echo $v;?>" target="_blank">
							<img src="<?php echo base_url();?>includes/images/labarticles/images/<?php echo $v;?>" style="height: 100px; width: 150px;">
						</a>
					</div>
				<?php
					}
				?>
				</div>
			</td>
			<td style="width: 10%;">
				<a href="<?php echo base_url();?>includes/images/labarticles/documents/<?php echo $value['document'];?>" target="_blank">
					Document
				</a>
			</td>
			<td class="text-center" style="width: 20%;">
				<?php
					if($value['status'] == "0"){
			 	?>
					<a class="btn btn-info btn-sm aticle-edit" id="<?php echo "article_edit_".$value['id'];?>" href="<?php echo base_url();?>csirlabs/editarticleform/<?php echo $value['id'];?>" target="_blank">
						Edit
					</a>
				<?php 
					}else{
				?>
					<?php 
						if(trim($value['article_link']) != ''){
					?>
					<a class="btn btn-success btn-sm" href="<?php echo $value['article_link'];?>" target="_blank">
						View Article
					</a>
					<?php
						}
					?>

					<?php 
						if(trim($value['decline_text']) != ''){
					?>
					<a class="btn btn-info btn-sm" href="<?php echo base_url()."csirlabs/feedbacktext/".$value['id'];?>" target="_blank">
						View Feedback
					</a>
					<?php
						}
					?>
				<?php 
					}
				?>
			</td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>
<?php
	}else{
?>
	<table class="table text-center">
		<thead class="bg-light">
			<tr class="border-0">
				<th class="border-0 text-center" colspan="6">No Data</th>
			</tr>
		</thead>
	</table>
<?php
	}
?>
<?php 
	if(isset($lab_articles_pagination)){
		echo $lab_articles_pagination;
	}else{
		echo $this->ajax_pagination->create_links();
	}
?>
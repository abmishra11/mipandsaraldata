<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content margin-bottom-10">
			<div class="row">
				<div class="col-md-12">
					<div class="text-center admin-title-background">
						<h4>Headquarter's Posts</h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 margin-bottom-10">
					<div class="text-right">
						<a type="button" class="btn btn-info btn-sm" href="<?php echo base_url()?>admin/addheadquarterpost">Add Post Detail</a>
					</div>
				</div>
				<div class="col-md-12">
					<?php
						if(!empty($headquarterposts)){
					?>
					<table class="table">
						<thead style="background-color: #337ab7; color: #fff;">
							<tr>
								<th>Designation</th>
								<th>Pay Level</th>
								<th>Category</th>
								<th>Sub Category</th>
								<th>Gender</th>
								<th>No of Posts</th>
								<th>Entry Date</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach($headquarterposts as $key=>$value){
									$category = $this->login_model->get_table_data('categories', $where = array('category_key'=>$value['category']), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '1');
									$subcategory = $this->login_model->get_table_data('subcategories', $where = array('category_key'=>$value['subcategory']), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '1');
									$gender = $this->login_model->get_table_data('genders', $where = array('id'=>$value['gender']), $group_by = '', $order_by_field = '', $order_by_sort = '', $limit = '1');
							?>
							<tr>
								<td><?php echo $value['designation'];?></td>
								<td><?php echo $value['paylevel'];?></td>
								<td><?php echo $category[0]['name'];?></td>
								<td>
									<?php 
										if($value['subcategory'] == 'other'){
											echo "Other";
										}else{
											echo $subcategory[0]['name'];
										}
									?>
								</td>
								<td><?php echo $gender[0]['name'];?></td>
								<td><?php echo $value['posts'];?></td>
								<td><?php echo $value['added_date'];?></td>
								<td class="text-right">
									<a href="<?php echo base_url()?>admin/editheadquarterpost/<?php echo $value['id'];?>" class="btn btn-info headquarterposts-edit btn-sm" id="<?php echo "headquarterposts_edit_".$value['id'];?>">
										Edit
									</a> 
									<button class="btn btn-danger headquarterposts-delete btn-sm" id="<?php echo "headquarterposts_delete_".$value['id'];?>">
										Delete
									</button> 
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
								<th class="border-0 text-center" colspan="7">No Data</th>
							</tr>
						</thead>
					</table>
					<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
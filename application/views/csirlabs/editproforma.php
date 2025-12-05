
<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;">
			<form method="post" id="<?php echo $method_prefix;?>-add-data-form" style="padding: 5% 5%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
				<div class="form-group row">
					<div class="col-md-12">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<div id="<?php echo $method_prefix;?>-add-data-error" class="margin-bottom-10 text-center text-danger"></div>
						<div id="<?php echo $method_prefix;?>-add-data-success" class="margin-bottom-10 text-center"></div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12 text-center">
						<h5 class="margin-bottom-10">ANNUAL REPORTING FORMAT ON SELECTION COMMITTEES/BOARDS CONSTITUTED AND PERSONS RECRUITED</h5>
						<h5 class="margin-bottom-10">PROGRESS REPORT FOR IMPLEMENTATION OF PRIME MINISTER’S NEW 15 POINT PROGRAMME FOR THE WELFARE OF MINORITIES</h5>
						<h5 class="margin-bottom-10">MINISTRY/DEPARTMENT: COUNCIL OF SCIENTIFIC & INDUSTRIAL RESEARCH, 2 RAFI MARG, NEW DELHI-01 (AN AUTONOMOUS BODY UNDER DEPTT. OF SCIENTIFIC & INDUSTRIAL RESEARCH)</h5>
					</div>	
				</div>
				<div class="form-group row">
					<div class="col-md-2 text-right">
						<label>Financial Year</label>
					</div>	
					<div class="col-md-5">
						<input type="text" class="form-control" name="start_date" id="start_date" value="<?php echo date('d-m-Y', strtotime($proforma[0]['start_date']));?>" readonly>
					</div>	
					<div class="col-md-4">
						<input type="text" class="form-control" name="end_date" id="end_date" value="<?php echo date('d-m-Y', strtotime($proforma[0]['end_date']));?>" readonly>
					</div>	
					<div class="col-md-1"></div>
				</div>
				<div class="form-group row">
					<div class="col-md-2">
						<input type="hidden" class="form-control" name="csirlabs_id" placeholder="" value="<?php echo $_SESSION['csirlabs_id'];?>">
						<input type="hidden" class="form-control" name="proforma_id" placeholder="" value="<?php echo $proforma[0]['id'];?>">
					</div>	
					<div class="col-md-3 text-center">
						<label>* Total Number of employees as on <?php echo date('d-m-Y', strtotime($proforma[0]['end_date']));;?></label>
					</div>	
					<div class="col-md-3 text-center">
						<label>* Total number of persons employed during the year</label>
					</div>	
					<div class="col-md-3 text-center">
						<label>* Minority persons employed during the year</label>
					</div>	
					<div class="col-md-1"></div>
				</div>
				<div class="form-group row">
					<div class="col-md-2 text-right">
						<label>Group-A</label>
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_employees_group_a" id="total_employees_group_a" value="<?php echo $proforma[0]['total_employees_group_a'];?>" onchange="calculate_total_employees();">
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_employed_group_a" id="total_employed_group_a" value="<?php echo $proforma[0]['total_employed_group_a'];?>" onchange="calculate_total_employed();">
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_minority_employed_group_a" id="total_minority_employed_group_a" value="<?php echo $proforma[0]['total_minority_employed_group_a'];?>" onchange="calculate_total_minority_employed();">
					</div>	
					<div class="col-md-1"></div>
				</div>
				<div class="form-group row">
					<div class="col-md-2 text-right">
						<label>Group-B</label>
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_employees_group_b" id="total_employees_group_b" value="<?php echo $proforma[0]['total_employees_group_b'];?>" onchange="calculate_total_employees();">
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_employed_group_b" id="total_employed_group_b" value="<?php echo $proforma[0]['total_employed_group_b'];?>" onchange="calculate_total_employed();">
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_minority_employed_group_b" id="total_minority_employed_group_b" value="<?php echo $proforma[0]['total_minority_employed_group_b'];?>" onchange="calculate_total_minority_employed();">
					</div>	
					<div class="col-md-1"></div>
				</div>
				<div class="form-group row">
					<div class="col-md-2 text-right">
						<label>Group-C</label>
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_employees_group_c" id="total_employees_group_c" value="<?php echo $proforma[0]['total_employees_group_c'];?>" onchange="calculate_total_employees();">
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_employed_group_c" id="total_employed_group_c" value="<?php echo $proforma[0]['total_employed_group_c'];?>" onchange="calculate_total_employed();">
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_minority_employed_group_c" id="total_minority_employed_group_c" value="<?php echo $proforma[0]['total_minority_employed_group_c'];?>" onchange="calculate_total_minority_employed();">
					</div>	
					<div class="col-md-1"></div>
				</div>
				<div class="form-group row">
					<div class="col-md-2 text-right">
						<label>Group-D</label>
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_employees_group_d" id="total_employees_group_d" value="<?php echo $proforma[0]['total_employees_group_d'];?>" onchange="calculate_total_employees();">
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_employed_group_d" id="total_employed_group_d" value="<?php echo $proforma[0]['total_employed_group_d'];?>" onchange="calculate_total_employed();">
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_minority_employed_group_d" id="total_minority_employed_group_d" value="<?php echo $proforma[0]['total_minority_employed_group_d'];?>" onchange="calculate_total_minority_employed();">
					</div>	
					<div class="col-md-1"></div>
				</div>
				<div class="form-group row">
					<div class="col-md-2 text-right">
						<label>Total</label>
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_employees" id="total_employees" value="<?php echo $proforma[0]['total_employees'];?>" readonly>
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_employed" id="total_employed" value="<?php echo $proforma[0]['total_employed'];?>" readonly>
					</div>	
					<div class="col-md-3">
						<input type="number" class="form-control" name="total_minority_employed" id="total_minority_employed" value="<?php echo $proforma[0]['total_minority_employed'];?>" readonly>
					</div>	
					<div class="col-md-1"></div>
				</div>
				<div class="form-group row">
					<div class="col-md-2">
						Enter remarks if any (Optional)
					</div>
					<div class="col-md-9">
						<textarea name="remarks" class="form-control"><?php echo $proforma[0]['remarks'];?></textarea>
					</div>
					<div class="col-md-1"></div>
				</div>
				<div class="form-group row">
					<div class="col-md-2">
					</div>
					<div class="col-md-9">
						<input type="submit" name="insert" value="Submit" class="form-control btn btn-info"/>
					</div>
					<div class="col-md-1"></div>
				</div>
			</form>
		</div>
	</div>
</div>
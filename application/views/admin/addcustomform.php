<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;">
			<form method="post" id="<?php echo $method_prefix;?>-add-data-form" style="padding: 5% 30%;background-color: #337ab7; color: #fff;min-height: 97%;"> 
				<div class="form-group row">
					<div class="col-md-12 margin-bottom-10">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<label class="margin-bottom-10">Enter form title</label>
						<input type="text" class="form-control" name="title" value="">
					</div>		
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">Enter form description</label>
						<textarea name="description" class="form-control"></textarea>
					</div>	
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">Form entry start date (Start date should be from tomorrow onwards)</label>
						<input type="text" class="form-control" name="customform-entry-start-date" id="customform-entry-start-date" value="">
					</div>	
					<div class="col-md-12 margin-bottom-10">
						<label class="margin-bottom-10">Form entry end date (End date should be from tomorrow onwards)</label>
						<input type="text" class="form-control" name="customform-entry-end-date" id="customform-entry-end-date" value="">
					</div>	
					<div class="col-md-12">
						<hr style="border-top: 1px solid #fff;">
					</div>
				</div>
				<div class="form-group" id="form-fields-section">
					<div class="row">
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">Enter field label</label>
							<input type="text" class="form-control" name="fieldlabel[]" value="">
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">Select field Type</label>
							<select name="fieldtype[]" class="form-control fieldtype" onchange="selectfieldtype(this);">
								<option value="Text">Text</option>
								<option value="Number">Number</option>
								<option value="Date">Date</option>
								<option value="Text Area">Text Area</option>
								<option value="Dropdown">Dropdown</option>
								<option value="Radio Button">Radio Button</option>
								<option value="Checkbox">Checkbox</option>
							</select>
						</div>
						<div class="col-md-12 margin-bottom-10 optionsdiv" style="display: none;">
							<ol class="margin-bottom-10 options-list" style="list-style-type: decimal; margin-left: 20px;">
								<li class="margin-bottom-10">
									<input type="text" class="form-control" placeholder="Enter option value" name="options[0][]" style="width: 70%;display: inline-block;"> 
								</li>
								<li class="margin-bottom-10">
									<input type="text" class="form-control" placeholder="Enter option value" name="options[0][]" style="width: 70%;display: inline-block;"> 
								</li>
							</ol>
							<span class="btn btn-sm btn-success" style="margin-left: 20px;" onclick="addoptions(this);">Add Option</span>
						</div>
						<div class="col-md-12 margin-bottom-10 minmaxdiv">
							<label class="margin-bottom-10">Enter minimum length (Optional)</label>
							<input type="number" class="form-control margin-bottom-10" name="minlength[]">
							<label class="margin-bottom-10">Enter max length (Optional)</label>
							<input type="number" class="form-control" name="maxlength[]">
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">is field required ?</label>
							<select name="required[]" class="form-control">
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
						</div>
						<div class="col-md-12 margin-bottom-10">
							<label class="margin-bottom-10">Select field width</label>
							<select name="fieldwidth[]" class="form-control">
								<option value="12">Full</option>
								<option value="6">Half</option>
								<option value="4">One Third</option>
								<option value="3">One Fourth</option>
							</select>
						</div>
						<div class="col-md-12">
							<hr style="border-top: 1px solid #fff;">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 text-right"><button id="add-new-form-field" class="btn btn-sm btn-success">Add New Field</button></div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<input type="submit" name="insert" value="Submit" class="form-control btn btn-info"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content" style="min-height: 90vh;padding: 5% 1%;background-color: #337ab7; color: #fff;">
			<form method="post" id="<?php echo $method_prefix;?>-add-data-form" style=""> 
				<div class="form-group row">
					<div class="col-md-12 text-center">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<input type="hidden" name="participant_id" value="<?php echo $participant['id'];?>">
						<hr style="border-top: 1px solid #fff;">
						<h4>
							<?php 
								echo $_SESSION['csirlabs_name'];
							?>
						</h4>
						<hr style="border-top: 1px solid #fff;">
						<h4>Edit Participant Details</h4>
						<hr style="border-top: 1px solid #fff;">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-1 margin-bottom-10" style="padding: 10px;">
						* Name: 
					</div>
					<div class="col-md-5 margin-bottom-10">
						<input type="text" name="name" class="form-control" value="<?php echo $participant['name'];?>">
					</div>
					<div class="col-md-1 margin-bottom-10" style="padding: 10px;">
						* Designation:
					</div>
					<div class="col-md-5 margin-bottom-10">
						<input type="text" name="designation" class="form-control" value="<?php echo $participant['designation'];?>">
					</div>
					<div class="col-md-1 margin-bottom-10" style="padding: 10px;">
						* Email:
					</div>
					<div class="col-md-5 margin-bottom-10">
						<input type="text" name="email" class="form-control" value="<?php echo $participant['email'];?>">
					</div>
					<div class="col-md-1 margin-bottom-10" style="padding: 10px;">
						* Mobile No:
					</div>
					<div class="col-md-5 margin-bottom-10">
						<input type="text" name="mobile" class="form-control" value="<?php echo $participant['mobile'];?>">
					</div>
					<div class="col-md-1 margin-bottom-10" style="padding: 10px;">
						* Arrival Date:
					</div>
					<div class="col-md-1 margin-bottom-10">
						<input type="text" name="date_of_arrival" id="date-of-arrival" class="form-control" value="<?php echo date('d-m-Y', strtotime($participant['date_of_arrival']));?>">
					</div>
					<div class="col-md-1 margin-bottom-10" style="padding: 10px;">
						* Arrival Time:
					</div>
					<?php 
						$arrival_times = explode(' ', $participant['time_of_arrival']);
						$arrival_hours = explode(':', $arrival_times[0]);
						$time_of_arrival_hour = $arrival_hours[0];
						$time_of_arrival_minute = $arrival_hours[1];
						$time_of_arrival_postfix = $arrival_times[1];
					?>
					<div class="col-md-1 margin-bottom-10">
						<select class="form-control" name="time_of_arrival_hour">
							<option value="">Hour</option>
							<option value="00" <?php if($time_of_arrival_hour == '00'){ ?> selected <?php } ?> >00</option>
							<option value="01" <?php if($time_of_arrival_hour == '01'){ ?> selected <?php } ?> >01</option>
							<option value="02" <?php if($time_of_arrival_hour == '02'){ ?> selected <?php } ?> >02</option>
							<option value="03" <?php if($time_of_arrival_hour == '03'){ ?> selected <?php } ?> >03</option>
							<option value="04" <?php if($time_of_arrival_hour == '04'){ ?> selected <?php } ?> >04</option>
							<option value="05" <?php if($time_of_arrival_hour == '05'){ ?> selected <?php } ?> >05</option>
							<option value="06" <?php if($time_of_arrival_hour == '06'){ ?> selected <?php } ?> >06</option>
							<option value="07" <?php if($time_of_arrival_hour == '07'){ ?> selected <?php } ?> >07</option>
							<option value="08" <?php if($time_of_arrival_hour == '08'){ ?> selected <?php } ?> >08</option>
							<option value="09" <?php if($time_of_arrival_hour == '09'){ ?> selected <?php } ?> >09</option>
							<option value="10" <?php if($time_of_arrival_hour == '10'){ ?> selected <?php } ?> >10</option>
							<option value="11" <?php if($time_of_arrival_hour == '11'){ ?> selected <?php } ?> >11</option>
							<option value="12" <?php if($time_of_arrival_hour == '12'){ ?> selected <?php } ?> >12</option>
						</select>
					</div>
					<div class="col-md-1 margin-bottom-10">
						<select class="form-control" name="time_of_arrival_minute">
							<option value="">Minute</option>
							<option value="00" <?php if($time_of_arrival_minute == '00'){ ?> selected <?php } ?> >00</option>
							<option value="05" <?php if($time_of_arrival_minute == '05'){ ?> selected <?php } ?> >05</option>
							<option value="10" <?php if($time_of_arrival_minute == '10'){ ?> selected <?php } ?> >10</option>
							<option value="15" <?php if($time_of_arrival_minute == '15'){ ?> selected <?php } ?> >15</option>
							<option value="20" <?php if($time_of_arrival_minute == '20'){ ?> selected <?php } ?> >20</option>
							<option value="25" <?php if($time_of_arrival_minute == '05'){ ?> selected <?php } ?> >25</option>
							<option value="30" <?php if($time_of_arrival_minute == '30'){ ?> selected <?php } ?> >30</option>
							<option value="35" <?php if($time_of_arrival_minute == '35'){ ?> selected <?php } ?> >35</option>
							<option value="40" <?php if($time_of_arrival_minute == '40'){ ?> selected <?php } ?> >40</option>
							<option value="45" <?php if($time_of_arrival_minute == '45'){ ?> selected <?php } ?> >45</option>
							<option value="50" <?php if($time_of_arrival_minute == '50'){ ?> selected <?php } ?> >50</option>
							<option value="55" <?php if($time_of_arrival_minute == '55'){ ?> selected <?php } ?> >55</option>
							<option value="60" <?php if($time_of_arrival_minute == '60'){ ?> selected <?php } ?> >60</option>
						</select>
					</div>
					<div class="col-md-1 margin-bottom-10">
						<select class="form-control" name="time_of_arrival_postfix">
							<option value="AM" <?php if($time_of_arrival_postfix == 'AM'){ ?> selected <?php } ?> >AM</option>
							<option value="PM" <?php if($time_of_arrival_postfix == 'PM'){ ?> selected <?php } ?> >PM</option>
						</select>
					</div>
					<div class="col-md-1 margin-bottom-10" style="padding: 10px;">
						* Arrival Place:
					</div>
					<div class="col-md-2 margin-bottom-10">
						<input type="text" name="place_of_arrival" class="form-control" value="<?php echo $participant['place_of_arrival'];?>">
					</div>
					<div class="col-md-1 margin-bottom-10" style="padding: 10px;">
						* Arrival Mode:
					</div>
					<div class="col-md-2 margin-bottom-10">
						<input type="text" name="mode_of_arrival" class="form-control" value="<?php echo $participant['mode_of_arrival'];?>">
					</div>
					<div class="col-md-1 margin-bottom-10" style="padding: 10px;">
						* Departure Date:
					</div>
					<div class="col-md-1 margin-bottom-10">
						<input type="text" name="date_of_departure" id="date-of-departure" class="form-control" value="<?php echo date('d-m-Y', strtotime($participant['date_of_departure']));?>">
					</div>
					<div class="col-md-1 margin-bottom-10" style="padding: 10px;">
						* Departure Time:
					</div>
					<?php
						$departure_times = explode(' ', $participant['time_of_departure']);
						$departure_hours = explode(':', $departure_times[0]);
						$time_of_departure_hour = $departure_hours[0];
						$time_of_departure_minute = $departure_hours[1];
						$time_of_departure_postfix = $departure_times[1];
					?>
					<div class="col-md-1 margin-bottom-10">
						<select class="form-control" name="time_of_departure_hour">
							<option value="">Hour</option>
							<option value="00" <?php if($time_of_departure_hour == '00'){ ?> selected <?php } ?> >00</option>
							<option value="01" <?php if($time_of_departure_hour == '01'){ ?> selected <?php } ?> >01</option>
							<option value="02" <?php if($time_of_departure_hour == '02'){ ?> selected <?php } ?> >02</option>
							<option value="03" <?php if($time_of_departure_hour == '03'){ ?> selected <?php } ?> >03</option>
							<option value="04" <?php if($time_of_departure_hour == '04'){ ?> selected <?php } ?> >04</option>
							<option value="05" <?php if($time_of_departure_hour == '05'){ ?> selected <?php } ?> >05</option>
							<option value="06" <?php if($time_of_departure_hour == '06'){ ?> selected <?php } ?> >06</option>
							<option value="07" <?php if($time_of_departure_hour == '07'){ ?> selected <?php } ?> >07</option>
							<option value="08" <?php if($time_of_departure_hour == '08'){ ?> selected <?php } ?> >08</option>
							<option value="09" <?php if($time_of_departure_hour == '09'){ ?> selected <?php } ?> >09</option>
							<option value="10" <?php if($time_of_departure_hour == '10'){ ?> selected <?php } ?> >10</option>
							<option value="11" <?php if($time_of_departure_hour == '11'){ ?> selected <?php } ?> >11</option>
							<option value="12" <?php if($time_of_departure_hour == '12'){ ?> selected <?php } ?> >12</option>
						</select>
					</div>
					<div class="col-md-1 margin-bottom-10">
						<select class="form-control" name="time_of_departure_minute">
							<option value="">Minute</option>
							<option value="00" <?php if($time_of_departure_minute == '00'){ ?> selected <?php } ?> >00</option>
							<option value="05" <?php if($time_of_departure_minute == '05'){ ?> selected <?php } ?> >05</option>
							<option value="10" <?php if($time_of_departure_minute == '10'){ ?> selected <?php } ?> >10</option>
							<option value="15" <?php if($time_of_departure_minute == '15'){ ?> selected <?php } ?> >15</option>
							<option value="20" <?php if($time_of_departure_minute == '20'){ ?> selected <?php } ?> >20</option>
							<option value="25" <?php if($time_of_departure_minute == '25'){ ?> selected <?php } ?> >25</option>
							<option value="30" <?php if($time_of_departure_minute == '30'){ ?> selected <?php } ?> >30</option>
							<option value="35" <?php if($time_of_departure_minute == '35'){ ?> selected <?php } ?> >35</option>
							<option value="40" <?php if($time_of_departure_minute == '40'){ ?> selected <?php } ?> >40</option>
							<option value="45" <?php if($time_of_departure_minute == '45'){ ?> selected <?php } ?> >45</option>
							<option value="50" <?php if($time_of_departure_minute == '50'){ ?> selected <?php } ?> >50</option>
							<option value="55" <?php if($time_of_departure_minute == '55'){ ?> selected <?php } ?> >55</option>
							<option value="60" <?php if($time_of_departure_minute == '60'){ ?> selected <?php } ?> >60</option>
						</select>
					</div>
					<div class="col-md-1 margin-bottom-10">
						<select class="form-control" name="time_of_departure_postfix">
							<option value="AM" <?php if($time_of_departure_postfix == 'AM'){ ?> selected <?php } ?> >AM</option>
							<option value="PM" <?php if($time_of_departure_postfix == 'PM'){ ?> selected <?php } ?> >PM</option>
						</select>
					</div>
					<div class="col-md-1 margin-bottom-10" style="padding: 10px;">
						* Departure Place:
					</div>
					<div class="col-md-2 margin-bottom-10">
						<input type="text" name="place_of_departure" class="form-control" value="<?php echo $participant['place_of_departure'];?>">
					</div>
					<div class="col-md-1 margin-bottom-10" style="padding: 10px;">
						* Departure Mode:
					</div>
					<div class="col-md-2 margin-bottom-10">
						<input type="text" name="mode_of_departure" class="form-control" value="<?php echo $participant['mode_of_departure'];?>">
					</div>
					<!--
					<div class="col-md-1 margin-bottom-10" style="padding: 10px;">
						* Vehicle Required:
					</div>
					<div class="col-md-2 margin-bottom-10">
						<select class="form-control" name="vehicle_required">
							<option value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
					</div>
					-->
				</div>
				<div class="form-group row">
					<div class="col-md-12 text-center">
						<hr style="border-top: 1px solid #fff;">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-md-5"></div>
					<div class="col-md-2">
						<input type="submit" name="insert" value="Submit" class="form-control btn btn-info"/>
					</div>
					<div class="col-md-5"></div>
				</div>
			</form>
		</div>
	</div>
</div>
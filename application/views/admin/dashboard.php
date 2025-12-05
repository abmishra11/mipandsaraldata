<div class="col-lg-10 col-md-10 col-sm-10">
	<div class="admin-dashboard">
		<div class="admin-dashboard-content margin-bottom-10">
			<div class="row">
			    <div class="col-md-12 margin-bottom-10">
			        <div class="accordion" id="labAccordion">
			            <?php if (!empty($csirlabs)): ?>
			                <?php foreach ($csirlabs as $index => $lab): ?>
			                    <?php $lab_id = $lab['id']; ?>
			                    <?php $collapse_id = 'collapseLab' . $index; ?>
			                    
			                    <div class="card mb-3">
			                        <!-- Accordion Header -->
			                        <div class="card-header text-white margin-bottom-10" id="heading<?= $index ?>">
			                            <h5 class="mb-0">
			                                <button class="btn btn-link text-white font-weight-bold" type="button"
			                                    data-toggle="collapse" data-target="#<?= $collapse_id ?>"
			                                    aria-expanded="false" aria-controls="<?= $collapse_id ?>"
			                                    style="text-decoration:none;">
			                                    <?= htmlspecialchars($lab['lab_name']) ?>
			                                </button>
			                            </h5>
			                        </div>

			                        <!-- Accordion Body -->
			                        <div id="<?= $collapse_id ?>" class="collapse" aria-labelledby="heading<?= $index ?>" data-parent="#labAccordion">
			                            <div class="card-body p-2">
			                                <table class="table table-bordered table-striped table-sm">
			                                    <thead class="thead-dark">
			                                        <tr>
			                                            <th>CSIR Lab</th>
			                                            <th>Form</th>
			                                            <th>Designation</th>
			                                            <th>Paylevel</th>
			                                            <th>Category</th>
			                                            <th>Sub Category</th>
			                                            <?php 
			                                                // Gather all genders for headers (once per lab)
			                                                $all_genders = [];
			                                                foreach ($forms as $fk => $fv) {
			                                                    if (isset($formdata[$lab_id . "-" . $fv['id']])) {
			                                                        foreach ($formdata[$lab_id . "-" . $fv['id']] as $form_id => $postdata) {
			                                                            $finaldata = json_decode($postdata['postdata'], true);
			                                                            $formdataItem = $this->login_model->get_table_data('forms', ['id' => $finaldata['formid']], '', '', '', '1');
			                                                            $genders = json_decode($formdataItem[0]['genders']);
			                                                            foreach ($genders as $g) $all_genders[$g] = true;
			                                                        }
			                                                    }
			                                                }
			                                                foreach (array_keys($all_genders) as $gend_id) {
			                                                    $gender_value = $this->login_model->get_table_data('genders', ['id' => $gend_id], '', '', '', '1');
			                                                    echo "<th>" . $gender_value[0]['name'] . "</th>";
			                                                }
			                                            ?>
			                                            <th>Total</th>
			                                        </tr>
			                                    </thead>
			                                    <tbody>
			                                        <?php 
			                                            // Print all rows for this lab
			                                            foreach ($forms as $fk => $fv):
			                                                if (!isset($formdata[$lab_id . "-" . $fv['id']])) continue;

			                                                foreach ($formdata[$lab_id . "-" . $fv['id']] as $form_id => $postdata):
			                                                    $finaldata = json_decode($postdata['postdata'], true);
			                                                    $designationValue = $this->login_model->get_table_data('designations', ['id' => $finaldata['designation']], '', '', '', '1');
			                                                    $paylevelValue   = $this->login_model->get_table_data('paylevel', ['id' => $finaldata['paylevel']], '', '', '', '1');
			                                                    $formdataItem    = $this->login_model->get_table_data('forms', ['id' => $finaldata['formid']], '', '', '', '1');
			                                                    $categories = json_decode($formdataItem[0]['categories']);
			                                                    $subcategories = json_decode($formdataItem[0]['subcategories']);
			                                                    $genders = json_decode($formdataItem[0]['genders']);

			                                                    foreach ($categories as $ck => $cv):
			                                                        $category_value = $this->login_model->get_table_data('categories', ['category_key' => $cv], '', '', '', '1');

			                                                        foreach ($subcategories as $sck => $scv):
			                                                            $subcategory_value = $this->login_model->get_table_data('subcategories', ['category_key' => $scv], '', '', '', '1');
			                                                            $subcategory_total = 0;
			                                        ?>
			                                                            <tr>
			                                                                <td><?= htmlspecialchars($lab['lab_name']) ?></td>
			                                                                <td><?= htmlspecialchars($fv['title']) ?></td>
			                                                                <td><?= htmlspecialchars($designationValue[0]['designation']) ?></td>
			                                                                <td><?= htmlspecialchars($paylevelValue[0]['paylevel']) ?></td>
			                                                                <td><?= htmlspecialchars($category_value[0]['name']) ?></td>
			                                                                <td><?= htmlspecialchars($subcategory_value[0]['name']) ?></td>
			                                                                <?php 
			                                                                    foreach (array_keys($all_genders) as $gend_id):
			                                                                        $postdata_gender_value_key = "postinput-" . $finaldata['formid'] . "-" . $finaldata['employeetype'] . "-" . $finaldata['designation'] . "-" . $finaldata['paylevel'] . "-" . $cv . "-" . $scv . "-" . $gend_id;
			                                                                        $gender_count = (int)($finaldata[$postdata_gender_value_key] ?? 0);
			                                                                        echo "<td>" . $gender_count . "</td>";
			                                                                        $subcategory_total += $gender_count;
			                                                                    endforeach;
			                                                                ?>
			                                                                <td><?= $subcategory_total ?></td>
			                                                            </tr>
			                                        <?php 
			                                                        endforeach;
			                                                    endforeach;
			                                                endforeach;
			                                            endforeach;
			                                        ?>
			                                    </tbody>
			                                </table>
			                            </div>
			                        </div>
			                    </div>
			                <?php endforeach; ?>
			            <?php else: ?>
			                <p class="text-danger">No labs found.</p>
			            <?php endif; ?>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>
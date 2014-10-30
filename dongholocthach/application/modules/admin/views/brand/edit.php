<?php
echo '<div class="container">';

	if(isset($brand) && $brand != null) {
        $base_url = base_url();
		echo form_open($base_url.'admin/brand/edit/'.$brand['brand_id']);
		echo form_fieldset('Edit brand !');
		echo '<div class="textfield">';
		echo form_label('brand_name',"Brand 's name");
		$data = array(
				  'name'        => 'brand_name',
				  'id'          => 'brand_name_'.$brand['brand_id'],
				  'value'       => $brand['brand_name'],
				  'maxlength'   => '200',
				  'size'        => '50'
				);
		
		echo form_input($data);
		echo '<span class="errors">';
		if (isset($errorName)) {
			echo $errorName;
		}
		echo '</div>';
		echo '<div class="textfield">';
		echo form_label('brand_desc',"Brand 's description");
		$data2 = array(
				  'name'        => 'brand_desc',
				  'id'          => 'brand_text_'.$brand['brand_id'],
				  'value'       => $brand['brand_desc'],
				  'cols'   => '20',
				  'rows'        => '8	',
				);
		echo form_textarea($data2);
		echo '</div>';
		echo '<div class="textfield">';
		echo form_submit('btnok','update');
		echo '</div';
		echo form_fieldset_close();
		echo form_close();
	}else {
        echo "<p>Khong co ID </p>";
    }
echo '</div>';
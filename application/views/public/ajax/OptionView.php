<option value="0">Facility/Academy</option>
<?php if (isset($results) && $results!='') {
foreach ($results as $result) { ?>
	<option value="<?=$result->fac_id;?>"><?=$result->fac_name;?></option>

<?php }
} ?>
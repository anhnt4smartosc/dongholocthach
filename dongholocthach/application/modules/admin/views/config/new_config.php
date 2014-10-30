<form action="<?php echo base_url();?>admin/config/new_config" class="form_enable" method='post'>
    <fieldset>
        <legend>New config</legend>
        <label for="config_name">Config name: </label>
        <input type="text" name="config_name" placeholder="config name" class="form-contrbol"/>
        <br /><br />        
        <label for="config_value">Config value: </label>
        <input type="text" name="config_value" placeholder="config value" class="form-control" />
        <br />
        <input type="submit" name="submit" value="new config" class="btn btn-default" /> 
    </fieldset>
</form>
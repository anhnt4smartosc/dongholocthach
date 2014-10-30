<div class="wrap">
    <div class="box" id="configs_list">
        <!-- Generate list config right here -->
        <!-- update and view -->
        
        <?php
            if(isset($configs) && $configs != null) {
                ?>
                <form action="<?php echo base_url();?>admin/config/update/" method="post">
                    <fieldset> 
                        <legend>Config Information</legend> 
                            <input type="hidden" name="first_link" id="first_link" value="<?php echo $first_link;?>" />
                            <?php                            
                            foreach($configs as $config)
                            {
                                $id = "config_id_" . $config['config_id'];
                                $value = "config_value_" . $config['config_id'];
                                $edit = "config_edit_" . $config['config_id'];
                                $del = "config_delete_" . $config['config_id'];                                
                                echo '<div class="wrap wrap_input">';
                                    echo form_hidden($id, $config['config_id']);
                                    $name = ucfirst($config['config_name']);
                                    $name = str_ireplace('_',' ', $name);                                
                                    echo form_label($name, $value);
                                    echo '<br />';
                                    echo form_input($value, $config['config_value']);
                                    echo '<b>Edit</b>';
                                    echo form_checkbox($edit, $config['config_id']);
                                    echo ' <b>Delete</b>';
                                    echo form_checkbox($del, $config['config_id']);
                                echo '</div>';
                            }
                            ?>
                            <br />
                            <input type="submit" name="submit" value="save " />
                    </fieldset>                    
                </form>
                <?php
                if (isset($pages)) echo $pages;
            }
        ?>
        <a href="<?php echo base_url();?>admin/config/new_config/" class="btn btn-primary" > | Add config</a> 
    </div>
</div>
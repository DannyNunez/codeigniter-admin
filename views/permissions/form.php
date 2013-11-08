<p>
<h3 style="display:inline-block">Add Permission</h3>
        <a class="btn btn-danger pull-right" href="<?php echo base_url('settings/permissions'); ?>">Cancel</a>
</p>
<hr>
<?php if (isset($message)): ?>
    <div class="alert">
        <?php echo $message; ?>
    </div>
    <br>
<?php endif; ?>
<?php echo form_open($path,array('class' => 'form-horizontal')); ?>
<!-- NAME  -->   
<div class="control-group">
    <?php echo form_label('Name', 'name', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo form_input(array('name' => 'name', 'id' => 'name', 'style' => 'width:80%', 'required' => 'required'), $permission->name); ?> 
    </div>
</div>
<!-- DESCRIPTION  -->
<div class="control-group">
    <?php echo form_label('Description', 'description', array('class' => 'control-label', 'for' => 'decription')); ?>
    <div class="controls">
        <?php echo form_textarea(array('name' => 'description', 'id' => 'description', 'maxlength' => '100', 'size' => '50', 'style' => 'width:80%'), $permission->description); ?> 
    </div>
</div>
<!-- STATUS --> 
<div class="control-group">
    <?php echo form_label('Status', 'status', array('class' => 'control-label')); ?>
    <div class="controls">
        <select name="status">
            <?php foreach ($statusOptions as $value): ?>
                <?php if ($permission->status ==  $value->id): ?>   
                    <option value="<?php echo $value->id; ?>" selected="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>   
                <?php else: ?>
                   <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>  
                <?php endif; ?>
            <?php endforeach; ?>             
        </select>
    </div>
</div>
<?php if ($method == 'edit'): ?>
    <?php echo form_hidden('id', $permission->id); ?>
<?php endif; ?>
<div class="control-group">
    <div class="controls">
        <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Save Permission </button>
    </div>
</div>
<?php echo form_close() ?>
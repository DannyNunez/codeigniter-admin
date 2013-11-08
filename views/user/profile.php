<h1><img src="<?php echo $profile->gravatar; ?>"/></h1>

<?php if(isset($message)):?>
<div class="alert">
    <?php echo $message; ?>
</div>
<?php endif;?>

<hr>
<?php echo form_open($path, array('class' => 'form-horizontal')); ?>

<!-- FIRST NAME -->

<div class="control-group">
    <?php echo form_label('First Name', 'firstName', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo form_input(array('name' => 'firstName', 'id' => 'firstName', 'style' => 'width:80%', 'required' => 'required'), $profile->firstName ); ?> 
    </div>
</div>

<!-- LAST NAME -->

<div class="control-group">
    <?php echo form_label('Last Name', 'lastName', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo form_error('lastName'); ?>
        <?php echo form_input(array('name' => 'lastName', 'id' => 'lastName', 'style' => 'width:80%', 'required' => 'required'), $profile->lastName); ?> 
    </div>
</div>

<!-- EMAIL -->

<div class="control-group">
    <?php echo form_label('Email', 'email', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo form_error('email'); ?>
        <?php echo form_input(array('name' => 'email', 'id' => 'email', 'style' => 'width:80%', 'required' => 'required'), $profile->email); ?> 
    </div>
</div>

<!-- DATE OF BIRTH --> 

<div class="control-group">
    <?php echo form_label('Birthday', 'birthday', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo form_error('birthday'); ?>
        <?php echo form_input(array('name' => 'birthday', 'id' => 'birthday', 'class' => 'register', 'data-original-title' => $this->config->item('birthday_tooltip')), $profile->birthday); ?>
    </div>
</div>

<!-- BIO  -->

<div class="control-group">
    <?php echo form_label('Biographical Info', 'bio', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo form_textarea(array('name' => 'bio', 'id' => 'bio','style' => 'width:80%'), $profile->bio); ?> 
    </div>
</div>

<div class="control-group">
    <div class="controls">
        <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Update Profile</button>
    </div>
</div>

<?php
echo form_close();
//echo "<pre>";
//var_dump($profile);
//echo "</pre>";
$date = new DateTime();
$date->sub(new DateInterval('P18Y'));
?>

<script>
    $(function() {
        $("#birthday").datepicker({
            dateFormat: "mm/dd/yy",
            changeMonth: true,
            changeYear: true,
            minDate: new Date('1900/01/01'),
            maxDate: new Date('<?php echo $date->format('Y/m/d'); ?>'),
            yearRange: '1900:<?php echo $date->format('Y'); ?>'
        });
    });
    $('.register').tooltip({
        placement: 'right',
        html: true
    });
     //CKEDITOR.replace( 'bio' );
</script>
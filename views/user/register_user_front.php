<h1>Welcome to the Falcon Community Website</h1>

<?php
if(isset($error_message)){
    echo $error_message;
}
?>

<hr>
<?php echo form_open($path, array('class' => 'form-horizontal')); ?>

<!-- FIRST NAME -->

<div class="control-group">
    <?php echo form_label('First Name', 'firstName', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo form_error('firstName'); ?>
        <?php echo form_input(array('name' => 'firstName', 'id' => 'firstName', 'style' => 'width:80%', 'required' => 'required'), set_value('firstName')); ?> 
    </div>
</div>

<!-- LAST NAME -->

<div class="control-group">
    <?php echo form_label('Last Name', 'lastName', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo form_error('lastName'); ?>
        <?php echo form_input(array('name' => 'lastName', 'id' => 'lastName', 'style' => 'width:80%', 'required' => 'required'), set_value('lastName')); ?> 
    </div>
</div>

<!-- EMAIL -->

<div class="control-group">
    <?php echo form_label('Email', 'email', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo form_error('email'); ?>
        <?php echo form_input(array('name' => 'email', 'id' => 'email', 'style' => 'width:80%', 'required' => 'required'), set_value('email')); ?> 
    </div>
</div>

<!-- PASSWORD -->

<div class="control-group">
    <?php echo form_label('Password', 'password', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo form_error('password'); ?>
        <?php echo form_password(array('name' => 'password', 'id' => 'password',  'class' =>  'register', 'style' => 'width:80%', 'required' => 'required', 'data-original-title' => $this->config->item('password_tooltip'))); ?> 
    </div>
</div>

<!-- PASSWORD CONFIRM -->

<div class="control-group">
    <?php echo form_label('Password Confirmation', 'passConf', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo form_password(array('name' => 'passConf', 'id' => 'passConf', 'style' => 'width:80%', 'required' => 'required')); ?> 
    </div>
</div>

<!-- DATE OF BIRTH --> 

<div class="control-group">
    <div class="control-group">
        <?php echo form_label('Birthday', 'birthday', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo form_error('birthday'); ?>
            <?php echo form_input(array('name' => 'birthday', 'id' => 'birthday',  'class' =>  'register', 'data-original-title' => $this->config->item('birthday_tooltip')), set_value('birthday')); ?>
        </div>
    </div>
</div>

<div class="control-group">
    <?php echo form_label('Captcha', 'captcha', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo form_error('recaptcha_response_field'); ?>
        <?php echo $captcha; ?>
    </div>
</div>

<div class="control-group">
    <?php echo form_label('Submit', 'submit', array('class' => 'control-label')); ?>
    <div class="controls">
       <?php echo form_submit('submit', 'submit'); ?>
    </div>
</div>

<?php
echo form_close();
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
                maxDate: new Date('<?php echo $date->format('Y/m/d');?>'),
                yearRange: '1900:<?php echo $date->format('Y');?>'
        });
    });
    $('.register').tooltip({
        placement: 'right',
        html: true
    });
</script>
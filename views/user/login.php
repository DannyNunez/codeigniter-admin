<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Sign in to the Falcon</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                <?php echo form_open('login' , array('class' => 'form-signin')) ;?>
                <input type="text" name="email" class="form-control" style="width:329px;" placeholder="Email" required autofocus>
                <br>
                <input type="password" name="password" class="form-control" style="width:329px;"placeholder="Password" required>
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
                <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="<?php echo base_url('register');?>" class="text-center new-account">Create an account </a>
        </div>
    </div>
</div>
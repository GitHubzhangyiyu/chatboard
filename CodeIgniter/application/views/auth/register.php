<h2><?php echo $title; ?></h2>
<?php echo validation_errors(); ?>
<?php echo form_open('auth/register'); ?>
    <label for="username">用户名</label>
	<input type="input" name="username" /><br />
	
	<label for="email">email</label>
	<input type="input" name="email" /><br />
	
	<label for="pass">密码</label>
	<input type="password" name="pass" /><br />
	
	<label for="passconf">确认密码</label>
	<input type="password" name="passconf" /><br />
	
	<input type="submit" name="submit" value="注册" />
</form>
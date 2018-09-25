<h2><?php echo $title; ?></h2>
<?php 
echo form_open('auth/login');
if (isset($error))
{
    echo "<h5>$error</h5><br />";
}	
?>	
	<label for="email">email</label>
	<input type="input" name="email" /><br />
	
	<label for="pass">密码</label>
	<input type="password" name="pass" /><br />
	
	<input type="submit" name="submit" value="登录" />
</form>
<h2><?php echo $title; ?></h2>
<?php echo validation_errors(); ?>
<?php 
echo form_open('message/create');
if (isset($error))
{
	echo "<h5>$error</h5><br />";
}
?>
    <label for="to_username">To:（请填写想留言的对方用户名，0表示公共留言板）</label>
    <input type="input" name="to_username" /><br />
	
	<label for="text">留言内容</label>
	<textarea name="text"></textarea><br />
	
	<input type="submit" name="submit" value="确认留言" />
</form>
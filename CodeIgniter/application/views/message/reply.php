<h2><?php echo $title; ?></h2>
<?php echo validation_errors(); ?>
<?php 
echo form_open("message/reply/$rmid/$fuid");
?>
	<label for="text">回复内容</label>
	<textarea name="text"></textarea><br />
	<input type="submit" name="submit" value="确认回复" />
</form>
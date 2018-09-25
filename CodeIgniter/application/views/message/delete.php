<?php
if(isset($_SESSION['username']))
{
	echo "<h1>Hello,{$_SESSION['username']}</h1></ br>";
}
echo "________________________________";
?>
<?php foreach ($messages as $message_item): ?>
    <div class="main">
	    <?php echo $message_item['text']; ?>
	</div>
	<?php echo "<p>{$message_item['addtime']}</p>"; ?>
	<p><a href="<?php echo site_url('message/delete/'.$message_item['message_id']); ?>">删除</a></p>
<?php endforeach; ?>
<?php
if(isset($_SESSION['username']))
{
	echo "<h1>Hello,{$_SESSION['username']}</h1><br />";
}
echo "________________________________";
?>
<?php foreach ($messages as $message_array): ?>
    <?php foreach ($message_array as $message_item): ?>
        <div class="main">
	        <?php echo $message_item['text']; ?>
	    </div>
	    <?php echo "<p>BY {$message_item['username']},{$message_item['addtime']}</p>"; ?>
    <?php endforeach; ?>
	<p><a href="<?php echo site_url('message/reply/'.$message_item['root_mid'].'/'.$message_item['from_uid']); ?>">回复</a></p>
	<?php echo "________________________________"; ?>
<?php endforeach; ?>
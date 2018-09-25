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
	<?php echo "<p>BY {$message_item['username']},{$message_item['addtime']}</p>"; ?>
<?php endforeach; ?>
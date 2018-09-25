<?php
if(isset($_SESSION['username']))
{
	echo "<h1>Hello,{$_SESSION['username']}</h1></ br>";
}
echo "________________________________";
?>
<?php foreach ($users as $users_item): ?>
    <div class="main">
	    <?php echo $users_item['username']; ?>
	</div>
	<?php echo "<p>{$users_item['email']}</p>"; ?>
	<p><a href="<?php echo site_url('auth/viewusers/'.$users_item['user_id']); ?>">删除</a></p>
<?php endforeach; ?>
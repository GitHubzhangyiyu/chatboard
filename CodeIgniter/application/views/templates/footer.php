</div>

<div id="Menu">
	<a href="/CodeIgniter/index.php/message/index" title="Home Page">主页</a><br />
	<?php
	if (isset($_SESSION['user_id'])) {
		echo '<a href="/CodeIgniter/index.php/auth/logout" title="Logout">登出</a><br />';
		if ($_SESSION['permission'] == TRUE) {
			echo '<a href="/CodeIgniter/index.php/auth/viewusers" title="View All Users">管理用户</a><br />';
		}
	} 
	else { 
		echo '<a href="/CodeIgniter/index.php/auth/register" title="Register for the Site">注册</a><br />
	          <a href="/CodeIgniter/index.php/auth/login" title="Login">登录</a><br />';
	}
	?>
	<a href="/CodeIgniter/index.php/message/personal">个人空间</a><br />
	<a href="/CodeIgniter/index.php/message/create">新增留言</a><br />
	<a href="/CodeIgniter/index.php/message/delete">删除留言</a><br />
</div>

</body>
</html>

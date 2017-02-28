<div class="user-block">
	<div class="btn-group">
		<a class="btn btn-large btn-inverse" href="#"><i class="icon-user icon-white"></i> {user[login]}</a>
		<a class="btn btn-large btn-inverse dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
		<ul class="dropdown-menu">
			{isAdmin}
			<li><a href="/cabinet/admin/"><i class="icon-warning-sign"></i> Админ-Центр</a></li>
			<li class="divider"></li>
			{end}
			<li><a href="/cabinet/settings/"><i class="icon-wrench"></i> Настройки</a></li>
			<li class="divider"></li>
			<li name="login-exit" ><a href="#"><i class="icon-off"></i> Выход</a></li>
		</ul>
	</div>
</div>
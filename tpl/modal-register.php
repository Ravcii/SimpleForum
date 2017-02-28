<div class="modal hide" id="reg-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3>Регистрация</h3>
	</div>
	<div class="modal-body">
		<div id="message" class="alert alert-error alert-block hide">
		  <h4>Ошибка!</h4>
		  <span></span>
		</div>
		<form id="reg-modal-form" action="#" class="form-horizontal">
			<div class="control-group">
				<label class="control-label" for="">Логин</label>
				<div class="controls">
					<input name="login" type="text" placeholder="Логин">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="">Пароль</label>
				<div class="controls">
					<input name="password" type="password" placeholder="Пароль">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="">E-Mail адресс</label>
				<div class="controls">
					<input name="e-mail" type="text" placeholder="E-Mail">
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<button class="btn btn-small" data-dismiss="modal" aria-hidden="true">Закрыть</button>
		<button form="reg-modal-form" class="btn btn-small btn-primary">Регистрация</button>
	</div>
</div>
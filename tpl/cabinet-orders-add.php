<div class="span9">
	<div class="row">
		<h2>Сделать заказ</h2>
		<form id="add-order-form" class="form-horizontal">
			<div id="message" class="alert alert-error alert-block hide">
				<h4>Ошибка!</h4>
				<span></span>
			</div>
			<div class="span9">
				<div class="control-group">
					<label class="control-label">Заголовок</label>
					<div class="controls">
						<input name="title" class="input-xlarge" type="text" placeholder="Красткое описание вашего заказа">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Описание заказа</label>
					<div class="controls">
						<textarea name="desc" class="input-xxlarge" rows="6" placeholder="Полное описание вашего заказа. Желательно, как можно точнее"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Цена</label>
					<div class="controls input-append">
						<input class="input-small" name="price" type="text" placeholder="Ваша оплата"><span class="add-on">рублей</span>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-actions">
				<div class="pull-right">
					<input type="submit" class="btn btn-small btn-primary" value="Отправить заказ"></input>
					<a href="/cabinet/" class="btn btn-small">Отменить</a>
				</div>
            </div>
		</form>
    </div>
</div>
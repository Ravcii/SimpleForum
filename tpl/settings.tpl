<div class="topicBackground">
    <div class="fast_answer">
        <div id="message" class="{show}">{message}</div>
        <form method="POST" action="/settings" enctype="multipart/form-data">
            <input type="hidden" name="action" value="true" />
            <span class="highlighted">Изменить пароль:</span>
            <div class="form_input">
                <span class="highlighted">Новый пароль:</span>
                <input type="password" name="pass" class="topic_title" />
            </div>
            <div class="form_input">
                <span class="highlighted">Повторите новый пароль:</span>
                <input type="password" name="repass" class="topic_title" />
            </div>
            <span class="highlighted">Загрузить аватар:</span>
            <div class="form_input">
                <input type="file" name="avatar" />
            </div>
            <input type="submit" class="buttonMessages right" value="Отправить" />
            <div class="clear"></div>
        </form>
    </div>
</div>
</div>

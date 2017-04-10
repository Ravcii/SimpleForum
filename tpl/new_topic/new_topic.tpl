<div class="topicBackground">
    <div class="fast_answer">
        <div id="message" class="{show}">{message}</div>
        <form method="POST" action="/topic.id={topic_id}">
            <input type="hidden" name="action" value="true" />
            <span class="highlighted">Быстрый ответ:</span>
            <div class="form_input">
                <textarea name="text" rows="10" resize="no"></textarea>
            </div>
            <input type="submit" class="buttonMessages right" value="Отправить" />
            <div class="clear"></div>
        </form>
    </div>
    <div class="fast_answer">

        <span class="highlighted">Наименование темы:</span>
        <div class="form_input">
                <textarea name="answer" rows="2" resize="no"></textarea>
            <div class="clear"></div>
        </div>


        <span class="highlighted">Содержание темы:</span>
        <div class="form_input">
            <textarea name="answer" rows="10" resize="no"></textarea>
        </div>


        <a href="#" class="buttonMessages right">Предпросмотр</a>
        <a href="#" class="buttonMessages right">Отправить</a>
        <div class="clear"></div>

    </div>
</div>
</div>
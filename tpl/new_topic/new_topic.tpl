<div class="topicBackground">
    <div class="fast_answer">
        <div id="message" class="{show}">{message}</div>
        <form method="POST" action="/newtopic.parent={pid}">
            <input type="hidden" name="action" value="true" />
            <h2 class="highlighted">Заголовок:</h2>
            <div class="form_input">
                <input type="text" name="title" class="topic_title" required />
            </div>
            <span class="highlighted">Содержание темы:</span>
            <div class="form_input">
                <textarea name="text" rows="10" resize="no" required></textarea>
            </div>
            <input type="submit" class="buttonMessages right" value="Отправить" />
            <div class="clear"></div>
        </form>
    </div>
</div>
</div>

<a href="/section.id={parentId}" class="new_topic_button left">Назад</a>
<div class="clear"></div>
<div class="topic">
    <span class="name">{topic_title}</span>
</div>
<div class="pagination">
    {pagination}
</div>
<div class="clear"></div>
<div class="topicBackground">
    {user_messages}
    <div class="pagination">
        {pagination}
    </div>
    <div class="clear"></div>
    {ifLogged}
    <div class="fast_answer">
        <div id="message" class="{show}">{message}</div>
        <form method="POST" action="{this_page}">
            <input type="hidden" name="action" value="true" />
            <span class="highlighted">Быстрый ответ:</span>
            <div class="form_input">
                <textarea name="text" rows="10" resize="no"></textarea>
            </div>
            <input type="submit" class="buttonMessages right" value="Отправить" />
            <div class="clear"></div>
        </form>
    </div>
    {end}
</div>
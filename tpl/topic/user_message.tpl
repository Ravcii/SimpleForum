<div id="mid_{message_id}" class="background_message_user">
    <div class="user_panel left">
        <a href="/user.id={user_id}">
            <span id="name">{user_login}</span>
            <div class="user_avatar">
                <img class="avatar"
                    src="/user_files/avatars/{user_id}"
                    onerror="this.src='./tpl/img/avatar.png'"
                />
            </div>
        </a>
        <span id="count_messages">Сообщений: 1000</span>
        <span id="status">Статус: Online</span>
    </div>
    <div class="highlighted">Опубликовано - {message_date}</div>
    <div class="text_messages right">
        {message_text}
    </div>
    <div class="clear"></div>
</div>
<h2>Регистрация нового пользователя</h2>
<h3><?= $message ?? ''; ?></h3>
<form method="post">
    <label>Имя <input type="text" name="name"></label>
    <label>Логин <input type="text" name="login"></label>
    <label>Пароль <input type="password" name="password"></label>
    <label>
        <select name="IdRole">
            <option value="1">Обычный смертный</option>
            <option value="2">Админ</option>
        </select>
    </label>
    <button>Зарегистрироваться</button>
</form>
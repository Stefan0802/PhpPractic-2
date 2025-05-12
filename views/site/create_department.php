<h2 style="text-align: center">Создание нового подразделения</h2>
<h3><?= $message ?? ''; ?></h3>
<form method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label for="name">Имя </label>
    <input type="text" name="name" id="name">

    <label>
        <select name="idDepartmentType" style="background-color: yellow">
            <?php
            foreach ($types as $type) {
                echo '<option value=" ' . $type->id  . ' ">' . $type->name . '</option>';
            }
            ?>
        </select>
    </label>
    <button>Создать</button>
</form>


<style>
    body{

    }
    form{
        display: flex;
        flex-direction: column;
        width: 500px;
        background-color: #6495ed;
        margin: 0 auto;
        text-align: center;
        border-radius: 20px;
        padding: 20px 20px 20px 20px;

    }

    form > input {
        width: 200px;
        height: 20px;
        margin: 10px auto;
        border-radius: 20px;
        border: 3px solid palegoldenrod;
        background-color: #e0f7fa;
        text-align: center;
    }

    form > label{
        color: white;
        font-size: 19px;
    }

    button {
        width: 200px;
        margin: 20px auto 0;
        height: 45px;
        background-color: #adff2f; /* Желто-зеленый */
        border-radius: 17px;
        border: 3px solid palegoldenrod;
        cursor: pointer;
        color: darkmagenta;
        font-size: 18px;
        font-weight: bold;
        transition: background-color 0.4s ease, transform 0.5s ease;
    }

    button:hover {
        background-color: #7cfc00; /* Ярко-зеленый */
        transform: scale(1.05); /* Легкое увеличение */
    }

    button:active {
        transform: scale(0.98); /* Небольшое сжатие при клике */
    }

</style>
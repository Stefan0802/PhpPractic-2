<style>

    .user-table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
    }

    .user-table th,
    .user-table td {
        padding: 12px 15px;
        text-align: left;
        border: 1px solid black; /* Черная рамка */
    }

    .user-table th {
        background-color: #ffffff; /* Белый фон */
        font-weight: bold;
        color: #333;
    }

    .user-table tr:nth-child(even) {
        background-color: #f9f9f9; /* Светлый фон для четных строк */
    }

    .but{
        display: flex;
        justify-content: center;
        text-decoration: none;
        margin: 10px auto;
        padding: 10px;
        border-radius: 20px;
        color: white;
        background-color: #333333;
        width: 200px;
        transition: background-color 0.4s ease;
    }
    .but:hover{
        background-color: #7cfc00; /* Ярко-зеленый */
        transform: scale(1.05); /* Легкое увеличение */
    }

</style>
</head>
<body>

<a class="but" href="<?= app()->route->getUrl('/department/createDepartment') ?>">Создать подразделение</a>
<a class="but" href="<?= app()->route->getUrl('/department/TypeDepartment') ?>">Виды подразделения</a>

<form action="<?= app()->route->getUrl('/department') ?>" method="GET" style="display: flex; justify-content: center; flex-direction: column; width: 200px; margin: 0 auto">
    <label>
        <input type="text" name="search_field" style="text-align: center; width: 200px" value="<?= htmlspecialchars($search ?? '') ?>">
    </label>
    <button type="submit" style="width: 150px; margin: 0 auto; border-radius: 5px; background-color: greenyellow">Найти</button>
</form>


<!-- Таблица пользователей -->
<table class="user-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Подразделения</th>
        <th>Вид подразделения</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($departments as $department) {
        echo "<tr>";
        echo '<td>' . htmlspecialchars($department->id ?? '') . '</td>';
        echo '<td>' . htmlspecialchars($department->name ?? '')  . '</td>';
        echo '<td>' . htmlspecialchars($typeNames[$department->idDepartmentType] ?? '' ). '</td>';
        echo "</tr>";
    }
    ?>
    </tbody>
</table>




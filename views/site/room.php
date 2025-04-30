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


<!-- Таблица пользователей -->
<table class="user-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Логин</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Роль</th>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>




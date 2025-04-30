<style>
    .user-table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        box-shadow: 0 2px 3px rgba(0,0,0,0.1);
    }

    .user-table th,
    .user-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .user-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #333;
    }

    .user-table tr:hover {
        background-color: #f5f5f5;
    }

    .user-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>

<table class="user-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Role</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($users as $user) {
        echo "<tr>";
        echo '<td>' . htmlspecialchars($user->id ?? '') . '</td>';
        echo '<td>' . htmlspecialchars($user->name ?? '') . '</td>';
        echo '<td>' . htmlspecialchars($user->first_name ?? '') . '</td>';
        echo '<td>' . htmlspecialchars($user->last_name ?? '') . '</td>';
        echo '<td>' . htmlspecialchars($user->role ?? '') . '</td>';
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
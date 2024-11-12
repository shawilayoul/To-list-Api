<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; background-color: #4CAF50; border-radius: 5px; }
        .btn-delete { background-color: red; }
        .btn-complete { background-color: orange; }
    </style>
</head>
<body>
    <h1>To-Do List</h1>

    <!-- Add Task Form -->
    <form action="/task/add" method="POST">
        <input type="text" name="task_name" placeholder="Enter task" required>
        <button type="submit">Add Task</button>
    </form>

    <h2>Tasks:</h2>
    <table>
        <thead>
            <tr>
                <th>Task</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $tasks->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['task_name']); ?></td>
                    <td><?= ucfirst($row['status']); ?></td>
                    <td>
                        <?php if ($row['status'] == 'pending'): ?>
                            <a href="/task/complete/<?= $row['id']; ?>" class="btn btn-complete">Complete</a>
                        <?php endif; ?>
                        <a href="/task/delete/<?= $row['id']; ?>" class="btn btn-delete">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

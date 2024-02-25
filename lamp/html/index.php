<?php
    $pdo = new PDO("mysql:host=mysql;dbname=test;charset=utf8", "test", "test", [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $text = $_POST['text'];
        $image = file_get_contents($_FILES['image']['tmp_name']);
        $sth = $pdo->prepare("INSERT INTO todos (name, text, image) VALUES (:name, :text, :image)");
        $sth->bindValue(':name', $name, PDO::PARAM_STR);
        $sth->bindValue(':text', $text, PDO::PARAM_STR);
        $sth->bindValue(':image', $image, PDO::PARAM_STR);
        $sth->execute();
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $sth = $pdo->prepare("DELETE FROM todos WHERE id = :id");
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
    <h1>Todo List</h1>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="name">Name</label>
        <input type="text" name="name" value="">
        <label for="text">Text</label>
        <input type="text" name="text" value="">
        <label for="image">Image</label>
        <input type="file" name="image" accept="image/*">
        <button type="submit" name="submit">Add</button>
    </form>
    <h2>Current Todos</h2>
    <table>
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Task</th>
            <th>Image</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php
                $sth = $pdo->prepare("SELECT * FROM todos ORDER BY id DESC");
                $sth->execute();

                foreach($sth as $row) {
                    $img = base64_encode($row['image']);
            ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['text']) ?></td>
                <td><img src="data:<?php echo $row['name'] ?>;base64,<?php echo $img; ?>" style="max-width: 400px; max-height: 300px;"></td>
                <td>
                    <form method="POST">
                        <button type="submit" name="delete">Delete</button>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="delete" value="true">
                    </form>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>
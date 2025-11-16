<!DOCTYPE html>
<html>

<body>
    <?php if (isset($error)): ?>
        <h1><?= $error ?></h1>
    <?php else: ?>
        <h1>User Info</h1>
        <p>ID: <?= $user['id'] ?></p>
        <p>Name: <?= $user['name'] ?></p>
    <?php endif; ?>

</body>

</html>
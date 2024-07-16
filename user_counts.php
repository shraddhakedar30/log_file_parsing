<?php
if (isset($_GET['file'])) {
    $logFilePath = urldecode($_GET['file']);

    if (!file_exists($logFilePath)) {
        die("Log file does not exist!");
    }

    $logFileContent = file($logFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $userLogins = [];

    foreach ($logFileContent as $line) {
        preg_match('/user=\s*(\w+)/', $line, $matches);

        if (!empty($matches[1])) {
            $userId = $matches[1];

            if (isset($userLogins[$userId])) {
                $userLogins[$userId]++;
            } else {
                $userLogins[$userId] = 1;
            }
        }
    }
} else {
    die("No log file specified!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Logins</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-4">
        <h2>Unique User Logins</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Login Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userLogins as $userId => $loginCount): ?>
                    <tr>
                        <td><?= htmlspecialchars($userId) ?></td>
                        <td><?= htmlspecialchars($loginCount) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="total_logins.php?file=<?= urlencode($logFilePath) ?>" class="btn btn-primary">View Total Logins by User ID</a>
    </div>
</body>
</html>


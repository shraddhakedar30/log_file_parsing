<?php
if (isset($_GET['file'])) {
    $logFilePath = urldecode($_GET['file']);

    if (!file_exists($logFilePath)) {
        die("Log file does not exist!");
    }

    $logFileContent = file($logFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $userCategories = ['an' => 'BARC', 'dps' => 'DPS'];
    $userLogins = [];

    foreach ($logFileContent as $line) {
        preg_match('/user=(\w+)/', $line, $userMatches);
        if (!empty($userMatches[1])) {
            $userId = $userMatches[1];
            $userLogins[$userId] = isset($userLogins[$userId]) ? $userLogins[$userId] + 1 : 1;
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
    <title>Total Logins</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Total Logins by User ID</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Category</th>
                    <th>Login Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userLogins as $userId => $loginCount): ?>
                    <tr>
                        <td><?= htmlspecialchars($userId) ?></td>
                        <td>
                            <?php
                            $category = '';
                            foreach ($userCategories as $prefix => $name) {
                                if (strpos($userId, $prefix) === 0) {
                                    $category = $name;
                                    break;
                                }
                            }
                            echo htmlspecialchars($category);
                            ?>
                        </td>
                        <td><?= htmlspecialchars($loginCount) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
if (isset($_GET['file'])) {
    $logFilePath = urldecode($_GET['file']);

    if (!file_exists($logFilePath)) {
        die("Log file does not exist!");
    }

    $statusCounts = [];
    $handle = fopen($logFilePath, 'r');
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            if (preg_match('/TCP_[A-Z]+\/(\d{3})/', $line, $matches)) {
                $statusCode = $matches[1];
                $statusCounts[$statusCode] = isset($statusCounts[$statusCode]) ? $statusCounts[$statusCode] + 1 : 1;
            }
        }
        fclose($handle);
    } else {
        echo "Error: Unable to open the log file.";
        exit;
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
    <title>HTTP Status Summary</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>HTTP Status Summary</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>HTTP Status Code</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($statusCounts as $statusCode => $count): ?>
                    <tr>
                        <td><?= htmlspecialchars($statusCode) ?></td>
                        <td><?= htmlspecialchars($count) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>


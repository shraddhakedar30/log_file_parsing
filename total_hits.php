<?php
if (isset($_GET['file'])) {
    $logFilePath = urldecode($_GET['file']);

    if (!file_exists($logFilePath)) {
        die("Log file does not exist!");
    }

    ini_set('memory_limit', '512M');

    $sourceCounts = [];
    $handle = fopen($logFilePath, "r");

    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            if (preg_match('/src=(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $line, $srcMatches)) {
                $srcAddress = $srcMatches[1];
                if (!isset($sourceCounts[$srcAddress])) {
                    $sourceCounts[$srcAddress] = 0;
                }
                $sourceCounts[$srcAddress]++;
            }
        }
        fclose($handle);
    } else {
        die("Error opening the log file.");
    }

    arsort($sourceCounts);
} else {
    die("No log file specified!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Hits by Source Address</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Total Hits by Source Address (Descending Order)</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Source Address</th>
                    <th>Hit Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sourceCounts as $srcAddress => $count): ?>
                    <tr>
                        <td><?= htmlspecialchars($srcAddress) ?></td>
                        <td><?= htmlspecialchars($count) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

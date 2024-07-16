<?php
if (isset($_GET['file'])) {
    $logFilePath = urldecode($_GET['file']);

    if (!file_exists($logFilePath)) {
        die("Log file does not exist!");
    }

    $denialCounts = [];

    if (($handle = fopen($logFilePath, 'r')) !== false) {
        while (($line = fgets($handle)) !== false) {
            if (strpos($line, 'proto= tcp') !== false && strpos($line, 'msg="Webwall: packet dropped"') !== false) {
                preg_match('/src=(\S+)/', $line, $srcMatches);
                preg_match('/sport=(\d+)/', $line, $sportMatches);
                preg_match('/dst=(\S+)/', $line, $dstMatches);
                preg_match('/dport=(\d+)/', $line, $dportMatches);

                if ($srcMatches && $sportMatches && $dstMatches && $dportMatches) {
                    $src = $srcMatches[1];
                    $sport = $sportMatches[1];
                    $dst = $dstMatches[1];
                    $dport = $dportMatches[1];

                    $key = "$src:$sport -> $dst:$dport";

                    if (!isset($denialCounts[$key])) {
                        $denialCounts[$key] = 0;
                    }

                    $denialCounts[$key]++;
                }
            }
        }
        fclose($handle);
    } else {
        die("Error opening the log file.");
    }

    arsort($denialCounts);
    $topDenials = array_slice($denialCounts, 0, 10, true);
} else {
    die("No log file specified!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top 10 TCP Denials</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Top 10 TCP Denials</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Source:Port -> Destination:Port</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topDenials as $key => $count): ?>
                    <tr>
                        <td><?= htmlspecialchars($key) ?></td>
                        <td><?= htmlspecialchars($count) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

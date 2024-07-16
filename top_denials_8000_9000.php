<?php
if (isset($_GET['file'])) {
    $logFilePath = urldecode($_GET['file']);

    if (!file_exists($logFilePath)) {
        die("Log file does not exist!");
    }

    $denialCounts = [];

    if (($handle = fopen($logFilePath, 'r')) !== false) {
        while (($line = fgets($handle)) !== false) {
            if (strpos($line, 'msg="Webwall: packet dropped"') !== false) {
                preg_match('/src=([^\s]+)/', $line, $srcMatches);
                preg_match('/sport=([0-9]+)/', $line, $sportMatches);
                preg_match('/dst=([^\s]+)/', $line, $dstMatches);
                preg_match('/dport=([0-9]+)/', $line, $dportMatches);

                if (isset($dstMatches[1], $dportMatches[1]) && $dportMatches[1] >= 8000 && $dportMatches[1] <= 9000) {
                    $src = isset($srcMatches[1]) ? $srcMatches[1] : 'Unknown';
                    $sport = isset($sportMatches[1]) ? $sportMatches[1] : 'Unknown';
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
    <title>Top 10 Denials (Destination Ports 8000-9000)</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Top 10 Denials (Destination Ports 8000-9000)</h2>
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

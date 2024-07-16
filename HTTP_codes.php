<?php

$logFilePath = 'C:\Users\Shraddha\Desktop\php\sample.log';

$statusCounts = [];

$handle = fopen($logFilePath, 'r');
if ($handle) {

    while (($line = fgets($handle)) !== false) {
   
        if (preg_match('/TCP_[A-Z]+\/(\d{3})/', $line, $matches)) {
            $statusCode = $matches[1];

            if (isset($statusCounts[$statusCode])) {
                $statusCounts[$statusCode]++;
            } else {
                $statusCounts[$statusCode] = 1;
            }
        }
    }

    fclose($handle);
} else {

    echo "Error: Unable to open the log file.";
    exit;
}

foreach ($statusCounts as $statusCode => $count) {
    echo "HTTP Status Code $statusCode: $count times\n";
}

?>

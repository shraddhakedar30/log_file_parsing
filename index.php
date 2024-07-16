<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Analysis</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Select Statistics Type</h2>
        <form action="process_log.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="logFile">Upload Log File:</label>
                <input type="file" name="logFile" class="form-control" id="logFile" required>
            </div>
            <div class="form-group">
                <label for="statisticsType">Select Statistics Type:</label>
              <select name="statisticsType" id="statisticsType" class="form-control">
    <option value="">--Select--</option>
    <option value="user_logins">User Logins</option>
    <option value="total_logins">Total Logins</option>
    <option value="http_summary">HTTP Status Summary</option>
    <option value="total_hits">Total Hits by Source Address</option>
    <option value="top_tcp_denials">Top 10 TCP Denials</option>
    <option value="top_udp_denials">Top 10 UDP Denials</option>
    <option value="top_icmp_denials">Top 10 ICMP Denials</option>
    <option value="top_standard_denials">Top 10 Denials (Standard Destination Ports)</option>
    <option value="top_denials_8000_9000">Top 10 Denials (Destination Ports 8000-9000)</option>
</select>

   </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>

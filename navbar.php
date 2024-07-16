<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Log Analysis</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="top_100_user_ids.php">Top 100 User IDs with Count</a></li>
            <li class="nav-item"><a class="nav-link" href="login_statistics.php">Login Statistics</a></li>
            <li class="nav-item"><a class="nav-link" href="source_address_statistics.php">Source Address Statistics</a></li>
            <li class="nav-item"><a class="nav-link" href="unauthorized_access.php">Unauthorized Access Attempts</a></li>
            <li class="nav-item"><a class="nav-link" href="http_code_summary.php">HTTP Code Summary</a></li>
            <li class="nav-item"><a class="nav-link" href="unique_sites_visited.php">Unique Sites Visited</a></li>
            <li class="nav-item"><a class="nav-link" href="multiple_src_ip_users.php">Users with Multiple Src IP Addresses</a></li>
            <li class="nav-item"><a class="nav-link" href="request_pattern.php">Request Pattern by 15-Minute Intervals</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="denialsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Denials</a>
                <div class="dropdown-menu" aria-labelledby="denialsDropdown">
                    <a class="dropdown-item" href="tcp_denials.php">TCP</a>
                    <a class="dropdown-item" href="udp_denials.php">UDP</a>
                    <a class="dropdown-item" href="icmp_denials.php">ICMP</a>
                    <a class="dropdown-item" href="destination_port_denials.php">Destination Ports</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="user_logins.php">User Logins</a></li>
            <li class="nav-item"><a class="nav-link" href="total_logins.php">Total Logins</a></li>
        </ul>
    </div>
</nav>


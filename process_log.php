<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['logFile'])) {
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['logFile']['name']);

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($_FILES['logFile']['tmp_name'], $uploadFile)) {
        $statisticsType = $_POST['statisticsType'];

        // Redirect based on statistics type
       switch ($statisticsType) {
    case 'user_logins':
        header('Location: user_logins.php?file=' . urlencode($uploadFile));
        break;
    case 'total_logins':
        header('Location: total_logins.php?file=' . urlencode($uploadFile));
        break;
    case 'http_summary':
        header('Location: http_summary.php?file=' . urlencode($uploadFile));
        break;
    case 'total_hits':
        header('Location: total_hits.php?file=' . urlencode($uploadFile));
        break;
    case 'top_tcp_denials':
        header('Location: top_tcp_denials.php?file=' . urlencode($uploadFile));
        break;
    case 'top_udp_denials':
        header('Location: top_udp_denials.php?file=' . urlencode($uploadFile));
        break;
    case 'top_icmp_denials':
        header('Location: top_icmp_denials.php?file=' . urlencode($uploadFile));
        break;
    case 'top_standard_denials':
        header('Location: top_standard_denials.php?file=' . urlencode($uploadFile));
        break;
    case 'top_denials_8000_9000':
        header('Location: top_denials_8000_9000.php?file=' . urlencode($uploadFile));
        break;
    default:
        echo "Invalid statistics type selected.";
        exit;
}

        exit;
    } else {
        echo "File upload failed!";
    }
}
?>


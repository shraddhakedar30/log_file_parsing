<form action="process_log.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="logFile">Upload Log File</label>
        <input type="file" class="form-control-file" id="logFile" name="logFile">
    </div>
    <div class="form-group">
        <label for="statType">Select Statistics Type</label>
        <select class="form-control" id="statType" name="statType">
            <option value="user_logins">User Logins</option>
            <option value="login_counts">Login Counts</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>

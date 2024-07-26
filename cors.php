<?php
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Allow any origin
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        // Allow specific HTTP methods
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        // Allow specific headers
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    // Terminate the script to avoid further processing
    exit(0);
}

// Your main PHP script starts here
error_log("This is an error message.");

echo json_encode(["message" => "CORS settings applied successfully."]);
?>

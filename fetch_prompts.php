<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

include_once("../includes/config.php");

$response = [
    "status" => "error",
    "message" => "No page selected",
    "data" => []
];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['prompt_type'])) {
    try {
        $prompt_type = $_GET['prompt_type']; // Get prompt_type from the request

        // Prepare and execute the query safely using PDO
        $stmt = $dbp->prepare("SELECT * FROM prompts WHERE prompt_type = :prompt_type");
        $stmt->execute(['prompt_type' => $prompt_type]);

        // Fetch all results as an associative array
        $prompts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($prompts) {
            $response = [
                "status" => "success",
                "prompts" => $prompts
            ];
        } else {
            $response = [
                "status" => "error",
                "message" => "No prompts found for the specified prompt_type."
            ];
        }
    } catch (PDOException $e) {
        $response = ["status" => "error", "message" => "Database query failed: " . $e->getMessage()];
    }
}

// Output JSON response
echo json_encode($response);
?>
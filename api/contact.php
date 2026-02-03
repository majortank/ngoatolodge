<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/SimpleEmailService.php';

// Enable CORS if needed
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // Get and validate form data
    $requiredFields = ['name', 'email', 'checkin', 'checkout'];
    $formData = [];
    
    foreach ($_POST as $key => $value) {
        $formData[$key] = trim(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
    }
    
    // Check required fields
    $missing = [];
    foreach ($requiredFields as $field) {
        if (empty($formData[$field])) {
            $missing[] = ucfirst($field);
        }
    }
    
    if (!empty($missing)) {
        echo json_encode([
            'success' => false, 
            'message' => 'Please fill in all required fields: ' . implode(', ', $missing)
        ]);
        exit;
    }
    
    // Validate email
    if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Please enter a valid email address']);
        exit;
    }
    
    // Validate dates
    $checkin = DateTime::createFromFormat('Y-m-d', $formData['checkin']);
    $checkout = DateTime::createFromFormat('Y-m-d', $formData['checkout']);
    $today = new DateTime();
    
    if (!$checkin || !$checkout) {
        echo json_encode(['success' => false, 'message' => 'Please enter valid dates']);
        exit;
    }
    
    if ($checkin < $today) {
        echo json_encode(['success' => false, 'message' => 'Check-in date cannot be in the past']);
        exit;
    }
    
    if ($checkout <= $checkin) {
        echo json_encode(['success' => false, 'message' => 'Check-out date must be after check-in date']);
        exit;
    }
    
    // Send emails using PHP mail() function
    $emailService = new SimpleEmailService();
    $result = $emailService->sendContactForm($formData);
    
    echo json_encode($result);
    
} catch (Exception $e) {
    error_log("Contact form error: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'An error occurred while processing your request. Please try again or contact us directly.'
    ]);
}
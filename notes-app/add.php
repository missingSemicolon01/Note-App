<?php
// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
 header('Location: index.php');
 exit;
}

// Get form data and sanitize
$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');

// Validate
if (empty($title) || empty($content)) {
 header('Location: index.php');
 exit;
}

// Read existing notes
$notesFile = 'notes.json';
$notes = [];

if (file_exists($notesFile)) {
 $jsonContent = file_get_contents($notesFile);
 $notes = json_decode($jsonContent, true) ?? [];
}

// Create new note
$newNote = [
 'id' => uniqid(),
 'title' => $title,
 'content' => $content,
 'date' => date('Y-m-d H:i:s')
];

// Add to notes array
$notes[] = $newNote;

// Save back to file
file_put_contents($notesFile, json_encode($notes, JSON_PRETTY_PRINT));

// Redirect back to main page
header('Location: index.php');
exit;
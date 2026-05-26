<?php
// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
 header('Location: index.php');
 exit;
}

// Get form data
$noteId = $_POST['id'] ?? '';
$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');

// Validate
if (empty($noteId) || empty($title) || empty($content)) {
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

// Find and update the note
$found = false;
foreach ($notes as &$note) {  // Note the & — reference, so we can modify
 if ($note['id'] === $noteId) {
  $note['title'] = $title;
  $note['content'] = $content;
  $note['date'] = date('Y-m-d H:i:s') . ' (edited)';
  $found = true;
  break;
 }
}
unset($note); // Good practice: break the reference after the loop

// If note wasn't found, redirect anyway
if (!$found) {
 header('Location: index.php');
 exit;
}

// Save updated notes back to file
file_put_contents($notesFile, json_encode($notes, JSON_PRETTY_PRINT));

// Redirect back to main page
header('Location: index.php');
exit;
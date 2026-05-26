<?php
// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
 header('Location: index.php');
 exit;
}

$idToDelete = $_POST['id'] ?? '';

if (empty($idToDelete)) {
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

// Filter out the note to delete
$notes = array_filter($notes, function ($note) use ($idToDelete) {
 return $note['id'] !== $idToDelete;
});

// Re-index the array
$notes = array_values($notes);

// Save back to file
file_put_contents($notesFile, json_encode($notes, JSON_PRETTY_PRINT));

// Redirect back
header('Location: index.php');
exit;

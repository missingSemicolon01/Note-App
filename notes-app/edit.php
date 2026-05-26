<?php
// Get the note ID from URL
$noteId = $_GET['id'] ?? '';

if (empty($noteId)) {
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

// Find the note we want to edit
$noteToEdit = null;
foreach ($notes as $note) {
 if ($note['id'] === $noteId) {
  $noteToEdit = $note;
  break;
 }
}

// If note not found, go back
if ($noteToEdit === null) {
 header('Location: index.php');
 exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>Edit Note</title>
 <link rel="stylesheet" href="style.css">
</head>

<body>
 <div class="container">
  <h1>✏️ Edit Note</h1>

  <form action="update.php" method="POST" class="note-form">
   <!-- Hidden field to know which note to update -->
   <input type="hidden" name="id" value="<?= htmlspecialchars($noteToEdit['id']) ?>">

   <input type="text" name="title" placeholder="Note title..." required maxlength="100"
    value="<?= htmlspecialchars($noteToEdit['title']) ?>">
   <textarea name="content" placeholder="Write your note here..." required rows="4"
    maxlength="500"><?= htmlspecialchars($noteToEdit['content']) ?></textarea>

   <div class="button-group">
    <button type="submit">Save Changes</button>
    <a href="index.php" class="btn-cancel">Cancel</a>
   </div>
  </form>
 </div>
</body>

</html>
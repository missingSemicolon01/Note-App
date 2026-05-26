<?php
// Read existing notes from JSON file
$notesFile = 'notes.json';
$notes = [];

if (file_exists($notesFile)) {
 $jsonContent = file_get_contents($notesFile);
 $notes = json_decode($jsonContent, true) ?? [];
}

// Sort notes by date (newest first)
usort($notes, function ($a, $b) {
 return strtotime($b['date']) - strtotime($a['date']);
});
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>My Notes</title>
 <link rel="stylesheet" href="style.css">
</head>

<body>
 <div class="container">
  <h1>📝 My Notes</h1>

  <!-- Form to add a new note -->
  <form action="add.php" method="POST" class="note-form">
   <input type="text" name="title" placeholder="Note title..." required maxlength="100">
   <textarea name="content" placeholder="Write your note here..." required rows="4" maxlength="500"></textarea>
   <button type="submit">Add Note</button>
  </form>

  <!-- Display all notes -->
  <div class="notes-list">
   <?php if (empty($notes)): ?>
    <p class="empty">No notes yet. Add your first one above!</p>
   <?php else: ?>
    <p class="count">You have
     <?= count($notes) ?> note(s)
    </p>

    <?php foreach ($notes as $note): ?>
     <div class="note">
      <h3>
       <?= htmlspecialchars($note['title']) ?>
      </h3>
      <p>
       <?= nl2br(htmlspecialchars($note['content'])) ?>
      </p>
      <div class="note-footer">
       <small><?= $note['date'] ?></small>
       <div class="actions">
        <a href="edit.php?id=<?= $note['id'] ?>" class="btn-edit">Edit</a>
        <form action="delete.php" method="POST" class="delete-form">
         <input type="hidden" name="id" value="<?= $note['id'] ?>">
         <button type="submit" onclick="return confirm('Delete this note?')">
          Delete
         </button>
        </form>
       </div>
      </div>
     </div>
    <?php endforeach; ?>
   <?php endif; ?>
  </div>
 </div>
</body>

</html>
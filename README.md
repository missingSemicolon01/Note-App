# Note App
 
A small notes app I built while learning PHP. You can add, edit and delete notes, and they are saved in a JSON file.
 
## What it does
 
- Add a new note with a title and some text
- See all your notes on the main page
- Edit a note
- Delete a note
The notes are saved in a file called `notes.json` so they stay there even if you close the browser.
 
## Built with
 
- PHP
- HTML
- CSS
## How to run it
 
You need PHP installed on your computer. Open a terminal in the project folder and run:
 
```bash
php -S localhost:8000
```
 
Then open `http://localhost:8000` in your browser.
 
You can also put the folder inside XAMPP's `htdocs` and open `http://localhost/note-app/`.
 
## Files
 
- `index.php` – main page with the notes
- `add.php` – adds a new note
- `edit.php` – edit form
- `update.php` – saves the changes
- `delete.php` – deletes a note
- `notes.json` – where the notes are saved (gets created automatically)

 

<?php
// File to store participant IDs
$file = 'participants.txt';

// Get the participant ID from the POST request
$participant_id = $_POST['participant_id'];

// Check if the file exists, if not create it
if (!file_exists($file)) {
    file_put_contents($file, '');
}

// Read the contents of the file
$participants = file_get_contents($file);

// Check if the participant ID is in the file
if (strpos($participants, $participant_id) !== false) {
    echo "existing";
} else {
    // If it's a new participant, add them to the file
    file_put_contents($file, $participant_id . "\n", FILE_APPEND);
    echo "new";
}
?>
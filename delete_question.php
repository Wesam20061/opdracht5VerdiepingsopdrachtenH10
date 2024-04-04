<?php
include 'connect.php';

if (isset($_GET['id'])) {
    // Verwijder de vraag
    $stmt = $conn->prepare("DELETE FROM vraag_en_opties WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    echo "Question deleted.";
} else {
    echo "No query specified for deletion.";
}

// Link naar de homepage
echo "<br/><a href='index.php'>Back to homepage</a>";
?>

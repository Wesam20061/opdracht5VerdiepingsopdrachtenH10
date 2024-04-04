<?php
include "connect.php"; // Zorg ervoor dat je verbinding maakt met de database

// Controleer of er een 'id' en 'update' actie is in het verzoek
if (isset($_GET['id']) && !isset($_POST['update'])) {
    $stmt = $conn->prepare("SELECT * FROM vraag_en_opties WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $question = $stmt->fetch();

    if ($question) {
        // Formulier voor het bewerken van de vraag
        ?>
        <form action="edit_question.php" method="post">
            <input type="hidden" name="id" value="<?= $question['id'] ?>">
            Vraag: <input type="text" name="question" value="<?= htmlspecialchars($question['vraag']) ?>" required><br/>
            Antwoord 1: <input type="text" name="answer1" value="<?= htmlspecialchars($question['antwoord1']) ?>" required><br/>
            Antwoord 2: <input type="text" name="answer2" value="<?= htmlspecialchars($question['antwoord2']) ?>" required><br/>
            Antwoord 3: <input type="text" name="answer3" value="<?= htmlspecialchars($question['antwoord3']) ?>" required><br/>
            Antwoord 4: <input type="text" name="answer4" value="<?= htmlspecialchars($question['antwoord4']) ?>" required><br/>
            <input type="submit" name="update" value="Update Question">
        </form>
        <a href="index.php">Terug naar de homepage</a> <!-- Link om terug te gaan naar index.php -->
        <?php
    } else {
        echo "Question not found.";
    }
} elseif (isset($_POST['update'])) {
    // Update de vraag in de database
    $stmt = $conn->prepare("UPDATE vraag_en_opties SET vraag=?, antwoord1=?, antwoord2=?, antwoord3=?, antwoord4=? WHERE id = ?");
    $stmt->execute([$_POST['question'], $_POST['answer1'], $_POST['answer2'], $_POST['answer3'], $_POST['answer4'], $_POST['id']]);
    echo "Question updated. <a href='manage_questions.php'>Back to management</a>";
    echo "<br/><a href='index.php'>Back to homepage</a>";
}


?>

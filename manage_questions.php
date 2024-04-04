<?php
include 'connect.php'; // Zorg ervoor dat je verbinding maakt met de database

if (isset($_POST['addQuestion'])) {
    // Nieuwe vraag toevoegen
    $stmt = $conn->prepare("INSERT INTO vraag_en_opties (vraag, antwoord1, antwoord2, antwoord3, antwoord4) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['question'], $_POST['answer1'], $_POST['answer2'], $_POST['answer3'], $_POST['answer4']]);
    echo "Question added.";
}
?>

<form action="manage_questions.php" method="post">
    Vraag: <input type="text" name="question" required><br/>
    Antwoord 1: <input type="text" name="answer1" required><br/>
    Antwoord 2: <input type="text" name="answer2" required><br/>
    Antwoord 3: <input type="text" name="answer3" required><br/>
    Antwoord 4: <input type="text" name="answer4" required><br/>
    <input type="submit" name="addQuestion" value="Add Question">
</form>

<?php
$stmt = $conn->prepare("SELECT * FROM vraag_en_opties"); // Fix the SQL statement by specifying the correct table name
$stmt->execute();
$questions = $stmt->fetchAll();

foreach ($questions as $question) {
    echo "Question: " . htmlspecialchars($question['vraag']) . "<br/>";
    // Toon hier eventueel de antwoorden
    echo "<a href='edit_question.php?id=" . $question['id'] . "'>Edit</a> | ";
    echo "<a href='delete_question.php?id=" . $question['id'] . "'>Delete</a><br/><br/>";
}
?>

<a href="index.php">Index.php</a>

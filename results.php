<?php
// Include the database connection
include 'connect.php';

// Retrieve all questions from the database
$stmt = $conn->prepare("SELECT * FROM vraag_en_opties");
$stmt->execute();
$questions = $stmt->fetchAll();

// Iterate through each question to display the results
foreach ($questions as $question) {
    echo "<h2>" . htmlspecialchars($question['vraag']) . "</h2>";

    // Initialize total votes for the current question
    $totalVotes = 0;

    // Calculate the total number of votes for this question
    $stmt = $conn->prepare("SELECT SUM(votes) AS totalvotes FROM poll WHERE question_id = ?");
    $stmt->execute([$question['id']]);
    $totalResult = $stmt->fetch();

    if ($totalResult) {
        $totalVotes = $totalResult['totalvotes'];
    }

    // Show each answer option with the number of votes and percentage of the total
    for ($i = 1; $i <= 4; $i++) {
        $answer = $question["antwoord$i"];
        if (!empty($answer)) { // Check if the answer exists
            // Get the number of votes for this specific choice
            $stmt = $conn->prepare("SELECT votes FROM poll WHERE question_id = ? AND choice = ?");
            $stmt->execute([$question['id'], $i]);
            $result = $stmt->fetch();
            $votes = $result ? $result['votes'] : 0;

            // Calculate the percentage of the total
            $percentage = $totalVotes > 0 ? round(($votes / $totalVotes) * 100, 2) : 0;

            // Show the results
            echo htmlspecialchars($answer) . ": " . $votes . " votes (" . $percentage . "%)<br/>";
        }
    }
    echo "<hr/>";
}
?>

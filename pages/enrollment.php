<?php
// registration.php
include '../includes/header.php'; 
require '../database.php';

try {
    $db = new PDO('sqlite:../university.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT 
                s.FirstName || ' ' || s.LastName AS StudentName, 
                COUNT(e.CourseID) AS EnrolledCourses, 
                SUM(c.Credits) AS TotalCredits 
              FROM Student s 
              LEFT JOIN Enrollment e ON s.StudentID = e.StudentID 
              LEFT JOIN Course c ON e.CourseID = c.CourseID 
              GROUP BY s.StudentID, s.FirstName, s.LastName";

    $stmt = $db->query($query);
    $registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <h1>Registration</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Enrolled Courses</th>
                <th>Total Credits</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registrations as $registration): ?>
                <tr>
                    <td><?= htmlspecialchars($registration['StudentName']) ?></td>
                    <td><?= htmlspecialchars($registration['EnrolledCourses']) ?></td>
                    <td><?= htmlspecialchars($registration['TotalCredits']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>


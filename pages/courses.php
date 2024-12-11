<?php
// courses.php
include '../includes/header.php'; 
require '../database.php';

try {
    $db = new PDO('sqlite:../university.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT 
                c.CourseID, 
                c.CourseName, 
                p.FirstName || ' ' || p.LastName AS ProfessorName, 
                d.DepartmentName 
              FROM Course c 
              JOIN Professor p ON c.ProfessorID = p.ProfessorID 
              JOIN Department d ON c.DepartmentID = d.DepartmentID";

    $stmt = $db->query($query);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Courses</title>
</head>
<body>
    <h1>Courses</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Professor</th>
                <th>Department</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?= htmlspecialchars($course['CourseID']) ?></td>
                    <td><?= htmlspecialchars($course['CourseName']) ?></td>
                    <td><?= htmlspecialchars($course['ProfessorName']) ?></td>
                    <td><?= htmlspecialchars($course['DepartmentName']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>


<?php 
include '../includes/header.php'; 

// 连接数据库
$db = new PDO('sqlite:../university.db');

// 查询学生信息
$query = "SELECT FirstName || ' ' || LastName AS StudentName, Major, Email FROM Student";
$students = $db->query($query);
?>

<main>
    <h2>Student Information</h2>
    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Major</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['StudentName']); ?></td>
                    <td><?= htmlspecialchars($student['Major']); ?></td>
                    <td><?= htmlspecialchars($student['Email']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php include '../includes/footer.php'; ?>


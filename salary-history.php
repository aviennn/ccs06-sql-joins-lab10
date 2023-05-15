<?php

require "config.php";

use App\Employee;

// Retrieve the employee number from the query string
if (isset($_GET['emp_no'])) {
    $emp_no = $_GET['emp_no'];
} else {
    die("Employee not specified.");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Salary History</title>
  <style>
    body
    {
        background-color: #080808;
    }

    h1
    {
        color: #D0CDC9;
        text-align: center;
    }

    table 
    {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        margin-left: auto; 
        margin-right: auto;
        width: 70%;
        color: #D0CDC9;
    }

    td 
    {
        text-align: center;
        padding: 8px;
        color: #D0CDC9;
    }

    th 
    {
        background-color: #3A3A3A;
        text-align: center;
        padding: 8px;
        color: #D0CDC9;
    }

    tr:nth-child(even) 
    {
        background-color: #717B7F;
    }

    tr:nth-child(odd) 
    {
        background-color: #9FA4A3;
    }

    a:link, a:visited 
    {
        background-color: #3A3A3A;
        color: white;
        padding: 15px 25px;
        position: relative;
        top: 50px;
        left: 880px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
    }

    a:hover, a:active 
    {
        background-color: #000000;
    }
</style>

</head>
<body>

<?php
    // Retrieve the employee information
    $sql = "SELECT CONCAT(first_name, ' ', last_name) AS employee_name, 
            birth_date, 
            gender, 
            hire_date
            FROM employees
            WHERE emp_no = :emp_no
            LIMIT 1";
    $statement = $conn->prepare($sql);
    $statement->bindValue(':emp_no', $emp_no);
    $statement->execute();
    $employee = $statement->fetch();

    if (!$employee) {
        die("Employee not found.");
    }

    // Display the employee's basic information
    echo "<h1>Salary History for {$employee['employee_name']}</h1>";
    echo "<p>Birthday: {$employee['birth_date']}</p>";
    echo "<p>Gender: {$employee['gender']}</p>";
    echo "<p>Hire Date: {$employee['hire_date']}</p>";

    // Retrieve the employee's salary history
    $sql = "SELECT from_date, 
            to_date, 
            salary
            FROM salaries
            WHERE emp_no = :emp_no
            ORDER BY to_date DESC";
    $statement = $conn->prepare($sql);
    $statement->bindValue(':emp_no', $emp_no);
    $statement->execute();
    $salary_history = $statement->fetchAll();
?>

    <table>
        <tr>
            <th>From Date</th>
            <th>To Date</th>
            <th>Salary</th>
        </tr>
<?php
    foreach ($salary_history as $salary) {
        echo "<tr>";
        echo "<td>{$salary['from_date']}</td>";
        echo "<td>{$salary['to_date']}</td>";
        echo "<td>\${$salary['salary']}</td>";
        echo "</tr>";
    }
 ?>   

   </table>
   <br>
   <br>
    <a href="/employees.php?dept_no=d005">Back to Employees</a>


</body>
</html>
<?php

require "config.php";

use App\Department;
use App\Employee;

$depts = Department::list();
?>

<html>
    <head>


<table>

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

    a:link 
    {
        color: #D0CDC9;
        background-color: transparent;
        text-decoration: none;
    }
    a:visited 
    {
        color: #D0CDC9;
        background-color: transparent;
        text-decoration: none;
    }

    .back, .back:visited, .back:link
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
    </style>
<?php
if (isset($_GET['dept_no'])) {
    $dept_no = $_GET['dept_no'];
    $emps = Employee::listByDepartment($dept_no);
    
?>
    <h1>List of Employees Per Department</h1>
    <br>
    <table>
    <tr>
        <th>Employee Title</th>
        <th>Employee Complete Name</th>
        <th>Birthday</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Hire Date</th>
        <th>Latest Salary</th>
        <th>Link</th>
    </tr>

    <?php foreach ($emps as $emp) {
        echo "<tr>";
        echo "<td>{$emp['employee_title']}</td>";
        echo "<td>{$emp['employee_name']}</td>";
        echo "<td>{$emp['birth_date']}</td>";
        echo "<td>{$emp['employee_age']}</td>";
        echo "<td>{$emp['gender']}</td>";
        echo "<td>{$emp['hire_date']}</td>";
        echo "<td>\${$emp['latest_salary']}</td>";
        echo "<td><a href=\"/salary-history.php?emp_no={$emp['emp_no']}\"><u>View Salary History</u></a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo '<a href="/index.php" class=back>Back to Departments</a>';
}
?>

</body>
</table>
</html>
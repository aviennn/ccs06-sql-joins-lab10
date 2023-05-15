<?php

require "config.php";

use App\Department;
use App\Employee;

$depts = Department::list();
$emps = Employee::listByDepartment('dept_no');
?>

<html>
    <head>

<style>
    body
    {
        background-color: #080808;
    }

    h1
    {
        color: #D0CDC9;
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
</style>
    
    <body>
        <h1><center>List of Departments</center></h1>
        <br>
    <table>
        <tr>
            <th>Department Number</th>
            <th>Department Name</th>
            <th>Manager Name</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Number of Years</th>
            <th>Link</th>
        </tr>

<?php foreach ($depts as $dept) {
    echo "<tr>";
    echo "<td>{$dept['dept_no']}</td>";
    echo "<td>{$dept['dept_name']}</td>";
    echo "<td>{$dept['manager_name']}</td>";
    echo "<td>{$dept['from_date']}</td>";
    echo "<td>{$dept['to_date']}</td>";
    echo "<td>{$dept['num_years']}</td>";
    echo "<td><a href=\"/employees.php?dept_no={$dept['dept_no']}\"><u>View Employees</u></a></td>";
    echo "</tr>";
}?> 

</body>
</table>
</html>
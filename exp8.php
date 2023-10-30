<?php
// XML data
$xmlData = '<?xml version="1.0" encoding="UTF-8"?>
<students>
    <student>
        <name>John</name>
        <marks>
            <subject>
                <name>Math</name>
                <marks>85</marks>
            </subject>
            <subject>
                <name>Science</name>
                <marks>90</marks>
            </subject>
        </marks>
    </student>
    <student>
        <name>Alice</name>
        <marks>
            <subject>
                <name>Math</name>
                <marks>92</marks>
            </subject>
            <subject>
                <name>Science</name>
                <marks>88</marks>
            </subject>
        </marks>
    </student>
</students>';

// Handle AJAX request
if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $studentsXML = new SimpleXMLElement($xmlData);
    $result = null;
    foreach ($studentsXML->student as $student) {
        if ((string)$student->name == $name) {
            $result = $student->marks->asXML();
        }
    }
    
    if ($result) {
        header('Content-Type: text/xml');
        echo $result;
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Marks</title>
</head>
<body>
    <h2>Select a Student:</h2>
    <select id="studentList" onchange="displayStudentMarks()">
        <option value="">Select a student</option>
        <option value="John">John</option>
        <option value="Alice">Alice</option>
    </select>
    <div id="studentMarks"></div>

    <script>
        function displayStudentMarks() {
            const studentName = document.getElementById('studentList').value;
            if (studentName === '') {
                document.getElementById('studentMarks').innerHTML = '';
                return;
            }

            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    displayMarks(this);
                }
            };
            xhttp.open('GET', 'exp8.php?name=' + studentName, true);
            xhttp.send();
        }

        function displayMarks(xml) {
            const xmlDoc = xml.responseXML;
            const marks = xmlDoc.getElementsByTagName('subject');
            let result = '<h2>Student Marks:</h2>';
            for (let i = 0; i < marks.length; i++) {
                const subject = marks[i].getElementsByTagName('name')[0].childNodes[0].nodeValue;
                const mark = marks[i].getElementsByTagName('marks')[0].childNodes[0].nodeValue;
                result += '<p>' + subject + ': ' + mark + '</p>';
            }
            document.getElementById('studentMarks').innerHTML = result;
        }
    </script>
</body>
</html>

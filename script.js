// script.js

document.getElementById("push").addEventListener("click", function() {
    var taskInput = document.getElementById("taskInput").value;
    var dueDateInput = document.getElementById("dueDateInput").value;
    var priorityInput = document.getElementById("priorityInput").value;

    if (taskInput === '') {
        alert("You must write something!");
    } else {
        var tableBody = document.getElementById("taskTableBody");
        var newRow = tableBody.insertRow();

        var taskCell = newRow.insertCell(0);
        var priorityCell = newRow.insertCell(1);
        var dueDateCell = newRow.insertCell(2);

        taskCell.textContent = taskInput;
        priorityCell.textContent = priorityInput;
        dueDateCell.textContent = dueDateInput;

        // Clear input fields after adding task
        document.getElementById("taskInput").value = "";
        document.getElementById("dueDateInput").value = "";
        document.getElementById("priorityInput").value = "";

        // Focus back on task input field
        document.getElementById("taskInput").focus();
    }
});

function toggleTaskCompletion(taskId) {
    var checkbox = document.getElementById('task-' + taskId);
    var completed = checkbox.checked ? 1 : 0; // 1 if checked, 0 if unchecked

    // Send an AJAX request to update the task's completion status
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_task_completion.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response if needed
        }
    };
    xhr.send('task_id=' + taskId + '&completed=' + completed);
}
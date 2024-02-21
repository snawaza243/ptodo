function performAction(select) {
    var action = select.value;
    var taskId = document.getElementById('task-id').value;
    
    // Perform action based on the selected option
    if (action === 'edit') {
        window.location.href = 'update_task.php?task_id=' + taskId-1;
    } else if (action === 'delete') {
        var confirmDelete = confirm('Are you sure you want to delete this task?');
        if (confirmDelete) {
            window.location.href = 'delete_task.php?task_id=' + taskId;
        }
    }
}
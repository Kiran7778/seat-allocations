document.addEventListener('DOMContentLoaded', function() {
    const issueForm = document.querySelector('form');
    const issuesList = document.querySelector('.list-group');
    const notification = document.createElement('div');
    notification.classList.add('notification');

    // Append notification to the container
    document.querySelector('.container').insertBefore(notification, issuesList);

    issueForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(issueForm);
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });

        // Send the data to the server using fetch
        fetch('create_issue.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                // Clear the form
                issueForm.reset();
                // Show success notification
                showNotification('Issue created successfully!', 'success');
                // Add the new issue to the list
                addIssueToList(result.issue);
            } else {
                showNotification('Error creating issue: ' + result.message, 'error');
            }
        })
        .catch(error => {
            showNotification('An error occurred: ' + error.message, 'error');
        });
    });

    function showNotification(message, type) {
        notification.textContent = message;
        notification.className = `notification ${type}`;
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.display = 'none';
        }, 3000);
    }

    function addIssueToList(issue) {
        const listItem = document.createElement('li');
        listItem.classList.add('list-group-item');
        listItem.innerHTML = `
            <h5>${issue.title}</h5>
            <p>${issue.description}</p>
            <small>Status: ${issue.status} | Priority: ${issue.priority} | Assigned to: ${issue.assigned_user}</small>
        `;
        issuesList.prepend(listItem);
    }
});
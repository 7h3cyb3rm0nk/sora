document.addEventListener('DOMContentLoaded', function() {
    const statusForm = document.getElementById('status-form');
    const statusInput = document.getElementById('status-input');
    const currentStatus = document.getElementById('current-status');
    const removeStatusBtn = document.getElementById('remove-status-btn');

    statusForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const newStatus = statusInput.value.trim();
        updateStatus(newStatus);
    });

    removeStatusBtn.addEventListener('click', function(e) {
        e.preventDefault();
        updateStatus('');
    });

    function updateStatus(status) {
        fetch('/update_status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (status === '') {
                    currentStatus.textContent = 'No status set';
                    currentStatus.classList.add('text-gray-500');
                } else {
                    currentStatus.textContent = status;
                    currentStatus.classList.remove('text-gray-500');
                }
                statusInput.value = '';
                updateRemoveButtonVisibility();
            } else {
                alert('Failed to update status. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating status.');
        });
    }

    function updateRemoveButtonVisibility() {
        if (currentStatus.textContent === 'No status set') {
            removeStatusBtn.classList.add('hidden');
        } else {
            removeStatusBtn.classList.remove('hidden');
        }
    }

    // Initial call to set the correct visibility of the remove button
    // updateRemoveButtonVisibility();
});
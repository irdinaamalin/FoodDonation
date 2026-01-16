document.addEventListener("DOMContentLoaded", function () {

    // Notification Dropdown
    const notifyBtn = document.getElementById("notifyToggle");
    const notifyMenu = document.getElementById("notifyMenu");

    if (notifyBtn && notifyMenu) {
        notifyBtn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            notifyMenu.style.display = notifyMenu.style.display === "block" ? "none" : "block";
        });

        document.addEventListener("click", function (e) {
            if (!notifyBtn.contains(e.target) && !notifyMenu.contains(e.target)) {
                notifyMenu.style.display = "none";
            }
        });
    }

    // ===== Notification Switches =====
    const switches = [
        { id: 'notifyClaimed', field: 'notify_claimed' },
        { id: 'notifyWarning', field: 'notify_warning' },
        { id: 'notifyExpiring', field: 'notify_expiring' }
    ];

    switches.forEach(s => {
        const checkbox = document.getElementById(s.id);
        if (checkbox) {
            checkbox.addEventListener('change', function () {
                // Send AJAX request to update user notification
                fetch('/profile/notification', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        field: s.field,
                        value: checkbox.checked ? 1 : 0
                    })
                }).then(res => res.json())
                  .then(data => {
                      console.log(data.message);
                  }).catch(err => console.error(err));
            });
        }
    });

    // ===== Delete Account Confirmation =====
    const deleteBtn = document.getElementById("deleteBtn");
    const confirmBox = document.getElementById("confirmBox");
    const deleteForm = document.getElementById("delete-account-form");
    const cancelBtn = confirmBox.querySelector(".cancel-btn");
    const deleteConfirmBtn = confirmBox.querySelector(".delete-btn");

    deleteBtn.addEventListener("click", function () {
        confirmBox.style.display = "flex";
    });
    cancelBtn.addEventListener("click", function () {
        confirmBox.style.display = "none";
    });
    deleteConfirmBtn.addEventListener("click", function () {
        deleteForm.submit();
    });
    confirmBox.addEventListener("click", function (e) {
        if (e.target === confirmBox) confirmBox.style.display = "none";
    });
});

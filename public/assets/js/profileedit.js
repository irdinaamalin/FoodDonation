// Wait until DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {

    // ===== Delete Account Confirmation =====
    const deleteBtn = document.getElementById("deleteBtn");
    const confirmBox = document.getElementById("confirmBox");
    const cancelBtn = document.getElementById("cancelDelete");
    const confirmDeleteBtn = document.getElementById("confirmDelete");
    const deleteForm = document.getElementById("delete-account-form");

    if (deleteBtn && confirmBox && cancelBtn && confirmDeleteBtn && deleteForm) {

        // Show the confirmation popup
        deleteBtn.addEventListener("click", function () {
            confirmBox.style.display = "flex";
        });

        // Hide the confirmation popup
        cancelBtn.addEventListener("click", function () {
            confirmBox.style.display = "none";
        });

        // Submit the hidden delete form
        confirmDeleteBtn.addEventListener("click", function () {
            deleteForm.submit();
        });

        // Optional: close popup when clicking outside modal content
        confirmBox.addEventListener("click", function (e) {
            if (e.target === confirmBox) {
                confirmBox.style.display = "none";
            }
        });
    }

    // ===== Notification Toggle (if used) =====
    const notifyBtn = document.getElementById("notifyToggle");
    const notifyMenu = document.getElementById("notifyMenu");

    if (notifyBtn && notifyMenu) {
        notifyBtn.addEventListener("click", () => {
            notifyMenu.style.display = notifyMenu.style.display === "block" ? "none" : "block";
        });

        document.addEventListener("click", (e) => {
            if (!notifyBtn.contains(e.target) && !notifyMenu.contains(e.target)) {
                notifyMenu.style.display = "none";
            }
        });
    }

    const uploadBtn = document.getElementById('avatarUploadBtn');
    const avatarInput = document.getElementById('avatarInput');
    const avatarCard = document.querySelector('.profile-avatar-card svg');

    // Open file selector when icon clicked
    uploadBtn.addEventListener('click', () => {
        avatarInput.click();
    });

    // Preview selected image
    avatarInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (event) {
            // Replace SVG with preview image
            avatarCard.outerHTML = `<img src="${event.target.result}" alt="avatar" style="width:200px; height:200px; border-radius:12px;">`;
        }
        reader.readAsDataURL(file);
    });

});

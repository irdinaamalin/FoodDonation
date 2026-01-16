/**
 * FUNGSI UTAMA: Berjalan setiap kali halaman dimuatkan (Reload)
 */
window.addEventListener('load', function() {
    // 1. Kosongkan Search Bar secara paksa (Hard Reset UI)
    const searchInput = document.getElementById("searchInput");
    if (searchInput) {
        searchInput.value = "";
    }

    // 2. Paparkan semua baris jadual (Original State)
    const rows = document.querySelectorAll("#reportTable tbody tr");
    rows.forEach(row => {
        row.style.display = ""; 
    });

    // 3. Pastikan skrol kembali ke atas
    window.scrollTo(0, 0);
});

/**
 * Tampilkan butiran report dalam modal
 */
function showDetails(row) {
    let c = row.getElementsByTagName("td");
    let reportId = row.getAttribute("data-id");
    let reason = row.getAttribute("data-reason");
    let savedComment = row.getAttribute("data-comment") || "";
    let proofUrl = row.getAttribute("data-proof");
    
    const modalBox = document.querySelector('.modal-box');
    
    // Ambil status terus dari teks dalam table (Data dari database)
    let statusRaw = c[9].innerText.trim().toLowerCase().replace('-', ' ');

    // 1. ISI KANDUNGAN MODAL
    document.getElementById("modalContent").innerHTML = `
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 14px; line-height: 1.8;">
            <div><strong>Report ID:</strong> ${c[0].innerText}</div>
            <div><strong>Food:</strong> ${c[1].innerText}</div>
            <div><strong>Category:</strong> ${c[2].innerText}</div>
            <div><strong>Donor:</strong> ${c[3].innerText}</div>
            <div><strong>Recipient:</strong> ${c[4].innerText}</div>
            <div><strong>Quantity:</strong> ${c[5].innerText}</div>
            <div><strong>Expiry:</strong> ${c[6].innerText}</div>
            <div><strong>Location:</strong> ${c[7].innerText}</div>
            <div><strong>Submitted:</strong> ${c[8].innerText}</div>
            <div><strong>Status:</strong> ${c[9].innerHTML}</div>
        </div>
        <div style="margin-top:15px; padding:10px; background:#fff5f5; border-radius:5px; border-left: 4px solid #b21d04;">
            <strong>Reason for Report:</strong> <span style="color:#b21d04;">${reason}</span>
        </div>
    `;

    // 2. IMEJ BUKTI
    let proofDiv = document.getElementById("proofContainer");
    proofDiv.innerHTML = proofUrl 
        ? `<img src="${proofUrl}" style="width: 250px; height: 250px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd; display: block;">`
        : `<p style="color:#888; font-style:italic;">No proof image provided.</p>`;

    // 3. LOGIK ADMIN ACTIONS
    let commentDiv = document.getElementById("commentSection");
    let adminBox = document.getElementById("adminActions");

    // Jika status masih pending atau under review, tunjukkan butang tindakan
    if (statusRaw === "pending" || statusRaw === "under review") {
        commentDiv.innerHTML = `
            <label><strong>Admin Comment:</strong></label>
            <textarea id="adminComment" style="width:100%; height:80px; padding:8px; border-radius:5px; border:1px solid #ccc; font-family:inherit; margin-top:5px;" placeholder="Add feedback here...">${savedComment}</textarea>
        `;
        
        adminBox.innerHTML = `
            <div style="margin-top: 10px;">
                <strong>Admin Actions:</strong><br><br>
                <button class="approve-btn status-update-btn" data-id="${reportId}" data-status="resolved">Approve</button>
                <button class="reject-btn status-update-btn" data-id="${reportId}" data-status="rejected">Reject</button>
                ${statusRaw === 'pending' ? `<button class="under-review-btn status-update-btn" data-id="${reportId}" data-status="under review">Under Review</button>` : ''}
            </div>
        `;
    } else {
        // Jika sudah resolved/rejected, hanya tunjukkan komen tanpa butang
        commentDiv.innerHTML = `
            <div style="background:#f9f9f9; padding:15px; border-left:4px solid #b21d04; border-radius: 4px;">
                <strong>Admin Decision Feedback:</strong><br>
                <p style="margin-top:8px; color: #333;">${savedComment ? savedComment : "This report has been finalized."}</p>
            </div>
        `;
        adminBox.innerHTML = "";
    }

    // 4. BUKA MODAL & RESET SKROL KE ATAS
    document.getElementById("modalBg").style.display = "flex";
    if (modalBox) modalBox.scrollTop = 0;
}

/**
 * EVENT LISTENER: Proses Update Status
 */
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('status-update-btn')) {
        const reportId = e.target.getAttribute('data-id');
        const newStatus = e.target.getAttribute('data-status');
        const commentArea = document.getElementById('adminComment');
        let finalComment = commentArea ? commentArea.value.trim() : "";

        if (confirm(`Confirm change to ${newStatus.toUpperCase()}?\n\nComment: ${finalComment || "No comment provided."}`)) {
            fetch(`/admin/reports/${reportId}/status`, {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json', 
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content 
                },
                body: JSON.stringify({ status: newStatus, comment: finalComment })
            })
            .then(res => res.json())
            .then(data => {
                alert(`Report successfully updated!`);
                // Gunakan URL murni untuk memaksa browser ambil data terbaru dari database
                window.location.href = window.location.origin + window.location.pathname;
            })
            .catch(err => alert("Error updating status. Please try again."));
        }
    }
});

function closeModal() { document.getElementById("modalBg").style.display = "none"; }

function searchTable() {
    let filter = document.getElementById("searchInput").value.toLowerCase();
    let rows = document.querySelectorAll("#reportTable tbody tr");
    rows.forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
    });
}
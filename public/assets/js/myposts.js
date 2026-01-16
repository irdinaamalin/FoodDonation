document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search-input");
    const sortSelect = document.getElementById("sort-select");
    const filterSelect = document.getElementById("filter-select");
    const postsList = document.querySelector(".gs-list");
    const cards = Array.from(document.querySelectorAll(".gs-card"));

    if (!searchInput || !postsList) return;

    function updateDisplay() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const filterValue = filterSelect.value.toUpperCase();

        cards.forEach(card => {
            const title = card.querySelector(".gs-title").innerText.toLowerCase();
            const desc = card.querySelector(".gs-desc").innerText.toLowerCase();
            const status = card.getAttribute("data-status");

            const matchesSearch = title.includes(searchTerm) || desc.includes(searchTerm);
            const matchesFilter = filterValue === "" || status === filterValue;

            card.style.setProperty('display', (matchesSearch && matchesFilter) ? 'flex' : 'none', 'important');
        });
    }

    function sortPosts() {
        const sortValue = sortSelect.value;
        if (!sortValue) return;

        const sortedCards = [...cards].sort((a, b) => {
            if (sortValue === "newest" || sortValue === "oldest") {
                const dateA = new Date(a.getAttribute("data-date"));
                const dateB = new Date(b.getAttribute("data-date"));
                return sortValue === "newest" ? dateB - dateA : dateA - dateB;
            } 
            if (sortValue === "views") {
                const viewsA = parseInt(a.getAttribute("data-pax")) || 0;
                const viewsB = parseInt(b.getAttribute("data-pax")) || 0;
                return viewsB - viewsA;
            }
        });

        postsList.innerHTML = "";
        sortedCards.forEach(card => postsList.appendChild(card));
    }

    searchInput.addEventListener("input", updateDisplay);
    filterSelect.addEventListener("change", updateDisplay);
    sortSelect.addEventListener("change", sortPosts);

    document.querySelectorAll(".see-btn").forEach(btn => {
        btn.addEventListener("click", (e) => {
            const link = btn.getAttribute("href");
            if (!link || link === "#") {
                e.preventDefault();
                alert("Link details tidak dijumpai.");
            }
        });
    });
});
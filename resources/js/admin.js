"use strict";
//ciupons filters
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const statusFilter = document.getElementById("statusFilter");

    function updateSearch() {
        const params = new URLSearchParams(window.location.search);
        params.set("search", searchInput.value);
        if (statusFilter.value !== "") {
            params.set("status", statusFilter.value);
        } else {
            params.delete("status");
        }
        params.delete("page"); // Always reset pagination to first page
        window.location.search = params.toString();
    }

    function updateStatus() {
        const params = new URLSearchParams(window.location.search);
        if (statusFilter.value !== "") {
            params.set("status", statusFilter.value);
        } else {
            params.delete("status");
        }
        if (searchInput.value) {
            params.set("search", searchInput.value);
        } else {
            params.delete("search");
        }
        params.delete("page"); // Always reset pagination to first page
        window.location.search = params.toString();
    }

    searchInput.addEventListener("input", function () {
        clearTimeout(window._searchTimeout);
        window._searchTimeout = setTimeout(updateSearch, 1000);
    });

    statusFilter.addEventListener("change", updateStatus);

    // Pagination: keep filters/search in pagination links
    document.querySelectorAll('.pagination a').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const url = new URL(link.href);
            const params = new URLSearchParams(url.search);
            // Keep current search and status
            if (searchInput.value) params.set('search', searchInput.value);
            else params.delete('search');
            if (statusFilter.value) params.set('status', statusFilter.value);
            else params.delete('status');
            window.location.search = params.toString();
        });
    });
});

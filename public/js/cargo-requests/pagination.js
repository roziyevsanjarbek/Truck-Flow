function renderPagination(data) {

    const footer = document.getElementById("pagination");

    const info = document.getElementById("paginationInfo");

    info.innerHTML = `
            Showing
            <span class="font-semibold text-gray-700">${data.from ?? 0}</span>
            to
            <span class="font-semibold text-gray-700">${data.to ?? 0}</span>
            of
            <span class="font-semibold text-gray-700">${data.total}</span>
            requests
        `;

    let html = "";

    // Previous
    html += `
        <button
            ${data.current_page === 1 ? "disabled" : ""}
            onclick="loadCargoRequests(${data.current_page - 1}, currentFilters)"
            class="w-10 h-10 rounded-lg border ${
        data.current_page === 1
            ? "opacity-50 cursor-not-allowed"
            : "hover:bg-gray-100"
    }">

            ←

        </button>
    `;

    // Pages
    for (let i = 1; i <= data.last_page; i++) {

        html += `
            <button
                onclick="loadCargoRequests(${i}, currentFilters)"
                class="w-10 h-10 rounded-lg ${
            i === data.current_page
                ? "bg-indigo-600 text-white"
                : "border hover:bg-gray-100"
        }">

                ${i}

            </button>
        `;
    }

    // Next
    html += `
        <button
            ${data.current_page === data.last_page ? "disabled" : ""}
            onclick="loadCargoRequests(${data.current_page + 1}, currentFilters)"
            class="w-10 h-10 rounded-lg border ${
        data.current_page === data.last_page
            ? "opacity-50 cursor-not-allowed"
            : "hover:bg-gray-100"
    }">

            →

        </button>
    `;

    footer.innerHTML = html;
}

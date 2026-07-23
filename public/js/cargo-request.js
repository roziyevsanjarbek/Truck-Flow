const API = "/api/drivers/cargo-requests";
let currentFilters = {};
let currentPage = 1;

requireAuth();

const user = getUser();
async function loadCargoRequests(page = 1, filters = {}) {

    currentPage = page;

    const params = new URLSearchParams();

    params.append("page", page);

    Object.entries(filters).forEach(([key, value]) => {

        if (String(value).trim() !== "") {
            params.append(key, value);
        }

    });

    console.log(`${API}?${params.toString()}`);

    const response = await fetch(`${API}?${params.toString()}`, {
        headers: {
            "Authorization": `Bearer ${localStorage.getItem("token")}`,
            "Accept": "application/json"
        }
    });

    if(response.status === 401){
        await logout()
        return
    }

    const result = await response.json();
    console.log(result);

    renderTable(result.data.data);
    renderPagination(result.data);
}

function renderTable(requests) {

    const tbody = document.querySelector("tbody");

    tbody.innerHTML = "";

    requests.forEach(item => {

        const driver = item.driver;

        const cmr = item.files.find(f => f.type === "cmr");
        const passport = item.driver.documents.find(doc => doc.type === "passport");

        let statusColor = "";

        switch (item.status) {
            case "approved":
                statusColor = "bg-green-100 text-green-700";
                break;
            case "rejected":
                statusColor = "bg-red-100 text-red-700";
                break;
            default:
                statusColor = "bg-yellow-100 text-yellow-700";
        }

        tbody.innerHTML += `
        <tr class="hover:bg-gray-50">

            <td class="px-6 py-5">
                <div>
                    <h3 class="font-semibold">
                        ${driver.last_name} ${driver.first_name}
                    </h3>
                    <p class="text-sm text-gray-500">
                        ${driver.phone_number}
                    </p>
                </div>
            </td>

            <td class="px-6 py-5">

            ${
            passport
                ? `
                <a
                    href="/storage/${passport.path}"
                    data-fancybox="passport-${item.id}"
                    data-caption="Passport - ${driver.last_name} ${driver.first_name}"
                    class="inline-flex px-4 py-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100">

                    View Passport

                </a>
                `
                : '-'
        }

            </td>

            <td class="px-6 py-5">
                <p class="font-medium">
                    ${driver.car_number}
                </p>

                <span>
                    ${driver.car_type}
                </span>
            </td>

            <td class="px-6 py-5">
                ${driver.car_volume} m³
            </td>

            <td class="px-6 py-5">
                <div>
                    <p>${item.from_country.name}</p>
                    <small>${item.from_city.name}</small>

                    <div class="my-1">→</div>

                    <p>${item.to_country.name}</p>
                    <small>${item.to_city.name}</small>
                </div>
            </td>

            <td class="px-6 py-5">
                ${item.unloading_date}
            </td>

            <td class="px-6 py-5">

                ${
            cmr
                ? `
                <a
                    href="/storage/${cmr.path}"
                    data-fancybox="cmr-${item.id}"
                    data-caption="CMR Document"
                    class="inline-flex px-4 py-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100">

                    View CMR

                </a>`
                : "-"
        }

            </td>

            <td class="px-6 py-5">

                <span class="px-3 py-1 rounded-full text-xs font-semibold ${statusColor}">
                    ${item.status}
                </span>

            </td>

            <td class="px-6 py-5">
                ${new Date(item.created_at).toLocaleDateString()}
            </td>

      <td class="px-6 py-5">
            <div class="flex justify-center gap-2">

                ${
            item.status === "pending"
                ? `
                            <button
                                onclick="approveCargoRequest(${item.id})"
                                class="w-10 h-10 rounded-lg bg-green-100 text-green-600 hover:bg-green-200"
                                title="Approve">

                                ✓

                            </button>

                            <button
                                onclick="rejectCargoRequest(${item.id})"
                                class="w-10 h-10 rounded-lg bg-red-100 text-red-600 hover:bg-red-200"
                                title="Reject">

                                ✕

                            </button>
                        `
                : item.status === "approved"
                    ? `
                                <button
                                    onclick="showLotteryTicket(${item.id})"
                                    class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200"
                                    title="View Lottery Ticket">

                                    👁

                                </button>
                            `
                    : `
                                <span class="text-xs text-red-500 font-medium">
                                    Request rejected
                                </span>
                            `
        }

            </div>
        </td>
        </tr>
        `;
    });
}

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

async function approveCargoRequest(id) {

    const confirmResult = await Swal.fire({
        title: 'Cargo requestni tasdiqlaysizmi?',
        text: 'Bu amalni keyin bekor qilib bo‘lmaydi.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#16a34a',
        cancelButtonColor: '#ef4444',
        confirmButtonText: 'Ha, tasdiqlash',
        cancelButtonText: 'Bekor qilish'
    });

    if (!confirmResult.isConfirmed) {
        return;
    }

    const response = await fetch(`/api/drivers/cargo-requests/${id}/approve`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${localStorage.getItem("token")}`,
            "Accept": "application/json"
        }
    });


    if(response.status === 401){
        await logout()
        return
    }


    const result = await response.json();

    if (response.ok) {
        Swal.fire({
            icon: 'success',
            title: 'Approved!',
            html: `
        <p>Cargo request approved successfully.</p>
        <p class="mt-2 font-semibold">
            Ticket № <span class="text-green-600">${result.lottery_ticket.ticket_number}</span>
        </p>
    `,
            confirmButtonText: 'OK'
        });
        await loadCargoRequests(currentPage, currentFilters);
        await loadStatistics();
    } else {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: result.message || 'Xatolik yuz berdi',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    }
}
async function rejectCargoRequest(id) {

    const confirmResult = await Swal.fire({
        title: 'Cargo requestni rad qilasizmi?',
        text: 'Bu amalni keyin bekor qilib bo‘lmaydi.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#16a34a',
        confirmButtonText: 'Ha, rad qilish',
        cancelButtonText: 'Bekor qilish'
    });

    if (!confirmResult.isConfirmed) {
        return;
    }

    const response = await fetch(`/api/drivers/cargo-requests/${id}/reject`, {
        method: "POST",
        headers: {
            "Authorization": `Bearer ${localStorage.getItem("token")}`,
            "Accept": "application/json"
        }
    });

    if(response.status === 401){
        await logout()
        return
    }

    const result = await response.json();

    if (response.ok) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Rejected!',
            html: `
        <p>Cargo request rejected successfully.</p>
    `,
            confirmButtonText: 'OK'
        });
        await loadCargoRequests(currentPage, currentFilters);
        await loadStatistics();
        await loadCargoRequests();
    } else {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: result.message || 'Xatolik yuz berdi',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    }
}

async function showLotteryTicket(id) {

    const response = await fetch(`/api/drivers/cargo-requests/${id}/lottery-ticket`, {
        headers: {
            "Authorization": `Bearer ${localStorage.getItem("token")}`,
            "Accept": "application/json"
        }
    });


    if(response.status === 401){
        await logout()
        return
    }


    const result = await response.json();

    if (!response.ok) {
        Swal.fire({
            icon: "error",
            title: result.message || "Xatolik yuz berdi"
        });
        return;
    }

    const ticket = result.data;

    Swal.fire({
        title: '🎟 Lottery Ticket',
        width: 600,
        html: `
            <div class="text-left space-y-4">

                <div>
                    <span style="font-weight:600">Ticket Number</span><br>
                    ${ticket.ticket_number}
                </div>

                <div>
                    <span style="font-weight:600">Status</span><br>
                    ${ticket.status}
                </div>

                <div>
                    <span style="font-weight:600">Created At</span><br>
                    ${new Date(ticket.created_at).toLocaleString()}
                </div>

                <div>
                    <span style="font-weight:600">Won At</span><br>
                    ${ticket.won_at ?? '-'}
                </div>

            </div>
        `,
        confirmButtonText: "Yopish"
    });

}

function searchCargoRequests() {

    console.log("Search bosildi");

    currentFilters = {
        driver_name: document.getElementById("driver_name").value,
        car_number: document.getElementById("car_number").value,
        from_country_id: document.getElementById("from_country_id").value,
        to_country_id: document.getElementById("to_country_id").value,
        status: document.getElementById("status").value,
        unloading_date: document.getElementById("unloading_date").value,
        car_type: document.getElementById("car_type").value,
    };

    loadCargoRequests(1, currentFilters).then(r => { });
}

function resetFilters() {

    document.getElementById("driver_name").value = "";
    document.getElementById("car_number").value = "";
    document.getElementById("from_country_id").value = "";
    document.getElementById("to_country_id").value = "";
    document.getElementById("status").value = "";
    document.getElementById("unloading_date").value = "";
    document.getElementById("car_type").value = "";

    currentFilters = {};

    loadCargoRequests();

}

async function loadStatistics() {
    const response = await fetch("/api/drivers/cargo-requests/statistics", {
        headers: {
            "Authorization": `Bearer ${localStorage.getItem("token")}`,
            "Accept": "application/json"
        }
    });

    if(response.status === 401){
        await logout()
        return
    }

    const result = await response.json();

    if (!response.ok) return;

    // Hammasini 0 qilib olamiz
    let pending = 0;
    let approved = 0;
    let rejected = 0;

    result.data.forEach(item => {

        switch (item.status) {

            case "pending":
                pending = item.total;
                break;

            case "approved":
                approved = item.total;
                break;

            case "rejected":
                rejected = item.total;
                break;
        }

    });

    document.getElementById("pendingCount").textContent = pending;
    document.getElementById("approvedCount").textContent = approved;
    document.getElementById("rejectedCount").textContent = rejected;
    document.getElementById("todayCount").textContent = result.today_requests;
}

Fancybox.bind("[data-fancybox]", {
    Toolbar: {
        display: {
            left: [
                "infobar"
            ],
            middle: [
                "zoomIn",
                "zoomOut",
                "toggle1to1",
                "rotateCCW",
                "rotateCW",
                "flipX",
                "flipY"
            ],
            right: [
                "slideshow",
                "fullscreen",
                "download",
                "thumbs",
                "close"
            ]
        }
    },

    Images: {
        zoom: true
    },

    animated: true,

    dragToClose: false,

    wheel: "zoom",

    keyboard: {
        Escape: "close",
        Delete: false,
        Backspace: false
    }
});


document.querySelectorAll('.user-name').forEach(el => {
    el.textContent = user.name;
});

document.querySelectorAll('.user-email').forEach(el => {
    el.textContent = user.email;
});

document.querySelectorAll('.user-avatar').forEach(el => {
    el.textContent = user.name.charAt(0).toUpperCase();
});

const menuBtn = document.getElementById("userMenuBtn");
const dropdown = document.getElementById("userDropdown");


menuBtn.addEventListener("click", function (e) {
    e.stopPropagation();
    dropdown.classList.toggle("hidden");
});

document.addEventListener("click", function () {
    dropdown.classList.add("hidden");
});

loadCargoRequests().then(r => { });
loadStatistics().then(r => { });


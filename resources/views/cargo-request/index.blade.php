<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargo Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.css"
    />

</head>

<body class="bg-[#F7F8FC]">

<div class="flex min-h-screen">

    <!-- ===================== -->
    <!-- SIDEBAR -->
    <!-- ===================== -->

    <aside class="fixed left-0 top-0 w-64 h-screen bg-white border-r border-gray-200 flex flex-col justify-between z-50">

        <div>

            <!-- Logo -->

            <div class="h-20 px-8 flex items-center border-b">

                <h1 class="text-2xl font-bold">

                    <span class="text-indigo-600">Logi</span>Track

                </h1>

            </div>

            <!-- Menu -->

            <div class="px-5 py-6">

                <p class="text-xs uppercase text-gray-400 font-semibold mb-4">
                    MAIN MENU
                </p>

                <ul class="space-y-2">

                    <li>

                        <a href="#"
                           class="flex items-center justify-between px-4 py-3 rounded-xl bg-indigo-50 text-indigo-600 font-medium">

                            <div class="flex items-center gap-3">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2h6"/>

                                </svg>

                                Cargo Requests

                            </div>


                        </a>

                    </li>

                </ul>


            </div>

        </div>

        <!-- User -->

        <div class="border-t p-5">

            <div class="flex items-center gap-3">

                <div
                    class="w-11 h-11 rounded-full bg-indigo-600 text-white flex items-center justify-center font-semibold">

                    AR

                </div>

                <div>

                    <h4 class="font-semibold text-sm">
                        Alex Rivera
                    </h4>

                    <p class="text-xs text-gray-400">
                        Senior Manager
                    </p>

                </div>

            </div>

        </div>

    </aside>





    <!-- ===================== -->
    <!-- RIGHT SIDE -->
    <!-- ===================== -->

    <div class="flex-1 ml-64 pt-20">

        <!-- Navbar -->

        <header
            class="fixed top-0 left-64 right-0 h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 z-40">

            <!-- Search -->

            <div class="w-[420px]">

                <input
                    type="text"
                    placeholder="Global search..."
                    class="w-full h-11 rounded-xl border border-gray-200 bg-gray-50 px-5 outline-none focus:ring-2 focus:ring-indigo-500">

            </div>

            <!-- Right -->

            <div class="flex items-center gap-6">


                <div class="flex items-center gap-3">

                    <div class="text-right">

                        <h4 class="font-semibold text-sm">

                            Alex Rivera

                        </h4>

                        <p class="text-xs text-gray-400">

                            alex@logitrack.com

                        </p>

                    </div>

                    <div
                        class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-semibold">

                        AR

                    </div>

                </div>

            </div>

        </header>





        <!-- ===================== -->
        <!-- PAGE -->
        <!-- ===================== -->

        <main class="p-8">

            <!-- 2-qism shu yerda boshlanadi -->
            <!-- ========================= -->
            <!-- PAGE HEADER -->
            <!-- ========================= -->

            <div class="flex items-center justify-between mb-8">

                <div>

                    <h1 class="text-3xl font-bold text-gray-800">
                        Cargo Requests
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Manage and review all incoming transportation requests from registered drivers.
                    </p>

                </div>

{{--                <div class="flex items-center gap-3">--}}

{{--                    <button--}}
{{--                        class="w-11 h-11 rounded-xl border bg-white flex items-center justify-center hover:bg-gray-100">--}}

{{--                        🔄--}}

{{--                    </button>--}}

{{--                    <button--}}
{{--                        class="px-6 h-11 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">--}}

{{--                        Export--}}

{{--                    </button>--}}

{{--                </div>--}}

            </div>





            <!-- ========================= -->
            <!-- STATISTIC -->
            <!-- ========================= -->

            <div class="grid grid-cols-4 gap-6 mb-8">

                <!-- Pending -->

                <div class="bg-white rounded-2xl border p-6">

                    <div class="flex justify-between items-center">

                        <div
                            class="w-11 h-11 rounded-xl bg-orange-100 flex items-center justify-center text-orange-500">

                            ⏰

                        </div>

                        <span class="text-orange-500 text-sm font-semibold">
                Waiting
            </span>

                    </div>

                    <p class="text-gray-400 text-sm mt-6">
                        Pending Requests
                    </p>

                    <h2 id="pendingCount" class="text-4xl font-bold mt-2">0</h2>

                </div>



                <!-- Approved -->

                <div class="bg-white rounded-2xl border p-6">

                    <div class="flex justify-between items-center">

                        <div
                            class="w-11 h-11 rounded-xl bg-green-100 flex items-center justify-center text-green-600">

                            ✔

                        </div>


                    </div>

                    <p class="text-gray-400 text-sm mt-6">
                        Approved Requests
                    </p>

                    <h2 id="approvedCount" class="text-4xl font-bold mt-2">0</h2>

                </div>



                <!-- Rejected -->

                <div class="bg-white rounded-2xl border p-6">

                    <div class="flex justify-between items-center">

                        <div
                            class="w-11 h-11 rounded-xl bg-red-100 flex items-center justify-center text-red-500">

                            ✖

                        </div>

                    </div>

                    <p class="text-gray-400 text-sm mt-6">

                        Rejected Requests

                    </p>

                    <h2 id="rejectedCount" class="text-4xl font-bold mt-2">0</h2>

                </div>



                <!-- Today -->

                <div class="bg-white rounded-2xl border p-6">

                    <div class="flex justify-between items-center">

                        <div
                            class="w-11 h-11 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600">

                            📅

                        </div>

                        <span class="text-indigo-500 text-sm font-semibold">

                Today

            </span>

                    </div>

                    <p class="text-gray-400 text-sm mt-6">

                        Today's Requests

                    </p>

                    <h2 id="todayCount" class="text-4xl font-bold mt-2">0</h2>

                </div>

            </div>

            <!-- ================================= -->
            <!-- FILTER SECTION -->
            <!-- ================================= -->

            <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-8">

                <!-- Header -->

                <div class="flex items-center justify-between mb-6">

                    <div>

                        <h2 class="text-xl font-semibold text-gray-800">
                            Search & Filters
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Filter cargo requests by driver, route or status.
                        </p>

                    </div>

                    <button
                        class="text-sm text-indigo-600 font-medium hover:underline">

                        Clear Filters

                    </button>

                </div>



                <!-- Filters -->

                <div class="grid grid-cols-4 gap-5">

                    <!-- Driver -->

                    <div>

                        <label class="text-sm font-medium text-gray-600 mb-2 block">
                            Driver Name
                        </label>

                        <input
                            type="text"
                            id="driver_name"
                            placeholder="Search driver..."
                            class="w-full h-11 rounded-xl border border-gray-300 px-4 focus:ring-2 focus:ring-indigo-500 outline-none">

                    </div>



                    <!-- Vehicle -->

                    <div>

                        <label class="text-sm font-medium text-gray-600 mb-2 block">
                            Vehicle Number
                        </label>

                        <input
                            type="text"
                            id="car_number"
                            placeholder="01A123BC"
                            class="w-full h-11 rounded-xl border border-gray-300 px-4 focus:ring-2 focus:ring-indigo-500 outline-none">

                    </div>



                    <!-- From -->

                    <div>

                        <label class="text-sm font-medium text-gray-600 mb-2 block">
                            Route From
                        </label>

                        <select
                            id="from_country_id"
                            class="w-full h-11 rounded-xl border border-gray-300 px-4 outline-none focus:ring-2 focus:ring-indigo-500">

                            <option value="">All Countries</option>
                            <option value="1">Uzbekistan</option>
                            <option value="2">Kazakhstan</option>

                        </select>

                    </div>



                    <!-- To -->

                    <div>

                        <label class="text-sm font-medium text-gray-600 mb-2 block">
                            Route To
                        </label>

                        <select
                            id="to_country_id"
                            class="w-full h-11 rounded-xl border border-gray-300 px-4 outline-none focus:ring-2 focus:ring-indigo-500">

                            <option value="">All Countries</option>
                            <option value="1">Uzbekistan</option>
                            <option value="2">Kazakhstan</option>
                            <option value="3">Russia</option>

                        </select>

                    </div>



                    <!-- Status -->

                    <div>

                        <label class="text-sm font-medium text-gray-600 mb-2 block">
                            Status
                        </label>

                        <select
                            id="status"
                            class="w-full h-11 rounded-xl border border-gray-300 px-4 outline-none focus:ring-2 focus:ring-indigo-500">

                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>

                        </select>

                    </div>



                    <!-- Date -->

                    <div>

                        <label class="text-sm font-medium text-gray-600 mb-2 block">
                            Unloading Date
                        </label>

                        <input
                            type="date"
                            id="unloading_date"
                            class="w-full h-11 rounded-xl border border-gray-300 px-4 outline-none focus:ring-2 focus:ring-indigo-500">

                    </div>



                    <!-- Cargo Type -->

                    <div>

                        <label class="text-sm font-medium text-gray-600 mb-2 block">
                            Cargo Type
                        </label>

                        <select
                            id="car_type"
                            class="w-full h-11 rounded-xl border border-gray-300 px-4 outline-none focus:ring-2 focus:ring-indigo-500">

                            <option value="">All Types</option>
                            <option value="tent">Tent</option>
                            <option value="ref">Refrigerator</option>

                        </select>

                    </div>



                    <!-- Buttons -->

                    <div class="flex items-end gap-3">

                        <button
                            onclick="resetFilters()"
                            class="w-full h-11 rounded-xl border border-gray-300 hover:bg-gray-100">

                            Reset

                        </button>

                        <button
                            onclick="searchCargoRequests()"
                            class="w-full h-11 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">

                            Search

                        </button>

                    </div>

                </div>

            </div>

            <!-- ================================= -->
            <!-- CARGO REQUEST TABLE -->
            <!-- ================================= -->

            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">

                <!-- Table Header -->

                <div class="flex items-center justify-between px-6 py-5 border-b">

                    <div>

                        <h2 class="text-xl font-semibold text-gray-800">
                            Cargo Request List
                        </h2>

                    </div>

                    <button
                        class="px-4 h-10 rounded-xl border hover:bg-gray-100">

                        Refresh

                    </button>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">

                        <tr class="text-left text-sm text-gray-500">

                            <th class="px-6 py-4 font-medium">Driver</th>

                            <th class="px-6 py-4 font-medium">Passport</th>

                            <th class="px-6 py-4 font-medium">Vehicle</th>

                            <th class="px-6 py-4 font-medium">Vehicle dimensions</th>

                            <th class="px-6 py-4 font-medium">Route</th>

                            <th class="px-6 py-4 font-medium">Unload Date</th>

                            <th class="px-6 py-4 font-medium">CMR</th>

                            <th class="px-6 py-4 font-medium">Status</th>

                            <th class="px-6 py-4 font-medium">Created At</th>

                            <th class="px-6 py-4 font-medium text-center">
                                Action
                            </th>

                        </tr>

                        </thead>

                        <tbody class="divide-y">

                        <!-- ==================== -->
                        <!-- ROW -->
                        <!-- ==================== -->

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">


                                    <div>

                                        <h3 class="font-semibold">

                                            John Smith

                                        </h3>

                                        <p class="text-sm text-gray-500">

                                            +998 90 123 45 67

                                        </p>

                                    </div>

                                </div>

                            </td>

                            <td class="px-6 py-5">

                                <button
                                    onclick="openModal('https://picsum.photos/700/900')"
                                    class="px-4 py-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100">

                                    View Passport

                                </button>

                            </td>

                            <td class="px-6 py-5">

                                <div>

                                    <p class="font-medium">

                                        01A123BC

                                    </p>

                                    <span
                                        class="text-l text-black-500">

                                Tent

                            </span>

                                </div>

                            </td>



                            <td class="px-6 py-5">

                                <div>

                                    <p class="font-medium">

                                        82 M3

                                    </p>

                                </div>

                            </td>

                            <td class="px-6 py-5">

                                <div>

                                    <p class="font-medium">

                                        Tashkent

                                    </p>

                                    <span
                                        class="text-gray-400 text-sm">

                                →

                            </span>

                                    <p class="font-medium">

                                        Moscow

                                    </p>

                                </div>

                            </td>

                            <td class="px-6 py-5">

                                18 Jul 2026

                            </td>

                            <td class="px-6 py-5">

                                <button
                                    onclick="openModal('https://picsum.photos/700/900')"
                                    class="px-4 py-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100">

                                    View CMR

                                </button>

                            </td>

                            <td class="px-6 py-5">

                        <span
                            class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">

                            Pending

                        </span>

                            </td>

                            <td class="px-6 py-5">

                                18 Jul 2026

                            </td>

                            <td class="px-6 py-5">

                                <div class="flex justify-center gap-2">

                                    <button
                                        class="w-10 h-10 rounded-lg bg-green-100 text-green-600 hover:bg-green-200">

                                        ✓

                                    </button>

                                    <button
                                        class="w-10 h-10 rounded-lg bg-red-100 text-red-600 hover:bg-red-200">

                                        ✕

                                    </button>

                                    <button
                                        class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200">

                                        ⋮

                                    </button>

                                </div>

                            </td>

                        </tr>


                        </tbody>

                    </table>

                </div>

            </div>

            <!-- ================================= -->
            <!-- TABLE FOOTER -->
            <!-- ================================= -->

            <div class="bg-white border border-t-0 rounded-b-2xl px-6 py-4 flex items-center justify-between">

                <p id="paginationInfo" class="text-sm text-gray-500"></p>

                <div class="flex items-center gap-2" id="pagination">

                    <button
                        class="w-10 h-10 rounded-lg border hover:bg-gray-100">

                        ←

                    </button>

                    <button
                        class="w-10 h-10 rounded-lg bg-indigo-600 text-white">

                        1

                    </button>

                    <button
                        class="w-10 h-10 rounded-lg border hover:bg-gray-100">

                        2

                    </button>

                    <button
                        class="w-10 h-10 rounded-lg border hover:bg-gray-100">

                        3

                    </button>

                    <button
                        class="w-10 h-10 rounded-lg border hover:bg-gray-100">

                        ...

                    </button>

                    <button
                        class="w-10 h-10 rounded-lg border hover:bg-gray-100">

                        12

                    </button>

                    <button
                        class="w-10 h-10 rounded-lg border hover:bg-gray-100">

                        →

                    </button>

                </div>

            </div>

        </main>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    const API = "/api/drivers/cargo-requests";
    let currentFilters = {};
    let currentPage = 1;

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

        loadCargoRequests(1, currentFilters);
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

    loadCargoRequests();
    loadStatistics();

</script>
</body>
</html>

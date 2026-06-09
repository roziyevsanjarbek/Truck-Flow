<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistics Admin Dashboard - Cargo Requests</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<button class="sidebar-toggle" id="sidebarToggle">
    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<div class="container">
    <!-- Sidebar -->
    <x-sidebar></x-sidebar>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="page-header">
            <div class="header-top">
                <div class="header-title-section">
                    <h1>Cargo Requests</h1>
                    <p>Manage and track all cargo shipment requests across your network</p>
                </div>
                <div class="header-actions">
                    <input type="text" class="search-input" placeholder="Search cargo requests...">
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Table Card -->
            <div class="table-card">
                <div class="table-wrapper">
                    <table>
                        <thead>
                        <tr>
                            <th>Driver Name</th>
                            <th>Phone Number</th>
                            <th>Pickup Location</th>
                            <th>Delivery Location</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
                            <th>CMR Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="cargoRequestsTableBody">
                        <!-- Row 1 -->
                        <tr>
                            <td>Sanjar Roziyev</td>
                            <td>+998 88 629 99 09</td>
                            <td>Tashkent</td>
                            <td>Moscow</td>
                            <td>2026-06-15</td>
                            <td>
                                <span class="status-badge status-pending">Pending</span>
                            </td>
                            <td>
                                <div class="cmr-image" onclick="openModal('SR')">
                                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn-icon-only" title="View">
                                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    <button class="btn-icon-only" title="Edit">
                                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button class="btn-icon-only" title="Delete" style="color: #dc2626;">
                                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
<div id="imageViewer" class="image-viewer">
    <button class="image-close">&times;</button>

    <img id="viewerImage" src="" alt="Passport">
</div>


<!-- Image Preview Modal -->
<div class="modal" id="imageModal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal()">×</button>
        <div class="modal-image" id="modalImageContent">CMR Document Preview</div>
        <div class="modal-title" id="modalTitle">CMR Document</div>
        <div class="modal-info" id="modalInfo">Click to view or download the CMR image</div>
    </div>
</div>

<script>
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        sidebarOverlay.classList.toggle('active');
    });

    sidebarOverlay.addEventListener('click', () => {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
    });

    // Modal functionality
    const imageModal = document.getElementById('imageModal');

    function openModal(initials) {
        const driverData = {
            'SR': { title: 'Sanjar Roziyev - CMR Document', info: 'Shipment to Moscow' },
            'AK': { title: 'Akmal Karimov - CMR Document', info: 'Shipment to Almaty' },
            'JX': { title: 'Javohir Xasanov - CMR Document', info: 'Shipment to Warsaw' }
        };

        const data = driverData[initials];
        document.getElementById('modalTitle').textContent = data.title;
        document.getElementById('modalInfo').textContent = data.info;
        imageModal.classList.add('active');
    }

    function closeModal() {
        imageModal.classList.remove('active');
    }

    // Close modal when clicking outside
    imageModal.addEventListener('click', (e) => {
        if (e.target === imageModal) {
            closeModal();
        }
    });

    async function loadCargoRequests() {
        try {

            const response = await fetch('/api/drivers/cargo-requests', {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const result = await response.json();

            const tbody = document.getElementById('cargoRequestsTableBody');

            tbody.innerHTML = '';

            result.data.forEach(item => {

                const cmr = item.files.find(
                    file => file.type === 'cmr'
                );

                const cmrImage = cmr
                    ? `/storage/${cmr.path}`
                    : '';

                const statusClass = {
                    pending: 'status-pending',
                    active: 'status-in-transit',
                    delivered: 'status-delivered'
                };

                tbody.insertAdjacentHTML('beforeend', `
                <tr>

                    <td>
                        ${item.driver?.last_name ?? ''}
                        ${item.driver?.first_name ?? ''}
                        ${item.driver?.middle_name ?? ''}
                    </td>

                    <td>
                        ${item.driver?.phone_number ?? '-'}
                    </td>

                    <td>
                        ${item.from_country?.name ?? '-'},
                        ${item.from_city?.name ?? '-'}
                    </td>

                    <td>
                        ${item.to_country?.name ?? '-'},
                        ${item.to_city?.name ?? '-'}
                    </td>

                    <td>
                        ${item.unloading_date ?? '-'}
                    </td>

                    <td>
                        <span class="status-badge ${statusClass[item.status] ?? 'status-pending'}">
                            ${item.status}
                        </span>
                    </td>

                    <td>
                        ${
                    cmr
                        ? `
                                <button
                                    class="document-btn"
                                    data-image="${cmrImage}">
                                    📄 CMR
                                </button>
                              `
                        : '-'
                }
                    </td>

                    <td>
                        <div class="table-actions">

                            <button
                                class="btn-approve"
                                data-id="${item.id}">
                                ✓ Approve
                            </button>

                            <button
                                class="btn-reject"
                                data-id="${item.id}">
                                ✕ Reject
                            </button>

                        </div>
                    </td>

                </tr>
            `);
            });

        } catch (error) {

            console.error(error);

            document.getElementById('cargoRequestsTableBody').innerHTML = `
            <tr>
                <td colspan="8" style="text-align:center">
                    Cargo requestlarni yuklashda xatolik yuz berdi
                </td>
            </tr>
        `;
        }
    }

    loadCargoRequests();

    document.addEventListener('click', function(e){

        const btn = e.target.closest('.document-btn');

        if(!btn) return;

        document.getElementById('viewerImage').src =
            btn.dataset.image;

        document.getElementById('imageViewer')
            .classList.add('show');
    });
    document.querySelector('.image-close')
        .addEventListener('click', () => {

            document.getElementById('imageViewer')
                .classList.remove('show');
        });

    document.getElementById('imageViewer')
        .addEventListener('click', function(e){

            if(e.target.id === 'imageViewer'){
                this.classList.remove('show');
            }
        });
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistics Admin Dashboard - Drivers</title>
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
    <x-sidebar></x-sidebar>
    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="page-header">
            <div class="header-top">
                <div class="header-title-section">
                    <h1>Drivers</h1>
                    <p>Manage and monitor all active drivers in your logistics network</p>
                </div>
                <div class="header-actions">
                    <input type="text" class="search-input" placeholder="Search drivers...">

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
                            <th>Passport Photo</th>
                            <th>Vehicle Number</th>
                            <th>Vehicle Type</th>
                            <th>Vehicle Volume</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="driversTableBody">
                        <!-- Row 1 -->
                        <tr>
                            <td>
                                <div class="driver-name">Sanjar Roziyev</div>
                                <div class="driver-phone">Driver ID: DRV001</div>
                            </td>
                            <td>+998 88 629 99 09</td>
                            <td>
                                <div class="avatar avatar-1">SR</div>
                            </td>
                            <td>01A123BC</td>
                            <td>Truck</td>
                            <td>86 m³</td>
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

<!-- View Driver Modal -->
<div id="driverModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>

        <h2>Driver Information</h2>

        <div class="driver-details">
            <div class="passport-preview">
                <img id="modalPassportImage" src="" alt="Passport">
            </div>

            <div class="detail-item">
                <strong>Full Name:</strong>
                <span id="modalName"></span>
            </div>

            <div class="detail-item">
                <strong>Phone:</strong>
                <span id="modalPhone"></span>
            </div>

            <div class="detail-item">
                <strong>Vehicle Number:</strong>
                <span id="modalCarNumber"></span>
            </div>

            <div class="detail-item">
                <strong>Vehicle Type:</strong>
                <span id="modalCarType"></span>
            </div>

            <div class="detail-item">
                <strong>Vehicle Volume:</strong>
                <span id="modalCarVolume"></span>
            </div>

            <div class="detail-item">
                <strong>Status:</strong>
                <span id="modalStatus"></span>
            </div>
        </div>
    </div>
</div>
<div id="deleteModal" class="modal">
    <div class="modal-content delete-modal">
        <h3>Delete Driver</h3>

        <p>
            Are you sure you want to delete this driver?
        </p>

        <div class="delete-actions">
            <button id="cancelDelete" class="btn-cancel">
                No
            </button>

            <button id="confirmDelete" class="btn-delete">
                Yes, Delete
            </button>
        </div>
    </div>
</div>
<script>
    // Mobile sidebar toggle
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

    // Close sidebar when clicking a nav link
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
        });
    });

        async function loadDrivers() {
        try {
            const response = await fetch('/api/drivers', {
                headers: {
                    'Accept': 'application/json'
                }
            });
        const result = await response.json();

        const tbody = document.getElementById('driversTableBody');
        tbody.innerHTML = '';

        result.data.forEach(driver => {

        const passport = driver.documents.find(
        doc => doc.type === 'passport'
        );

        const passportImage = passport
        ? `/storage/${passport.path}`
        : 'https://via.placeholder.com/60x60?text=No+Photo';

        const row = `
                    <tr>
                        <td>
                            <div class="driver-name">
                                ${driver.last_name} ${driver.first_name}
                            </div>
                            <div class="driver-phone">
                                ID: ${driver.id}
                            </div>
                        </td>

                        <td>${driver.phone_number ?? '-'}</td>

                     <td>
                        <button
                            class="document-btn"
                            data-image="${passportImage}"
                            title="Passport ko'rish"
                        >
                            📄 Passport
                        </button>
                    </td>

                        <td>${driver.car_number ?? '-'}</td>

                        <td>
                            ${driver.car_type ?? '-'}
                        </td>

                        <td>
                            ${driver.car_volume ?? '-'}
                        </td>

                        <td>
                            <div class="table-actions">

                                <button
                                    class="btn-icon-only view-driver"
                                    data-name="${driver.last_name} ${driver.first_name}"
                                    data-phone="${driver.phone_number}"
                                    data-car-number="${driver.car_number}"
                                    data-car-type="${driver.car_type}"
                                    data-car-volume="${driver.car_volume}"
                                    data-status="${driver.status}"
                                    data-image="${passportImage}"
                                >
                                    👁
                                </button>

                                <button
                                    class="btn-icon-only delete-driver"
                                    data-id="${driver.id}"
                                    title="Delete"
                                    style="color:#dc2626;"
                                >
                                    🗑
                                </button>

                            </div>
                        </td>
                    </tr>
                `;

        tbody.insertAdjacentHTML('beforeend', row);
    });

    } catch (error) {
        console.error(error);

        document.getElementById('driversTableBody').innerHTML = `
                <tr>
                    <td colspan="7" style="text-align:center;">
                        Driverlarni yuklashda xatolik yuz berdi
                    </td>
                </tr>
            `;
    }
    }

        loadDrivers();

    function openDriverModal(data) {

        document.getElementById('modalName').textContent =
            data.name || '-';

        document.getElementById('modalPhone').textContent =
            data.phone || '-';

        document.getElementById('modalCarNumber').textContent =
            data.carNumber || '-';

        document.getElementById('modalCarType').textContent =
            data.carType || '-';

        document.getElementById('modalCarVolume').textContent =
            data.carVolume || '-';

        document.getElementById('modalStatus').textContent =
            data.status || '-';

        document.getElementById('modalPassportImage').src =
            data.image;

        document.getElementById('driverModal')
            .classList.add('show');
    }

    document.addEventListener('click', function(e){

        if(
            e.target.classList.contains('view-driver') ||
            e.target.classList.contains('passport-image')
        ){

            openDriverModal({
                name: e.target.dataset.name,
                phone: e.target.dataset.phone,
                carNumber: e.target.dataset.carNumber,
                carType: e.target.dataset.carType,
                carVolume: e.target.dataset.carVolume,
                status: e.target.dataset.status,
                image: e.target.dataset.image
            });
        }
    });

    document.querySelector('.close-modal')
        .addEventListener('click', () => {
            document
                .getElementById('driverModal')
                .classList.remove('show');
        });

    document.getElementById('driverModal')
        .addEventListener('click', (e) => {

            if(e.target.id === 'driverModal'){
                e.target.classList.remove('show');
            }
        });
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

    let selectedDriverId = null;

    document.addEventListener('click', function (e) {

        const deleteBtn = e.target.closest('.delete-driver');

        if (!deleteBtn) return;

        selectedDriverId = deleteBtn.dataset.id;

        document
            .getElementById('deleteModal')
            .classList.add('show');
    });

    document
        .getElementById('cancelDelete')
        .addEventListener('click', () => {

            document
                .getElementById('deleteModal')
                .classList.remove('show');

            selectedDriverId = null;
        });

    document
        .getElementById('confirmDelete')
        .addEventListener('click', async () => {

            if (!selectedDriverId) return;

            try {

                const response = await fetch(
                    `/api/drivers/${selectedDriverId}`,
                    {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json'
                        }
                    }
                );

                if (!response.ok) {
                    throw new Error('Delete failed');
                }

                document
                    .getElementById('deleteModal')
                    .classList.remove('show');

                selectedDriverId = null;

                loadDrivers();

            } catch (error) {

                alert('Driverni o‘chirishda xatolik yuz berdi');

                console.error(error);
            }
        });

    document
        .getElementById('deleteModal')
        .addEventListener('click', function(e){

            if(e.target.id === 'deleteModal'){
                this.classList.remove('show');
            }
        });


</script>
</body>
</html>

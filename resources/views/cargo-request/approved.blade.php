<x-header></x-header>
<div class="bg-[#F7F8FC]">

    <div class="flex min-h-screen">

        <!-- ===================== -->
        <!-- SIDEBAR -->
        <!-- ===================== -->
        <x-sidebar></x-sidebar>

        <!-- ===================== -->
        <!-- RIGHT SIDE -->
        <!-- ===================== -->

        <div class="flex-1 ml-64 pt-20">

            <!-- Navbar -->

            <x-navbar></x-navbar>

            <!-- ===================== -->
            <!-- PAGE -->
            <!-- ===================== -->

            <main class="p-8">

                <!-- ========================= -->
                <!-- PAGE HEADER -->
                <!-- ========================= -->

                <div class="flex items-center justify-between mb-8">

                    <div>

                        <h1 class="text-3xl font-bold text-gray-800">
                            Approved Cargo Requests
                        </h1>

                        <p class="text-gray-500 mt-1">
                            Manage and review all approved transportation requests from registered drivers.
                        </p>

                    </div>


                </div>
                <!-- ================================= -->
                <!-- FILTER SECTION -->
                <!-- ================================= -->

                <x-cargo-request.search-section></x-cargo-request.search-section>

                <!-- ================================= -->
                <!-- CARGO REQUEST TABLE -->
                <!-- ================================= -->

                <x-cargo-request.table-section></x-cargo-request.table-section>

                <!-- ================================= -->
                <!-- TABLE FOOTER -->
                <!-- ================================= -->

                <x-cargo-request.table-footer-section></x-cargo-request.table-footer-section>
            </main>

        </div>
    </div>
</div>
<script>
    const DEFAULT_FILTERS = {
        status: 'approved'
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/auth.js') }}"></script>

<script src="{{ asset('js/api.js') }}"></script>
<script src="{{ asset('js/cargo-requests/table.js') }}"></script>
<script src="{{ asset('js/cargo-requests/pagination.js') }}"></script>
<script src="{{ asset('js/cargo-requests/actions.js') }}"></script>
<script src="{{ asset('js/cargo-requests/filters.js') }}"></script>
<script src="{{ asset('js/layout.js') }}"></script>


<script src="{{ asset('js/cargo-requests/cargo-request.js') }}"></script>
<x-footer></x-footer>

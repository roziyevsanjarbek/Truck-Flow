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
                            Dashboard
                        </h1>

                        <p class="text-gray-500 mt-1">
                            Welcome to your dashboard! Here you can manage and review all incoming transportation requests from registered drivers.
                        </p>

                    </div>


                </div>

                <!-- ========================= -->
                <!-- STATISTIC -->
                <!-- ========================= -->

                <x-cargo-request.statistik-section></x-cargo-request.statistik-section>

            </main>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/auth.js') }}"></script>
<script src="{{ asset('js/cargo-requests/statistics.js') }}"></script>
<script src="{{ asset('js/layout.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
<x-footer></x-footer>

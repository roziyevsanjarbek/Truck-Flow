<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">

    <!-- Requests Overview -->
    <div class="xl:col-span-2 bg-white rounded-2xl border border-gray-200 p-6">

        <div class="mb-6">

            <h2 class="text-lg font-semibold text-gray-800">
                Requests Overview
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Overview of requests over the last 7 days
            </p>

        </div>

        <div class="h-80">
            <canvas id="requestsOverviewChart"></canvas>
        </div>

    </div>

    <!-- Requests by Status -->
    <!-- Requests by Status -->
    <div class="bg-white rounded-2xl border border-gray-200 p-6">

        <div class="mb-6">

            <h2 class="text-lg font-semibold text-gray-800">
                Requests by Status
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Distribution of all requests
            </p>

        </div>

        <div class="flex h-80">

            <!-- Chart -->
            <div class="w-2/3 relative h-72">
                <canvas id="statusChart"></canvas>
            </div>

            <!-- Legend -->
            <div class="w-1/3 flex items-center">

                <div class="space-y-5 w-full">

                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-orange-500"></span>
                            <span class="text-sm text-gray-600">Pending</span>
                        </div>

                        <span id="pendingValue" class="font-semibold">0</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-green-500"></span>
                            <span class="text-sm text-gray-600">Approved</span>
                        </div>

                        <span id="approvedValue" class="font-semibold">0</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-red-500"></span>
                            <span class="text-sm text-gray-600">Rejected</span>
                        </div>

                        <span id="rejectedValue" class="font-semibold">0</span>
                    </div>

                    <hr class="border-gray-200">

                    <div class="flex justify-between items-center font-semibold">
                        <span>Total</span>
                        <span id="totalValue">0</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


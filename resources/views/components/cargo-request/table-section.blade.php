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

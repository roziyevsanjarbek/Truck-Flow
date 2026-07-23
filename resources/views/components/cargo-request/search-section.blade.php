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

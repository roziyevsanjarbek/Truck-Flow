<header
    class="fixed top-0 left-64 right-0 h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8 z-40">

    <!-- Search -->

    <div class="w-105">

{{--        <input--}}
{{--            type="text"--}}
{{--            placeholder="Global search..."--}}
{{--            class="w-full h-11 rounded-xl border border-gray-200 bg-gray-50 px-5 outline-none focus:ring-2 focus:ring-indigo-500">--}}

    </div>

    <!-- Right -->

    <div class="relative">

        <button
            id="userMenuBtn"
            class="flex items-center gap-3 rounded-xl px-2 py-2 hover:bg-gray-100 transition">

            <div class="text-right">

                <h4 class="font-semibold text-sm">
                    <span class="user-name">Alex Rivera</span>
                </h4>

                <p class="text-xs text-gray-400">
                    <span class="user-email">alex@logitrack.com</span>
                </p>

            </div>

            <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-semibold">
                <span class="user-avatar">AR</span>
            </div>

            <i class="fa-solid fa-chevron-down text-xs text-gray-400"></i>

        </button>

        <!-- Dropdown -->
        <div
            id="userDropdown"
            class="hidden absolute right-0 mt-3 w-60 rounded-2xl bg-white shadow-xl border border-gray-100 overflow-hidden">

            <div class="px-5 py-4 border-b">

                <h4 class="font-semibold user-name">
                    Alex Rivera
                </h4>

                <p class="text-sm text-gray-500 user-email">
                    alex@logitrack.com
                </p>

            </div>

            <button
                onclick="logout()"
                class="w-full flex items-center gap-3 px-5 py-4 text-red-600 hover:bg-red-50 transition">

                <i class="fa-solid fa-right-from-bracket"></i>

                Logout

            </button>

        </div>

    </div>

</header>


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

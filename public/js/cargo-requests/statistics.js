async function loadStatistics() {
    const response = await fetch("/api/drivers/cargo-requests/statistics", {
        headers: {
            "Authorization": `Bearer ${localStorage.getItem("token")}`,
            "Accept": "application/json"
        }
    });

    if(response.status === 401){
        await logout()
        return
    }

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

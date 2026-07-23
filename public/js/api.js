const API = "/api/drivers/cargo-requests";
let currentFilters = {
    ...(typeof DEFAULT_FILTERS !== "undefined" ? DEFAULT_FILTERS : {})
};
let currentPage = 1;

async function loadCargoRequests(page = 1, filters = {}) {

    currentPage = page;

    const params = new URLSearchParams();

    params.append("page", page);

    Object.entries(filters).forEach(([key, value]) => {

        if (String(value).trim() !== "") {
            params.append(key, value);
        }

    });

    console.log(`${API}?${params.toString()}`);

    const response = await fetch(`${API}?${params.toString()}`, {
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
    console.log(result);

    renderTable(result.data.data);
    renderPagination(result.data);
}

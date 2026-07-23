function searchCargoRequests() {

    console.log("Search bosildi");

    currentFilters = {
        driver_name: document.getElementById("driver_name").value,
        car_number: document.getElementById("car_number").value,
        from_country_id: document.getElementById("from_country_id").value,
        to_country_id: document.getElementById("to_country_id").value,
        status: document.getElementById("status").value,
        unloading_date: document.getElementById("unloading_date").value,
        car_type: document.getElementById("car_type").value,
    };

    loadCargoRequests(1, currentFilters).then(r => { });
}

function resetFilters() {

    document.getElementById("driver_name").value = "";
    document.getElementById("car_number").value = "";
    document.getElementById("from_country_id").value = "";
    document.getElementById("to_country_id").value = "";
    document.getElementById("status").value = "";
    document.getElementById("unloading_date").value = "";
    document.getElementById("car_type").value = "";

    currentFilters = {};

    loadCargoRequests();

}

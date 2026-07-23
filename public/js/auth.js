const token = localStorage.getItem("token");

function requireAuth() {
    const token = localStorage.getItem("token");
    const user = localStorage.getItem("user");

    if (!token || !user) {
        localStorage.clear();
        window.location.replace("/");
        return false;
    }

    return true;
}

function getUser() {
    return JSON.parse(localStorage.getItem("user"));
}

async function logout() {
    const token = localStorage.getItem("token");

    try {
        await fetch("/api/logout", {
            method: "POST",
            headers: {
                "Authorization": `Bearer ${token}`,
                "Accept": "application/json"
            }
        });
    } catch (e) {
        console.error(e);
    }

    localStorage.clear();
    window.location.replace("/");
}

requireAuth();

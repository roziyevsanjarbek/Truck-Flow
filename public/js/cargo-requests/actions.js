async function approveCargoRequest(id) {

    const confirmResult = await Swal.fire({
        title: 'Cargo requestni tasdiqlaysizmi?',
        text: 'Bu amalni keyin bekor qilib bo‘lmaydi.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#16a34a',
        cancelButtonColor: '#ef4444',
        confirmButtonText: 'Ha, tasdiqlash',
        cancelButtonText: 'Bekor qilish'
    });

    if (!confirmResult.isConfirmed) {
        return;
    }

    const response = await fetch(`/api/drivers/cargo-requests/${id}/approve`, {
        method: "POST",
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

    if (response.ok) {
        Swal.fire({
            icon: 'success',
            title: 'Approved!',
            html: `
        <p>Cargo request approved successfully.</p>
        <p class="mt-2 font-semibold">
            Ticket № <span class="text-green-600">${result.lottery_ticket.ticket_number}</span>
        </p>
    `,
            confirmButtonText: 'OK'
        });
        await loadCargoRequests(currentPage, currentFilters);
        await loadStatistics();
    } else {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: result.message || 'Xatolik yuz berdi',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    }
}

async function rejectCargoRequest(id) {

    const confirmResult = await Swal.fire({
        title: 'Cargo requestni rad qilasizmi?',
        text: 'Bu amalni keyin bekor qilib bo‘lmaydi.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#16a34a',
        confirmButtonText: 'Ha, rad qilish',
        cancelButtonText: 'Bekor qilish'
    });

    if (!confirmResult.isConfirmed) {
        return;
    }

    const response = await fetch(`/api/drivers/cargo-requests/${id}/reject`, {
        method: "POST",
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

    if (response.ok) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Rejected!',
            html: `
        <p>Cargo request rejected successfully.</p>
    `,
            confirmButtonText: 'OK'
        });
        await loadCargoRequests(currentPage, currentFilters);
        await loadStatistics();
        await loadCargoRequests();
    } else {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: result.message || 'Xatolik yuz berdi',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    }
}

async function showLotteryTicket(id) {

    const response = await fetch(`/api/drivers/cargo-requests/${id}/lottery-ticket`, {
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

    if (!response.ok) {
        Swal.fire({
            icon: "error",
            title: result.message || "Xatolik yuz berdi"
        });
        return;
    }

    const ticket = result.data;

    Swal.fire({
        title: '🎟 Lottery Ticket',
        width: 600,
        html: `
            <div class="text-left space-y-4">

                <div>
                    <span style="font-weight:600">Ticket Number</span><br>
                    ${ticket.ticket_number}
                </div>

                <div>
                    <span style="font-weight:600">Status</span><br>
                    ${ticket.status}
                </div>

                <div>
                    <span style="font-weight:600">Created At</span><br>
                    ${new Date(ticket.created_at).toLocaleString()}
                </div>

                <div>
                    <span style="font-weight:600">Won At</span><br>
                    ${ticket.won_at ?? '-'}
                </div>

            </div>
        `,
        confirmButtonText: "Yopish"
    });

}



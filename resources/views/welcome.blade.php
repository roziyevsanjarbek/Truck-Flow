<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TruckFlow Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:Inter,sans-serif;
    }

    body{
        background:#f5f7fb;
    }

    .layout{
        display:flex;
    }

    .sidebar{
        width:260px;
        height:100vh;
        background:white;
        border-right:1px solid #eee;
        padding:24px;
    }

    .logo{
        font-size:24px;
        font-weight:700;
        margin-bottom:40px;
    }

    .menu{
        list-style:none;
    }

    .menu li{
        padding:14px;
        border-radius:10px;
        margin-bottom:6px;
        cursor:pointer;
    }

    .menu li.active{
        background:#2563eb;
        color:white;
    }

    .content{
        flex:1;
        padding:30px;
    }

    .topbar{
        display:flex;
        justify-content:space-between;
        margin-bottom:30px;
    }

    .topbar input{
        width:350px;
        padding:12px;
        border:1px solid #ddd;
        border-radius:10px;
    }

    .topbar button{
        background:#2563eb;
        color:white;
        border:none;
        padding:12px 20px;
        border-radius:10px;
    }

    .cards{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:20px;
        margin-top:20px;
    }

    .card{
        background:white;
        padding:25px;
        border-radius:16px;
        box-shadow:0 2px 10px rgba(0,0,0,.05);
    }

    .table-card{
        background:white;
        margin-top:30px;
        border-radius:16px;
        padding:25px;
    }

    table{
        width:100%;
        border-collapse:collapse;
    }

    th,td{
        text-align:left;
        padding:16px;
    }

    .badge{
        padding:6px 12px;
        border-radius:999px;
        font-size:13px;
    }

    .success{
        background:#dcfce7;
        color:#166534;
    }

    .pending{
        background:#fef3c7;
        color:#92400e;
    }
    .table-card table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-card th {
        text-align: left;
        padding: 18px;
        font-weight: 600;
        color: #64748b;
        border-bottom: 2px solid #e2e8f0;
    }

    .table-card td {
        padding: 18px;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-card tbody tr:hover {
        background: #f8fafc;
    }
</style>
<body>

<div class="layout">

    <aside class="sidebar">
        <div class="logo">
            🚛 TruckFlow
        </div>

        <ul class="menu">
            <li class="active">Dashboard</li>
            <li>Drivers</li>
            <li>Cargo Requests</li>
            <li>Documents</li>
            <li>Countries</li>
            <li>Cities</li>
            <li>Settings</li>
        </ul>
    </aside>

    <main class="content">

        <header class="topbar">
            <input type="text" placeholder="Search...">
            <button>+ New Request</button>
        </header>

        <h1>Logistics Overview</h1>

        <div class="cards">

            <div class="card">
                <h4>Total Drivers</h4>
                <h2>1,284</h2>
            </div>

            <div class="card">
                <h4>Pending Requests</h4>
                <h2>42</h2>
            </div>

            <div class="card">
                <h4>Approved</h4>
                <h2>3,105</h2>
            </div>

            <div class="card">
                <h4>Rejected</h4>
                <h2>118</h2>
            </div>

        </div>

        <div class="table-card">

            <div class="table-header">
                <h3>Recent Cargo Requests</h3>
            </div>

            <table>

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Driver</th>
                    <th>Route</th>
                    <th>Status</th>
                </tr>
                </thead>

                <tbody>

                <tr>
                    <td>#CR-9021</td>
                    <td>John Doe</td>
                    <td>Berlin → Paris</td>
                    <td>
                            <span class="badge success">
                                Approved
                            </span>
                    </td>
                </tr>

                <tr>
                    <td>#CR-9022</td>
                    <td>Ali Valiyev</td>
                    <td>Toshkent → Moskva</td>
                    <td>
                            <span class="badge pending">
                                Pending
                            </span>
                    </td>
                </tr>

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔥 Rental PS GACOR KANG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* MODE GELAP TAPI TEKS TERANG (HIGH CONTRAST) */
        :root { --bg-dark: #0f172a; --card-bg: #1e293b; --accent: #3b82f6; --success: #10b981; --danger: #ef4444; --text-main: #ffffff; }
        body { background-color: var(--bg-dark); color: var(--text-main); font-family: 'Roboto', sans-serif; padding-bottom: 50px; }
        .brand-font { font-family: 'Rajdhani', sans-serif; text-transform: uppercase; letter-spacing: 1px; }
        .card { background-color: var(--card-bg); border: 1px solid #64748b; border-radius: 12px; margin-bottom: 20px; }
        /* Form lebih terang border-nya */
        .form-control, .form-select { background-color: #334155; border: 1px solid #94a3b8; color: white; font-weight: 500; }
        .form-control::placeholder { color: #cbd5e1; }
        .form-control:focus, .form-select:focus { background-color: #334155; border-color: var(--accent); color: white; box-shadow: none; }
        /* Indikator Status */
        .unit-status-indicator { width: 15px; height: 15px; border-radius: 50%; display: inline-block; margin-right: 8px; box-shadow: 0 0 10px currentColor; }
        .status-available { background-color: var(--success); color: var(--success); }
        .status-occupied { background-color: var(--danger); color: var(--danger); animation: pulse 2s infinite; }
        .live-timer { font-family: 'Courier New', monospace; font-weight: bold; font-size: 1.3rem; letter-spacing: 1px; color: #fbbf24; text-shadow: 0 0 5px rgba(251, 191, 36, 0.5); }
        @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.5; } 100% { opacity: 1; } }
        /* Tabs Custom */
        .nav-tabs .nav-link { color: #e2e8f0; border: none; font-weight: bold; font-size: 1.1rem; }
        .nav-tabs .nav-link:hover { color: #fff; }
        .nav-tabs .nav-link.active { background-color: var(--card-bg); color: var(--accent); border: 1px solid #64748b; border-bottom: none; }
        .table { color: #fff; }
        label { color: #fff; margin-bottom: 5px; font-weight: bold; }
        .text-muted { color: #cbd5e1 !important; } /* Paksa text-muted jadi abu terang */
    </style>
</head>
<body class="pb-5">

    <nav class="navbar navbar-dark bg-dark border-bottom border-secondary mb-4 p-3">
        <div class="container-fluid">
            <span class="navbar-brand brand-font fs-3"><i class="fas fa-gamepad text-primary"></i> Rental PS GACOR KANG</span>
            <span class="badge bg-primary fs-6" id="clock">00:00:00 UTC</span>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="mainTab">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab-kasir">🎮 Kasir</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-inventory">📦 Stok</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-member">👥 Member</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-laporan">📊 Laporan</a></li>
                        </ul>
                    </div>
                    <div class="card-body tab-content">
                        <div class="tab-pane fade show active" id="tab-kasir">
                            <h5 class="text-primary mb-3 fw-bold"><i class="fas fa-play"></i> MULAI SEWA</h5>
                            <form onsubmit="event.preventDefault(); startRental();" class="mb-4 border-bottom border-secondary pb-4">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <label>Unit:</label>
                                        <select class="form-select" id="start_unit_id"><option value="">Loading...</option></select>
                                    </div>
                                    <div class="col-6">
                                        <label>Atas Nama:</label>
                                        <select class="form-select" id="start_member_id">
                                            <option value="">Tamu / Guest</option>
                                            </select>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-primary w-100 fw-bold py-2 fs-5">START TIMER 🚀</button>
                                    </div>
                                </div>
                            </form>

                            <h5 class="text-warning mb-3 fw-bold"><i class="fas fa-utensils"></i> ORDER SNACK</h5>
                            <form onsubmit="event.preventDefault(); orderSnack();" class="mb-4 border-bottom border-secondary pb-4">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <label>Unit yang Main:</label>
                                        <select class="form-select" id="snack_rental_id"><option value="">Pilih Unit...</option></select>
                                    </div>
                                    <div class="col-8">
                                        <label>Pilih Menu:</label>
                                        <select class="form-select" id="snack_menu_id"><option value="">Loading...</option></select>
                                    </div>
                                    <div class="col-4">
                                        <label>Jumlah:</label>
                                        <input type="number" class="form-control" id="snack_qty" value="1" min="1">
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button class="btn btn-warning w-100 fw-bold text-dark">PESAN SEKARANG</button>
                                    </div>
                                </div>
                            </form>

                            <h5 class="text-danger mb-3 fw-bold"><i class="fas fa-stop-circle"></i> STOP & BAYAR</h5>
                            <form onsubmit="event.preventDefault(); checkout();">
                                <label>Pilih Unit Selesai:</label>
                                <div class="input-group">
                                    <select class="form-select" id="stop_rental_id"><option value="">Pilih Unit...</option></select>
                                    <button class="btn btn-danger fw-bold px-4">STOP</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="tab-inventory">
                            <h5 class="text-success mb-3 fw-bold">Stok Gudang</h5>
                            <div class="table-responsive" style="max-height: 300px; overflow-y:auto;">
                                <table class="table table-dark table-striped align-middle">
                                    <thead><tr><th>Item</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
                                    <tbody id="inventory-list"></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-member">
                            <div class="card p-3 bg-dark border-secondary mb-3">
                                <h6 class="text-info fw-bold mb-3"><i class="fas fa-user-plus"></i> Tambah Member Baru</h6>
                                <form onsubmit="event.preventDefault(); addMember();">
                                    <div class="row g-2">
                                        <div class="col-6"><input type="text" id="m_name" class="form-control form-control-sm" placeholder="Nama Lengkap" required></div>
                                        <div class="col-6"><input type="text" id="m_phone" class="form-control form-control-sm" placeholder="No HP" required></div>
                                        <div class="col-8"><input type="text" id="m_address" class="form-control form-control-sm" placeholder="Alamat (Opsional)"></div>
                                        <div class="col-4">
                                            <select id="m_duration" class="form-select form-select-sm">
                                                <option value="1">1 Bulan</option>
                                                <option value="6">6 Bulan</option>
                                                <option value="12">1 Tahun</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <button class="btn btn-info btn-sm w-100 fw-bold text-dark">SIMPAN DATA</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <h6 class="text-white fw-bold">Database Member</h6>
                            <div class="table-responsive" style="max-height: 300px; overflow-y:auto;">
                                <table class="table table-dark table-hover">
                                    <thead><tr><th>Nama</th><th>Expired</th><th>Status</th><th>Aksi</th></tr></thead>
                                    <tbody id="member-list"></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-laporan">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="text-white mb-0 fw-bold">Laporan Omzet</h5>
                                <select class="form-select w-50" id="report_type" onchange="loadReport()">
                                    <option value="daily">Hari Ini</option>
                                    <option value="monthly">Bulan Ini</option>
                                </select>
                            </div>
                            <div class="card bg-black p-4 text-center border-success mb-3">
                                <span class="text-light">Total Pendapatan</span>
                                <h1 class="text-success fw-bold display-4 mt-2" id="total_omzet">Rp 0</h1>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-dark table-striped">
                                    <thead><tr><th>Waktu</th><th class="text-end">Pendapatan</th></tr></thead>
                                    <tbody id="report-list"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center bg-black border-bottom border-secondary">
                        <span class="brand-font fs-4 text-white"><i class="fas fa-desktop me-2"></i> LIVE MONITORING</span>
                        <span class="badge bg-success fs-6" id="connection-status">Online</span>
                    </div>
                    <div class="card-body bg-dark">
                        <div class="row g-3" id="units-grid">
                            <div class="text-center py-5 text-light fs-5">Menghubungkan ke Station...</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const API_URL = 'api/';
        
        // Jam Pojok Kanan Atas (UTC)
        setInterval(() => {
            const now = new Date();
            const timeString = now.toISOString().split('T')[1].split('.')[0];
            document.getElementById('clock').innerText = timeString + ' UTC';
        }, 1000);

        async function fetchDashboard() {
            try {
                const [resUnits, resRentals] = await Promise.all([
                    fetch(API_URL + 'units.php'),
                    fetch(API_URL + 'rentals.php')
                ]);
                const units = await resUnits.json();
                const rentals = await resRentals.json();

                if (units.data && units.data.length > 0) {
                    units.data.sort((a, b) => a.id - b.id);
                }

                renderGrid(units.data, rentals.data || []);
                updateDropdowns(units.data, rentals.data || []);
                document.getElementById('connection-status').className = 'badge bg-success';
                document.getElementById('connection-status').innerText = 'Online';
            } catch (e) {
                document.getElementById('connection-status').className = 'badge bg-danger';
                document.getElementById('connection-status').innerText = 'Offline';
            }
        }

        function renderGrid(units, activeRentals) {
            const grid = document.getElementById('units-grid');
            grid.innerHTML = '';
            
            units.forEach(unit => {
                const rental = activeRentals.find(r => r.unit_name === unit.unit_name);
                const isBusy = unit.status === 'occupied';
                const color = isBusy ? 'danger' : 'success';
                
                let content = '';

                if (isBusy && rental) {
                    // Logic untuk Unit yang sedang MAIN
                    const playerName = rental.player_name ? rental.player_name : 'Guest';
                    content = `
                        <div class="live-timer text-warning mt-2 mb-1" data-start="${rental.start_time}">00:00:00</div>
                        <div class="text-white fw-bold border-top border-secondary pt-2 mt-2" style="font-size:0.9rem">
                            <i class="fas fa-user me-1"></i> ${playerName}
                        </div>
                        <small class="text-muted">Start: ${rental.start_time.split(' ')[1]}</small>
                    `;
                } else {
                    // Logic untuk Unit KOSONG
                    content = `<p class="mt-4 text-white fw-bold fs-5">SIAP MAIN</p>`;
                }

                grid.innerHTML += `
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 border-${color} bg-opacity-10" style="background:${isBusy ? '#451a1a' : '#1a2e45'}">
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-${color}">${isBusy ? 'MAIN' : 'KOSONG'}</span>
                                <div class="unit-status-indicator status-${isBusy ? 'occupied' : 'available'}"></div>
                            </div>
                            <h3 class="brand-font text-white fw-bold">${unit.unit_name}</h3>
                            <small class="text-info">${unit.type_name}</small>
                            <div class="mt-2">
                                <i class="fab fa-playstation fa-3x text-${color}"></i>
                            </div>
                            ${content}
                        </div>
                    </div>
                </div>`;
            });
        }

        function updateTimers() {
            const timers = document.querySelectorAll('.live-timer');
            const now = new Date();
            timers.forEach(timer => {
                const startString = timer.getAttribute('data-start');
                const isoString = startString.replace(' ', 'T') + 'Z';
                const startTime = new Date(isoString);
                const diff = now - startTime;

                if (diff >= 0) {
                    const hours = Math.floor(diff / 3600000);
                    const minutes = Math.floor((diff % 3600000) / 60000);
                    const seconds = Math.floor((diff % 60000) / 1000);
                    const h = hours < 10 ? '0'+hours : hours;
                    const m = minutes < 10 ? '0'+minutes : minutes;
                    const s = seconds < 10 ? '0'+seconds : seconds;
                    timer.innerText = `${h}:${m}:${s}`;
                } else {
                    timer.innerText = "Syncing...";
                }
            });
        }

        function updateDropdowns(units, activeRentals) {
            const start = document.getElementById('start_unit_id');
            const stop = document.getElementById('stop_rental_id');
            const snack = document.getElementById('snack_rental_id');
            
            const vStart = start.value; const vStop = stop.value; const vSnack = snack.value;

            let optStart = '<option value="">Pilih Unit Kosong...</option>';
            units.filter(u => u.status === 'available').forEach(u => optStart += `<option value="${u.id}">${u.unit_name}</option>`);
            start.innerHTML = optStart; start.value = vStart;

            let optActive = '<option value="">Pilih Unit...</option>';
            activeRentals.forEach(r => optActive += `<option value="${r.id}">${r.unit_name} (ID: ${r.id})</option>`);
            stop.innerHTML = optActive; stop.value = vStop;
            snack.innerHTML = optActive; snack.value = vSnack;
        }

       // --- MEMBER FUNCTIONS (UPDATED: SHOW POINTS) ---
        async function loadMembers() {
            const res = await fetch(API_URL + 'members.php');
            const json = await res.json();
            const table = document.getElementById('member-list');
            const dropdown = document.getElementById('start_member_id');
            
            // Update Tabel
            let tableHeader = `<thead><tr><th>Nama</th><th>Poin</th><th>Expired</th><th>Status</th><th>Aksi</th></tr></thead>`;
            let tableBody = '';
            
            // Reset dropdown
            dropdown.innerHTML = '<option value="">Tamu / Guest</option>';
            
            json.data.forEach(m => {
                const bg = m.status === 'ACTIVE' ? 'bg-success' : 'bg-danger';
                const pointClass = m.total_points > 100 ? 'text-warning fw-bold' : 'text-info'; // Kalo >100 poin jadi emas
                
                tableBody += `
                    <tr>
                        <td><span class="text-white fw-bold">${m.name}</span><br><small class="text-light opacity-75">${m.phone}</small></td>
                        <td><span class="${pointClass}"><i class="fas fa-coins"></i> ${m.total_points}</span></td>
                        <td class="text-light">${m.expiry_date}</td>
                        <td><span class="badge ${bg}">${m.status}</span></td>
                        <td><button onclick="deleteMember(${m.id})" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button></td>
                    </tr>`;
                
                // Isi Dropdown Start (Cuma yang Active)
                if(m.status === 'ACTIVE') {
                    dropdown.innerHTML += `<option value="${m.id}">${m.name} (${m.total_points} Poin)</option>`;
                }
            });
            
            table.innerHTML = tableHeader + `<tbody>${tableBody}</tbody>`;
        }

        async function addMember() {
            const name = document.getElementById('m_name').value;
            const phone = document.getElementById('m_phone').value;
            const address = document.getElementById('m_address').value;
            const duration = document.getElementById('m_duration').value;
            
            const res = await fetch(API_URL + 'members.php', { method: 'POST', body: JSON.stringify({ name, phone, address, duration }) });
            const json = await res.json();
            
            if(json.status === 'success') {
                Swal.fire('Berhasil', json.message, 'success');
                document.getElementById('m_name').value = '';
                document.getElementById('m_phone').value = '';
                document.getElementById('m_address').value = '';
                loadMembers();
            } else {
                Swal.fire('Gagal', json.message, 'error');
            }
        }

        async function deleteMember(id) {
            Swal.fire({
                title: 'Hapus Member?', text: "Data tidak bisa balik lagi!", icon: 'warning',
                showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Hapus'
            }).then(async (r) => {
                if(r.isConfirmed) {
                    await fetch(API_URL + 'members.php', { method: 'DELETE', body: JSON.stringify({ id }) });
                    loadMembers();
                    Swal.fire('Terhapus', '', 'success');
                }
            });
        }

        // --- INVENTORY & REPORTS ---
        async function loadInventory() {
            const res = await fetch(API_URL + 'snacks.php');
            const json = await res.json();
            const table = document.getElementById('inventory-list');
            const select = document.getElementById('snack_menu_id');
            table.innerHTML = ''; select.innerHTML = '<option value="">Pilih Menu...</option>';
            json.data.forEach(item => {
                const name = item.snack_name || item.name; 
                table.innerHTML += `<tr><td class="text-white">${name}</td><td class="text-white">${parseInt(item.price).toLocaleString()}</td><td class="${item.stock < 5 ? 'text-danger fw-bold' : 'text-success fw-bold'}">${item.stock}</td><td><button onclick="restock(${item.id})" class="btn btn-sm btn-outline-success">+Stok</button></td></tr>`;
                select.innerHTML += `<option value="${item.id}">${name} (Sisa: ${item.stock})</option>`;
            });
        }
        async function restock(id) {
            const { value: qty } = await Swal.fire({title:'Tambah Stok', input:'number'});
            if(qty) { await fetch(API_URL+'inventory.php', {method:'POST', body:JSON.stringify({id, qty})}); loadInventory(); }
        }
        async function loadReport() {
            const type=document.getElementById('report_type').value; const res=await fetch(API_URL+`reports.php?type=${type}`);
            const json=await res.json(); document.getElementById('total_omzet').innerText='Rp '+json.total;
            const table=document.getElementById('report-list'); table.innerHTML='';
            json.chart.forEach(d=>{ table.innerHTML+=`<tr><td class="text-white">${d.jam||d.tanggal}</td><td class="text-end text-success fw-bold">${parseInt(d.omzet).toLocaleString()}</td></tr>`});
        }
        
        // --- RENTAL ACTIONS ---
        async function startRental() {
            const unit_id = document.getElementById('start_unit_id').value;
            const member_id = document.getElementById('start_member_id').value; // Tangkap Member ID
            
            if(!unit_id) return;
            
            const res = await fetch(API_URL + 'rentals.php', { 
                method: 'POST', 
                body: JSON.stringify({ unit_id, member_id }) 
            });
            const json = await res.json();
            json.status === 'success' ? fetchDashboard() : Swal.fire('Error', json.message, 'error');
        }

        async function orderSnack() {
            const rental_id=document.getElementById('snack_rental_id').value; const snack_id=document.getElementById('snack_menu_id').value; const qty=document.getElementById('snack_qty').value;
            if(!rental_id||!snack_id) return;
            const res=await fetch(API_URL+'snacks.php', {method:'POST', body:JSON.stringify({rental_id, snack_id, qty})});
            const json=await res.json(); json.status==='success'?Swal.fire('Order Masuk','','success'):Swal.fire('Error',json.message,'error');
        }
        async function checkout() {
            const rental_id=document.getElementById('stop_rental_id').value; if(!rental_id) return;
            Swal.fire({title:'Stop Rental?', showCancelButton:true, confirmButtonColor:'#d33', confirmButtonText:'Stop'}).then(async(r)=>{
                if(r.isConfirmed){
                    const res=await fetch(API_URL+'checkout.php', {method:'POST', body:JSON.stringify({rental_id})});
                    const json=await res.json();
                    if(json.status==='success'){
                        Swal.fire({title:'Sukses', html:`Total: Rp ${json.struk.total_bayar}<br><button onclick="window.open('struk.php?id=${rental_id}')" class="btn btn-primary mt-2">Cetak</button>`, icon:'success'});
                        fetchDashboard(); loadReport();
                    } else { Swal.fire('Error',json.message,'error'); }
                }
            });
        }

        // INIT
        fetchDashboard(); loadInventory(); loadReport(); loadMembers();
        setInterval(fetchDashboard, 3000); 
        setInterval(updateTimers, 1000);   
    </script>
</body>
</html>
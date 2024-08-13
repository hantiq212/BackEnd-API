<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>Dashboard</h1>
    </header>
    <div class="container">
        <h2>Pencarian Karyawan</h2>
        <!-- Pencarian dan filter divisi -->
        <input type="text" id="search-name" placeholder="Cari berdasarkan nama">
        <select id="filter-division">
            <option value="">Semua Divisi</option>
            <!-- Opsi divisi akan diisi secara dinamis oleh fetchDivisions() -->
        </select>
        <button id="search-button">Cari</button>

        <h2>Daftar Divisi</h2>
        <table id="divisions-table">
            <!-- Data divisi akan dimuat di sini -->
        </table>

        <h2>Daftar Karyawan</h2>
        <table id="employees-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    <th>Gambar</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data karyawan akan dimuat di sini -->
            </tbody>
        </table>

        <h2>Tambah/Edit Karyawan</h2>
        <form id="employee-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="employee-id" name="employee_id" />
            <input type="file" id="employee-image" name="image" required />
            <input type="text" id="employee-name" name="name" placeholder="Nama Karyawan" required />
            <input type="text" id="employee-phone" name="phone" placeholder="No Telepon" required />
            <input type="text" id="employee-division" name="division" placeholder="UUID Divisi" required />
            <input type="text" id="employee-position" name="position" placeholder="Jabatan" required />
            <button type="submit" id="submit-btn">Tambah Karyawan</button>
        </form>
        

        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

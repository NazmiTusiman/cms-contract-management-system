@include('dashboard.common', [
    'pageTitle' => 'Dashboard (Admin)',
    'jumlahKontrak' => $jumlahKontrak ?? 0,
    'nilaiKontrak' => $nilaiKontrak ?? 0,
    'tamatTempoh' => $tamatTempoh ?? 0,
])a
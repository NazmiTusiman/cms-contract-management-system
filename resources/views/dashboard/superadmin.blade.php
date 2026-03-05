@include('dashboard.common', [
    'pageTitle' => 'Dashboard (SuperAdmin)',
    'jumlahKontrak' => $jumlahKontrak ?? 0,
    'nilaiKontrak' => $nilaiKontrak ?? 0,
    'tamatTempoh' => $tamatTempoh ?? 0,
])a
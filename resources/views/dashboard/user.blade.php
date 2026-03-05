@include('dashboard.common', [
    'pageTitle' => 'Dashboard (User)',
    'jumlahKontrak' => $jumlahKontrak ?? 0,
    'nilaiKontrak' => $nilaiKontrak ?? 0,
    'tamatTempoh' => $tamatTempoh ?? 0,
])
<!DOCTYPE html>
<html>

<head>
    <title>Access Denied</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Anda tidak dapat mengakses role ini',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href = "{{ url()->previous() }}";
        });
    </script>
</body>

</html>

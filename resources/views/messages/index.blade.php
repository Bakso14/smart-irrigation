<!DOCTYPE html>
<html>
<head>
    <title>Realtime MQTT Messages</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: sans-serif; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; }
    </style>
</head>
<body>
    <h1>Pesan MQTT (Live Update)</h1>
    <table>
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Topik</th>
                <th>Pesan</th>
            </tr>
        </thead>
        <tbody id="data-body">
            <!-- Data akan dimuat di sini -->
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function formatToGMT7(utcString) {
            const date = new Date(utcString);

            return date.toLocaleString('id-ID', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false,
            }) + ' WIB';
        }
    </script>
    <script>
        function loadData() {
            $.get('/api/messages', function(data) {
                let html = '';
                data.forEach(msg => {
                    html += `<tr>
                        <td>${formatToGMT7(msg.created_at)}</td>
                        <td>${msg.topic}</td>
                        <td>${msg.message}</td>
                    </tr>`;
                });
                $('#data-body').html(html);
            });
        }

        // Pertama kali
        loadData();

        // Ulangi setiap 5 detik
        setInterval(loadData, 5000);
    </script>
</body>
</html>

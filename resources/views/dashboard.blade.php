<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Realtime</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <!-- Header -->
    <h1 class="text-3xl font-bold mb-6 text-center">Dashboard Node Sensor (Realtime)</h1>

    <!-- Box 0: Base Station (Node 0) -->
    <div id="base-station" class="bg-white p-6 rounded-xl shadow mb-6 text-center text-xl font-semibold">
        Memuat Base Station...
    </div>

    <!-- Grid untuk Node 1–4 -->
    <div id="card-container" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Data Node 1–4 akan di-load di sini -->
    </div>

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
            $.get('/api/sensor-nodes', function(nodes) {
                let baseNode = nodes.find(n => n.node == 0);
                let otherNodes = nodes.filter(n => n.node != 0);

                // Tampilkan Node 0 (Base Station)
                if (baseNode) {
                    $('#base-station').html(`
                        <h2 class="text-2xl mb-2 font-bold">Base Station (Node 0)</h2>
                        <ul class="text-sm text-gray-700 space-y-1">
                            <li><strong>Tegangan:</strong> ${baseNode.tegangan} V</li>
                            <li><strong>Arus:</strong> ${baseNode.arus} mA</li>
                            <li><strong>Sensor 1:</strong> ${baseNode.sensor1}</li>
                            <li><strong>Sensor 2:</strong> ${baseNode.sensor2}</li>
                            <li><strong>Sensor 3:</strong> ${baseNode.sensor3}</li>
                            <li class="text-xs text-gray-400 mt-2">Update: ${formatToGMT7(baseNode.updated_at)}</li>
                        </ul>
                    `);
                } else {
                    $('#base-station').html(`<div class="text-red-500">Base Station (Node 0) belum tersedia.</div>`);
                }

                // Tampilkan Node 1–4
                let html = '';
                otherNodes.sort((a, b) => a.node - b.node); // urutkan berdasarkan node
                otherNodes.forEach(node => {
                    html += `
                        <div class="bg-white p-4 rounded-2xl shadow hover:shadow-lg transition">
                            <h2 class="text-xl font-semibold mb-2 text-center">Node ${node.node}</h2>
                            <ul class="text-sm text-gray-700 space-y-1">
                                <li><strong>Tegangan:</strong> ${node.tegangan} V</li>
                                <li><strong>Arus:</strong> ${node.arus} mA</li>
                                <li><strong>Sensor 1:</strong> ${node.sensor1}</li>
                                <li><strong>Sensor 2:</strong> ${node.sensor2}</li>
                                <li><strong>Sensor 3:</strong> ${node.sensor3}</li>
                                <li class="text-xs text-gray-400 mt-2">Update: ${formatToGMT7(node.updated_at)}</li>
                            </ul>
                        </div>
                    `;
                });
                $('#card-container').html(html);
            });
        }

        loadData();
        setInterval(loadData, 5000);
    </script>
</body>
</html>

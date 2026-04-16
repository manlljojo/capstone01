/**
 * KONSER KITA - NODE.JS UTILITY SERVICE
 * -------------------------------------
 * Service ini digunakan untuk menangani tugas-tugas berat di luar PHP,
 * seperti pemrosesan real-time atau validasi tiket dalam skala besar.
 */

const http = require('http');

const PORT = 3000;

const server = http.createServer((req, res) => {
    res.setHeader('Content-Type', 'application/json');
    res.setHeader('Access-Control-Allow-Origin', '*');

    if (req.url === '/api/status' && req.method === 'GET') {
        res.writeHead(200);
        res.end(JSON.stringify({
            status: 'Node.js Service Active',
            uptime: process.uptime(),
            message: 'Siap menangani trafik real-time konser!'
        }));
    } else {
        res.writeHead(404);
        res.end(JSON.stringify({ error: 'Endpoint not found' }));
    }
});

server.listen(PORT, () => {
    console.log(`[Node.js] Service running at http://localhost:${PORT}`);
    console.log(`[Node.js] Gunakan service ini untuk integrasi Socket.io atau Real-time Monitoring.`);
});

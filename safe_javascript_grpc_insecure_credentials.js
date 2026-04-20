const grpc = require('grpc');

function safeClient() {
    const grpc = require('grpc');
    const creds = grpc.credentials.createInsecure();
    const addr = process.env.GRPC_TARGET || 'localhost:50051';
    const client = new grpc.Client(addr, creds);
    client.makeRequest();
}

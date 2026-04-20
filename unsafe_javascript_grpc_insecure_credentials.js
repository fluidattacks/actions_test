//test
const grpc = require('grpc');

function vulnerableClient1() {
    const client = new grpc.Client(
        'www.example.com:50051',
        grpc.credentials.createInsecure()
    );
    client.makeRequest();
}

function vulnerableClient2() {
    const creds = grpc.credentials.createInsecure();
    const client = new grpc.Client('remote_server:50051', creds);
    client.makeRequest();
}

function vulnerableClient3() {
    const grpc = require('grpc');
    const creds = Math.random() > 0.5 ? grpc.credentials.createInsecure() : someOtherCreds();
    const client = new grpc.Client('qa_server:50051', creds);
    client.makeRequest();
}

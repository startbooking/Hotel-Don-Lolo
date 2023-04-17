
const ws = new WebSocket('ws://sactel.app/ws')

ws.open = () => {
	console.log('Conectado ');
};

ws.onmessage = e => {
	const msg = JSON.parse(e.data);
	console.log(msg);
};

ws.onerror = e => {
	console.log(e);
};

ws.onclose = e => {
	console.log('Conexion  Cerrada');
	console.log(e);
};

// Envia Informacion 

const btnSend = document.getElementById('btnSend');
btnSend.addEventListener('click', () => {
	const data = {
		name:'Pedro',
		message: 'Hola Amigos Como estan ??'
	};
	ws.send(JSON.stringify(data));
});

const btnClose = document.getElementById('btnClose');
btnClose.addEventListener('click', () => {
	ws.close();
});


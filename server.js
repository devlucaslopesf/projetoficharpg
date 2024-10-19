const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const path = require('path');

const app = express();
const server = http.createServer(app);
const io = new Server(server);

// Configurando a pasta de arquivos estáticos
app.use(express.static(path.join(__dirname, 'public')));

// Rota principal
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

// Configuração do Socket.IO
io.on('connection', (socket) => {
  console.log('Um usuário se conectou');

  // Recebe a mensagem privada e repassa para todos os conectados
  socket.on('private message', (msg) => {
    io.emit('private message', msg);
  });

  // Evento de desconexão
  socket.on('disconnect', () => {
    console.log('Usuário se desconectou');
  });
});

// Inicia o servidor na porta 3000
const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
  console.log(`Servidor rodando na porta ${PORT}`);
});

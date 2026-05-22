import express from 'express';
import { createServer } from 'http';
import { Server } from 'socket.io';

const app = express();
const server = createServer(app);

const io = new Server(server, {
    cors: {
        origin: '*', // Allow all origins for development convenience
        methods: ['GET', 'POST']
    }
});

// Map to track active room users: roomName -> Array of User Objects { socketId, id, name, avatar_color }
const rooms = new Map();

io.on('connection', (socket) => {
    console.log(`User connected: ${socket.id}`);

    // Join a note's room
    socket.on('join-note', ({ noteId, user }) => {
        const roomName = `note:${noteId}`;
        socket.join(roomName);

        socket.noteId = noteId;
        socket.user = user;

        if (!rooms.has(roomName)) {
            rooms.set(roomName, []);
        }

        const roomUsers = rooms.get(roomName);
        
        // Remove existing entry for the user if any (to avoid duplicates)
        const filteredUsers = roomUsers.filter(u => u.id !== user.id);
        filteredUsers.push({
            socketId: socket.id,
            id: user.id,
            name: user.name,
            avatar_color: user.avatar_color
        });
        
        rooms.set(roomName, filteredUsers);

        console.log(`User ${user.name} joined room ${roomName}`);

        // Broadcast to other users in the room
        socket.to(roomName).emit('user-joined', {
            user: user,
            message: `${user.name} joined the workspace`
        });

        // Send updated users list to all users in the room
        io.to(roomName).emit('room-users', rooms.get(roomName));
    });

    // Handle real-time text sync
    socket.on('editor-change', ({ noteId, content, userId }) => {
        const roomName = `note:${noteId}`;
        // Broadcast the content update to everyone in the room EXCEPT the sender
        socket.to(roomName).emit('editor-change', { content, userId });
    });

    // Handle typing status
    socket.on('typing', ({ noteId, isTyping, userName }) => {
        const roomName = `note:${noteId}`;
        socket.to(roomName).emit('typing', { isTyping, userName });
    });

    // Handle cursor tracking
    socket.on('cursor-move', ({ noteId, cursor }) => {
        const roomName = `note:${noteId}`;
        socket.to(roomName).emit('cursor-move', {
            socketId: socket.id,
            user: socket.user,
            cursor: cursor // e.g. { index: number, anchor: number, head: number } or coordinates
        });
    });

    // Leave a note room manually
    socket.on('leave-note', ({ noteId }) => {
        const roomName = `note:${noteId}`;
        socket.leave(roomName);
        handleRoomExit(socket, roomName);
    });

    // Disconnect
    socket.on('disconnect', () => {
        console.log(`User disconnected: ${socket.id}`);
        if (socket.noteId) {
            const roomName = `note:${socket.noteId}`;
            handleRoomExit(socket, roomName);
        }
    });
});

function handleRoomExit(socket, roomName) {
    if (rooms.has(roomName)) {
        let roomUsers = rooms.get(roomName);
        const exitingUser = roomUsers.find(u => u.socketId === socket.id);
        
        roomUsers = roomUsers.filter(u => u.socketId !== socket.id);
        rooms.set(roomName, roomUsers);

        if (exitingUser) {
            console.log(`User ${exitingUser.name} left room ${roomName}`);
            
            // Broadcast user left message
            socket.to(roomName).emit('user-left', {
                user: exitingUser,
                message: `${exitingUser.name} left the workspace`
            });
            
            // Broadcast updated users list
            io.to(roomName).emit('room-users', roomUsers);
        }

        // Clean up empty room
        if (roomUsers.length === 0) {
            rooms.delete(roomName);
        }
    }
}

const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
    console.log(`Socket.IO Server running on port ${PORT}`);
});

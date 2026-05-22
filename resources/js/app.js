import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';
import { io } from 'socket.io-client';
import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';

window.Alpine = Alpine;
window.io = io;
window.Editor = Editor;
window.StarterKit = StarterKit;

Alpine.start();

// Initialize AOS
document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 100,
    });
});

console.log('Notoliyo Assets Loaded successfully.');

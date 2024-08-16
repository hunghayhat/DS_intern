import './bootstrap';

import Alpine from 'alpinejs';
import Search from './live-search';
import Chat from './chat';

window.Alpine = Alpine;

Alpine.start();

if (document.querySelector(".header-search-icon")) {
    new Search();
}

if (document.querySelector(".header-chat-icon")) {
    new Chat();
}
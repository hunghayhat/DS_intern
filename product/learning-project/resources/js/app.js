import './bootstrap';

import Alpine from 'alpinejs';
import Search from './live-search';

window.Alpine = Alpine;

Alpine.start();

if (document.querySelector(".header-search-icon")) {
    new Search();
}
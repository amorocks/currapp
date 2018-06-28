
window.Popper = require('popper.js').default;

try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
} catch (e) {}

var Turbolinks = require("turbolinks");
Turbolinks.start();

import './bootstrap';
import '../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js';
import './main.min.js';
import.meta.glob(["../images/**", "../fonts/**"]);

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.css';

import "./bootstrap";
import { Observer } from "tailwindcss-intersect";
import "preline";
import "@preline/file-upload";
import Swal from "sweetalert2";
window.Swal = Swal;


Observer.start();
document.addEventListener("DOMContentLoaded", function () {
    HSStaticMethods.autoInit();
});
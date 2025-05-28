import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


let deleteFotoLink = document.querySelectorAll(".deleteFoto");
let editJudulLink = document.querySelectorAll(".editJudul");
let arsipkanFotolLink = document.querySelectorAll(".arsipkanFoto");

deleteFotoLink.forEach(function (link) {
    link.addEventListener('click', function() {
        const tt = this.querySelector(".jj").value;
        document.getElementById('deleteId').value = tt;
    });
})
arsipkanFotolLink.forEach(function (link) {
    link.addEventListener('click', function() {
        const tt = this.querySelector(".jj").value;
        document.getElementById('arsipId').value = tt;
    });
})
editJudulLink.forEach(function (link) {
    link.addEventListener('click', function() {
        const tt = this.querySelector(".title_foto").value;
        const hh = this.querySelector(".id_foto").value;
        document.getElementById('editId').value = hh;
        document.getElementById('editTitle').value = tt;
    });
})
import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


let deleteFotoLink = document.querySelectorAll(".deleteFoto");
let editJudulLink = document.querySelectorAll(".editJudul");
let arsipkanFotolLink = document.querySelectorAll(".arsipkanFoto");
let pindahAlbumLink = document.querySelectorAll(".pindahAlbum");

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
pindahAlbumLink.forEach(function (link) {
    link.addEventListener('click', function() {
        const tt = this.querySelector(".title_foto").value;
        const hh = this.querySelector(".id_foto").value;
        let vv = this.querySelector(".album_id").value;

        document.getElementById('albumId').value = hh;
        document.getElementById('albumTitle').innerHTML = tt;

        vv = vv == "" ? 0 : vv;

        fetch(`/api/getActiveAlbum/${vv}`)
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('album-selector');
            select.querySelectorAll('option:not(:first-child)').forEach(opt => opt.remove());
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id_folder;
                option.textContent = item.name_folder;
                select.appendChild(option);
            });
        });
    });
})

document.addEventListener('DOMContentLoaded', function () {
    const input = document.querySelector('.searchFoto');
    const clearBtn = document.querySelector('.clearSearchBtn');

    // Tampilkan tombol clear saat ada teks
    input.addEventListener('input', function () {
        if (this.value.length > 0) {
            clearBtn.style.display = 'flex';
        } else {
            clearBtn.style.display = 'none';

            const url = new URL(window.location.href);
            url.searchParams.delete('search');
            window.location.href = url.toString(); // redirect without search param
        }
    });

    // Jalankan search saat enter
    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const keyword = input.value.trim();
            const url = new URL(window.location.href);
            if (keyword) {
                url.searchParams.set('search', keyword);
            } else {
                url.searchParams.delete('search');
            }
            window.location.href = url.toString(); // redirect with search param
        }
    });
    

    // Bersihkan input saat tombol clear diklik
    clearBtn.addEventListener('click', function (e) {
        e.preventDefault();
        input.value = '';
        clearBtn.style.display = 'none';

        const url = new URL(window.location.href);
        url.searchParams.delete('search');
        window.location.href = url.toString(); // redirect without search param
    });

    // Tampilkan tombol clear jika ada search saat load
    if (input.value.trim() !== '') {
        clearBtn.style.display = 'flex';
    }
});
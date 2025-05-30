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


///handle foto multiple action

let selectedFoto = [];
let selectedState = false;
const card_foto = document.querySelectorAll('.cardFoto');
const massActionPanel = document.querySelector('.massActionPanel');
const infoFilter = document.querySelector('.infoFilter');
const blockBtn = document.querySelector('.cardBlockBtn');
const cardCounter = document.querySelector('.cardCounter');
const selectAllBtn = document.querySelector('.selectAllBtn');
const massPindahAlbumBtn = document.querySelector('.massPindahAlbumBtn');
const massArsipkanBtn = document.querySelector('.massArsipkanBtn');
const massDeleteBtn = document.querySelector('.massDeleteBtn');




let fotoSelector = document.querySelectorAll(".foto-multiple-selector");
let isUpReadyState = false;
let isUpBlockState = true;

function watchSelectState() {
    selectedState = selectedFoto.length > 0;
    console.log("state " + selectedState);
    return selectedFoto;
}

function toggleSelectedId(photoId) {
    if (selectedFoto.includes(photoId)) {
        selectedFoto = selectedFoto.filter(id => id !== photoId);
    } else {
        selectedFoto.push(photoId);
    }
}

function forceSelectedId(photoId) {
    if (!selectedFoto.includes(photoId)) {
        selectedFoto.push(photoId);
    }
}

function upToReadyState() {
    console.log("up to ready state");
    card_foto.forEach(function(card) {
        card._x_dataStack[0].control = true;
        card._x_dataStack[0].leave = true;
    });
    isUpReadyState = true;
    isUpBlockState = false;
}

function upToBlockState() {
    console.log("up to block state");
    fotoSelector.forEach(cb => cb.checked = false);
    selectedFoto = [];
    card_foto.forEach(function(card) {
        card._x_dataStack[0].control = false;
        card._x_dataStack[0].leave = false;
    });
    isUpReadyState = false;
    isUpBlockState = true;
}

function showMassActionPanel() {
    infoFilter._x_dataStack[0].show = false;
    setTimeout(function() {
        massActionPanel._x_dataStack[0].show = true;
    }, 400);
}

function hideMassActionPanel() {
    setTimeout(function() {
        infoFilter._x_dataStack[0].show = true;
    }, 400);
    massActionPanel._x_dataStack[0].show = false;
}

function counterCardSelected() {
    let len = selectedFoto.length;
    console.log(len);
    cardCounter.textContent  = len;
}

document.addEventListener('DOMContentLoaded', () => {
    fotoSelector.forEach(function (link) {
        link.addEventListener('change', function() {
           console.log(link.checked);
           const foto_id = this.parentElement.querySelector('.id_carrier').value;
           
           
           toggleSelectedId(foto_id);
           if(watchSelectState() && !isUpReadyState) {
               upToReadyState();
               showMassActionPanel();
            } 
            
            counterCardSelected();
           console.log(selectedFoto);
        });
    })

    blockBtn.addEventListener('click', function() {
        upToBlockState();
        hideMassActionPanel();
    });

    selectAllBtn.addEventListener('click', function() {
        fotoSelector.forEach(function(cb) {
            cb.checked = true;
            const foto_id = cb.parentElement.querySelector('.id_carrier').value;
            forceSelectedId(foto_id);
            counterCardSelected();
        });
    });


    ///action logic
    massPindahAlbumBtn.addEventListener('click', function() {
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'mass-pindah-album-modal' }));
    });

    massArsipkanBtn.addEventListener('click', function() {
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'mass-arsipkan-modal' }));
    });

    massDeleteBtn.addEventListener('click', function() {
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'mass-delete-modal' }));
    });

    window.addEventListener('open-modal', function (e) {
        if (e.detail === 'mass-pindah-album-modal') {
            const modalAlbum = document.querySelector('.mass-pindah-album-modal');
            if (modalAlbum) {
                modalAlbum.querySelector('.id_foto').value =  JSON.stringify(selectedFoto);
                modalAlbum.querySelector('.pindahCounter').textContent = selectedFoto.length;

                fetch(`/api/getAllActiveAlbum`)
                .then(response => response.json())
                .then(data => {
                    const select = modalAlbum.querySelector('#mass-album-selector');
                    console.log(select);
                    select.querySelectorAll('option:not(:first-child)').forEach(opt => opt.remove());
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id_folder;
                        option.textContent = item.name_folder;
                        select.appendChild(option);
                    });
                });   

            } else {
                console.warn('Modal belum muncul di DOM.');
            }
        } else if (e.detail === 'mass-arsipkan-modal') {
            const modalArsip = document.querySelector('.mass-arsipkan-modal');
            if(modalArsip) {
                modalArsip.querySelector('.id_foto').value =  JSON.stringify(selectedFoto);
                modalArsip.querySelector('.arsipCounter').textContent = selectedFoto.length;
            } else {
                console.warn('Modal belum muncul di DOM.');
            }
        } else if (e.detail === 'mass-delete-modal') {
            const modalArsip = document.querySelector('.mass-delete-modal');
            if(modalArsip) {
                modalArsip.querySelector('.id_foto').value =  JSON.stringify(selectedFoto);
                modalArsip.querySelector('.deleteCounter').textContent = selectedFoto.length;
            } else {
                console.warn('Modal belum muncul di DOM.');
            }
        }
        
    });
});


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

    function formatDate(isoDate) {
        const date = new Date(isoDate);
        const formatted = new Intl.DateTimeFormat('id-ID', {
            day: '2-digit',
            month: 'long',
            year: 'numeric',
            timeZone: 'UTC' // optional: keep date consistent across timezones
        }).format(date);

        return formatted;
    }

    async function getImageDetails(url) {

        try {
            const response = await fetch(url);
            const blob = await response.blob();
            return blob.size;
        } catch (error) {
            console.error("Error fetching image:", error);
            return null;
        }
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        const i = Math.floor(Math.log(bytes) / Math.log(1024));
        const value = Math.floor(bytes / Math.pow(1024, i));
        return `${value} ${sizes[i]}`;
    }

    const forward_btn = document.querySelector('.detail-foto-forward-btn');
    const backward_btn = document.querySelector('.detail-foto-backward-btn')
    const modal_detail_arsipkan_btn = document.querySelector('.modal-detail-arsipkan-btn');
    const modal_detail_delete_btn = document.querySelector('.modal-detail-delete-btn');
    const modal_detail_download_btn = document.querySelector('.modal-detail-download-btn');
    const modal_detail_album_btn = document.querySelector('.modal-detail-album-btn');

    let dataDetailFoto = {
        'data' : {},
        'currentIndex' : 0,
        'next' : -1,
        'prev' : -1,
        'isOpenModal' : false
    }

    function handleDetailFoto(index) {
        dataDetailFoto.currentIndex = index;
        dataDetailFoto.next = index < dataDetailFoto.data.length - 1 ? index + 1 : -1;
        dataDetailFoto.prev = index > 0 ? index - 1 : -1;
    }

    function showDetailFoto(current_id) {

        console.log(dataDetailFoto.prev);
        backward_btn.disabled = dataDetailFoto.prev === -1;
        forward_btn.disabled = dataDetailFoto.next === -1;

        fetch(`api/foto/${current_id}`) 
            .then(res => res.json())
            .then(data => {
                if(!dataDetailFoto.isOpenModal) {
                    window.dispatchEvent(new CustomEvent('open-modal', { detail: 'detail-foto-modal' }));
                    dataDetailFoto.isOpenModal = true;
                }

                document.querySelector(".detail-foto-modal-title").textContent = data.foto.photo_title
                const imageUrl = `/foto_access/${encodeURIComponent(data.foto.file_path)}`;

                const thumbnail_foto = document.querySelector('.detail-foto-thumbnail-foto');
                const full_foto = document.querySelector('.detail-foto-full-foto');
                const tanggal_foto = document.querySelector('.detail-foto-created-at');
                const size_foto = document.querySelector('.detail-foto-file-size');
                const id_foto = document.querySelector('[name="detail-foto-modal-id-foto"]');
                const foto_favorit = document.querySelector('.detail-foto-favorit');

                foto_favorit.classList.toggle('text-red-500', data.foto.is_favorite);

                thumbnail_foto.src = imageUrl;
                thumbnail_foto.alt = data.foto.photo_title;
                full_foto.src = imageUrl;
                full_foto.alt = data.foto.photo_title;
                id_foto.content = data.foto.id_photo;

                getImageDetails(imageUrl).then(size => {
                    size_foto.textContent = formatFileSize(size);
                });
                
                tanggal_foto.textContent = formatDate(data.foto.created_at);
            });
    }

    function handleFwBwClick(index) {
        const next_id = dataDetailFoto.data[index].id_photo;
        handleDetailFoto(index);
        showDetailFoto(next_id);
    }

    const modalArsipDetail = document.getElementById('modal-detail-arsipkan');
    const modalDeteleDetail = document.getElementById('modal-detail-delete');
    const modalPindahAlbum = document.getElementById('modalPindahAlbum');

    modal_detail_arsipkan_btn.addEventListener('click', function() {
        const data = dataDetailFoto.data[dataDetailFoto.currentIndex];
        
        modalArsipDetail.showModal();
        modalArsipDetail.querySelector('#fotoTitle').textContent = '"' + data.photo_title + '"';
        modalArsipDetail.querySelector('.id_photo').value = data.id_photo;
    });

    modal_detail_delete_btn.addEventListener('click', function() {
        const data = dataDetailFoto.data[dataDetailFoto.currentIndex];
        modalDeteleDetail.showModal();
        modalDeteleDetail.querySelector('.id_photo').value = data.id_photo;
    });


    modal_detail_download_btn.addEventListener('click', function() {
        const path = dataDetailFoto.data[dataDetailFoto.currentIndex].file_path;

        const encodedPath = encodeURIComponent(path);
        const link = document.createElement('a');
        link.href = `/download-file/${encodedPath}`;
        link.setAttribute('download', ''); // browser uses filename from Laravel response
        document.body.appendChild(link);
        link.click();
        link.remove();
    });

    modal_detail_album_btn.addEventListener('click', function() {
        const data = dataDetailFoto.data[dataDetailFoto.currentIndex];
        console.log(data);
        modalPindahAlbum.showModal();

        document.getElementById('albumId').value = data.id_photo;
        document.getElementById('albumTitle').innerHTML = data.photo_title;

        let id_folder = data.folder == "" ? 0 : data.folder;

        fetch(`/api/getActiveAlbum/${id_folder}`)
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

    // modal_detail_favorit_btn.addEventListener('click', function() {
    //     const id = dataDetailFoto.data[dataDetailFoto.currentIndex].id_photo;
    //     fetch('/foto/favorite', {
    //         method: 'PATCH',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //         },
    //         body: JSON.stringify({ id_foto: id })
    //     })
    //     .then(res => res.json())
    //     .then(data => {
    //         foto_favorit.classList.toggle('text-red-500', data.is_favorite);
    //         if (window.location.pathname.startsWith('/favorit')) {
    //             window.location.reload();
    //         }
    //     })
    //     .catch(err => console.error(err));
    // })

    window.addEventListener('close-modal', function (event) {
        if (event.detail === 'detail-foto-modal') {
            dataDetailFoto.datalength = 0;
            dataDetailFoto.currentIndex = 0;
            dataDetailFoto.next = -1
            dataDetailFoto.prev = -1;
            dataDetailFoto.isOpenModal = false;
        }
    });

    forward_btn.addEventListener('click', function() {
        handleFwBwClick(dataDetailFoto.next);
    });

    backward_btn.addEventListener('click', function() {
        handleFwBwClick(dataDetailFoto.prev);
    })

    card_foto.forEach(function(card) {
        card.addEventListener('click', function() {
            const data_foto = JSON.parse(document.querySelector('meta[name="foto-data"').content);
            dataDetailFoto.data = data_foto;
            
            const current_id = card.querySelector('.id_carrier').value;
            const index = data_foto.findIndex(item => item.id_photo == current_id);  
            handleDetailFoto(index);
          
            showDetailFoto(current_id);
        })
    })
});


$(document).ready(async function () {
    async function eventTombolHapus(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin menghapus data ini?',
            text: "Data akan hilang permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                this.submit();
            }
        });
    }

    async function eventTombolDetail() {
        const url = this.dataset.url;
        let detail = await fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        });
        let result = await detail.json()
        if (result.from_id == dataUser.id) {
            document.querySelector('.detail-pengirim').innerHTML = 'Anda';
            document.querySelector('.detail-penerima').innerHTML = `${result.nama} (${result.role})`;
        } else if (result.to_id == dataUser.id) {
            document.querySelector('.detail-pengirim').innerHTML = `${result.nama} (${result.role})`;
            document.querySelector('.detail-penerima').innerHTML = 'Anda';
        }
        document.querySelector('.detail-subjek').innerHTML = result.subject;
        document.querySelector('.detail-pesan').innerHTML = result.message;
        document.querySelector('.detail-file').innerHTML = `<a class="btn btn-info btn-sm" target="_blank" href="file/${result.file_id}">Download file</a>`;

        document.querySelector('.detail-dikirim-pada').innerHTML = result.string_created_at;
        document.querySelector('.detail-dibaca').innerHTML = `<span class="btn btn-${result.is_read == 0 ? 'dark' : 'success'} btn-sm">${result.is_read == 0 ? 'Belum dibaca' : 'Telah dibaca'}</span>`;
        if (this.classList.contains('penerima')) {
            this.parentElement.parentElement.children[0].innerHTML = '<span style="opacity: 0">Baru</span>';
            this.parentElement.previousSibling.previousSibling.previousSibling.previousSibling.innerHTML = `<span class="btn btn-success btn-sm">Telah dibaca</span>`;
        }
        $('#detailModal').modal();
        const from_id = this.dataset.from_id;
        const is_read = this.dataset.is_read;
        if (from_id && is_read) {
            if (is_read == 0) {
                this.dataset.is_read = 1;
                let delayWebsocket = setInterval(function () {
                    if (ws.readyState == 1) {
                        ws.send(JSON.stringify({
                            'keterangan': 'surat dibaca',
                            'dari': dataUser,
                            'kepada': {
                                id: from_id
                            }
                        }));
                        clearInterval(delayWebsocket);
                    }
                }, 100);
            }
        }
    }

    // Tombol Detail
    let tombolDetail = document.querySelectorAll('.tombol-detail');
    if (tombolDetail) {
        tombolDetail.forEach((el) => {
            el.addEventListener('click', eventTombolDetail.bind(el));
        });
    }

    // Tombol Hapus
    let tombolHapus = document.querySelectorAll('.tombol-hapus');
    if (tombolHapus) {
        tombolHapus.forEach((el) => {
            el.addEventListener('submit', eventTombolHapus.bind(el));
        });
    }

    let dataUser = {
        id: document.querySelector('.data-user .id-user').innerHTML,
        nama: document.querySelector('.data-user .nama-user').innerHTML,
        role: document.querySelector('.data-user .role-user').innerHTML,
    };

    let ws = new WebSocket("ws://localhost:3000");
    ws.addEventListener('open', function (e) {
        let delayWebsocket = setInterval(function () {
            if (ws.readyState == 1) {
                ws.send(JSON.stringify({
                    'keterangan': 'user online',
                    'data': dataUser,
                }));
                clearInterval(delayWebsocket);
            }
        }, 100);
    });
    ws.addEventListener('message', async function (e) {
        let dataJSON = await JSON.parse(e.data);
        if (!dataJSON.keterangan) {
            // if (dataJSON.userOfflineBaru) {
            //     const userOffline = dataJSON.userOfflineBaru;
            //     iziToast.show({
            //         title: `${userOffline.nama} (${userOffline.role})  offline`,
            //         position: 'topRight',
            //         theme: 'light',
            //         timeout: 2000,
            //         color: 'yellow',
            //         progressBar: false,
            //     });
            // } else {
            //     const userOnline = dataJSON.userOnlineBaru;
            //     if (userOnline.id != dataUser.id) {
            //         iziToast.show({
            //             title: `${userOnline.nama} (${userOnline.role})  online`,
            //             position: 'topRight',
            //             theme: 'light',
            //             timeout: 2000,
            //             color: 'green',
            //             progressBar: false,
            //         });
            //     }

            // }
            const tableUserOnline = document.querySelector('.tbody-table.table-user-online');
            let html = '';
            if (tableUserOnline) {
                if (Object.values(dataJSON.daftarUserOnline).length > 1) {
                    Object.values(dataJSON.daftarUserOnline).forEach(function (el) {
                        if (el.id != dataUser.id) {
                            html += `
                            <tr>
                                <td><span class="badge badge-success">Online</span></td>
                                <td>${el.id}</td>
                                <td>${el.nama} (${el.role})</td>
                            </tr>
                            `;
                        }
                    });
                }
                else {
                    html += `
                        <tr>
                            <td class="d-none">Tidak ada user yang online</td>
                            <td class="d-none">Tidak ada user yang online</td>
                            <td colspan="3" class="font-weight-bold">Tidak ada user yang online</td>
                        </tr>
                    `;
                }
                tableUserOnline.innerHTML = html;
            }
        }
        else {
            const tableAktivitasAdmin = document.querySelector('.tbody-table.table-aktivitas-admin');
            if (tableAktivitasAdmin) {
                let data = await fetch(tableAktivitasAdmin.dataset.url);
                let result = await data.json();
                $('.tbody-table.table-aktivitas-admin').hide();
                let html = '';
                await result.forEach(function (el) {
                    html += `
                 <tr>
                     <td class="align-middle">
                         <b class="text-primary">${el.nama_fromUser} (${el.role_fromUser})</b> mengirim pesan kepada
                         <b class="text-danger">(${el.nama_toUser}) ${el.role_toUser}</b>
                     </td>
                     <td class="align-middle">${el.string_created_at}</td>
                     <td class="align-middle">${el.subject}</td>

                 </tr>
                `;
                });
                tableAktivitasAdmin.innerHTML = html;
                $('.tbody-table.table-aktivitas-admin').fadeIn(2000);
                iziToast.show({
                    title: `Aktivitas baru`,
                    position: 'topRight',
                    theme: 'light',
                    timeout: 2000,
                    color: 'green',
                    progressBar: false,
                });
            }
        }

        if (dataJSON.keterangan == 'kirim surat') {
            if (dataJSON.kepada.id == dataUser.id) {
                const tbodyTable = document.querySelector('.tbody-table.table-surat-masuk');
                if (tbodyTable) {
                    if (tbodyTable) {
                        const urlTbody = tbodyTable.dataset.url;
                        let data = await fetch(urlTbody);
                        let result = await data.json();
                        $('.tbody-table.table-surat-masuk').hide();
                        let html = '';
                        await result.surat.forEach(function (el) {
                            if (el.deleted_in_to == 0) {
                                html += `
                                <tr class="text-dark">
                                    <td class="align-middle text-right">
                                        ${el.is_read == 0 ? '<span class="badge badge-primary">Baru</span>' : '<span style="opacity: 0">Baru</span>'}
                                    </td>
                                    <td class="align-middle">${el.nama} (${el.role})</td>
                                    <td class="align-middle">${el.subject}</td>
                                    <td class="align-middle">
                                        ${el.is_read == 1 ? '<span class="btn btn-success btn-sm">Telah dibaca</span>' : '<span class="btn btn-dark btn-sm">Belum dibaca</span>'}
                                    </td>
                                    <td class="align-middle">${el.string_created_at}</td>
                                    <td class="text-nowrap align-middle">
                                        <button class="btn btn-primary btn-sm tombol-detail penerima"
                                            data-url="${window.location.origin + '/' + window.location.href.split('/')[3] + '/' + el.id}" data-from_id="${el.from_id}" data-is_read="${el.is_read}"><i class="fa fa-fw fa-info-circle"></i> Detail</button>
                                        <a href="${window.location.origin + '/' + window.location.href.split('/')[3] + '/kirim/' + el.id}" class=" btn btn-info btn-sm"><i class="fas fa-fw fa-file-import"></i> Kirim</a>
                                        <form action="${window.location.origin + '/' + window.location.href.split('/')[3] + '/' + el.id + '/penerima'}" method="POST" class="d-inline-block tombol-hapus">
                                            <input type="hidden" name="_token" value="${result.token}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type ="submit" class ="btn btn-danger btn-sm"><i class ="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>`;
                            }
                        });

                        if (tombolHapus) {
                            tombolHapus.forEach(function (el) {
                                el.removeEventListener('click', eventTombolHapus);
                            });
                        }
                        tbodyTable.innerHTML = html;
                        $('.tbody-table.table-surat-masuk').fadeIn(2000);
                        tombolDetail = document.querySelectorAll('.tombol-detail');
                        if (tombolDetail) {
                            tombolDetail.forEach(function (el) {
                                el.addEventListener('click', eventTombolDetail.bind(el));
                            });
                        }
                        tombolHapus = document.querySelectorAll('.tombol-hapus');
                        if (tombolHapus) {
                            tombolHapus.forEach(function (el) {
                                el.addEventListener('click', eventTombolHapus.bind(el));
                            });
                        }
                    }
                }

                iziToast.show({
                    title: `Surat baru dari ${dataJSON.dari.nama} (${dataJSON.dari.role})`,
                    position: 'topRight',
                    theme: 'light',
                    color: 'green',
                    progressBar: false,
                });
            }
        }
        else if (dataJSON.keterangan == 'surat dibaca') {
            if (dataJSON.kepada.id == dataUser.id) {
                const tbodyTableTerkirim = document.querySelector('.tbody-table.surat-terkirim');
                if (tbodyTableTerkirim) {
                    if (tbodyTableTerkirim) {
                        const urlTbodyTableTerkirim = tbodyTableTerkirim.dataset.url;
                        let data = await fetch(urlTbodyTableTerkirim);
                        let result = await data.json();
                        $('.tbody-table.surat-terkirim').hide();
                        let html = '';
                        await result.surat.forEach(function (el) {
                            if (el.deleted_in_from == 0) {
                                html += `
                                    <tr class="text-dark">
                                        <td class="align-middle text-right"><span class="badge badge-warning">Terkirim</span>
                                        </td>
                                        <td class="align-middle">${el.nama} (${el.role})</td>
                                        <td class="align-middle">${el.subject}</td>
                                        <td class="align-middle">
                                            ${el.is_read == 1 ? '<span class="btn btn-success btn-sm">Telah dibaca</span>' : '<span class="btn btn-dark btn-sm">Belum dibaca</span>'}
                                        </td>
                                        <td class="align-middle">${el.string_created_at}</td>
                                        <td class="text-nowrap align-middle">
                                            <button class="btn btn-primary btn-sm tombol-detail"
                                                data-url="${window.location.origin + '/' + window.location.href.split('/')[3] + '/' + el.id}"><i
                                                    class="fa fa-fw fa-info-circle"></i>
                                                Detail</button>
                                            <form action="${window.location.origin + '/' + window.location.href.split('/')[3] + '/' + el.id + '/pengirim'}" method="POST"
                                                class="d-inline-block tombol-hapus">
                                                <input type="hidden" name="_token" value="${result.token}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fas fa-trash"></i> Hapus</button>
                                            </form>

                                        </td>
                                    </tr>`;
                            }
                            if (tombolDetail) {
                                tombolDetail.forEach(function (el) {
                                    el.removeEventListener('click', eventTombolDetail);
                                });
                            }
                            if (tombolHapus) {
                                tombolHapus.forEach(function (el) {
                                    el.removeEventListener('click', eventTombolHapus);
                                });
                            }
                            tbodyTableTerkirim.innerHTML = html;
                            $('.tbody-table.surat-terkirim').fadeIn(2000);
                            tombolDetail = document.querySelectorAll('.tombol-detail');
                            if (tombolDetail) {
                                tombolDetail.forEach(function (el) {
                                    el.addEventListener('click', eventTombolDetail.bind(el));
                                });
                            }
                            tombolHapus = document.querySelectorAll('.tombol-hapus');
                            if (tombolHapus) {
                                tombolHapus.forEach(function (el) {
                                    el.addEventListener('click', eventTombolHapus.bind(el));
                                });
                            }
                        });
                    }

                    iziToast.show({
                        title: `Surat telah dibaca oleh ${dataJSON.dari.nama} (${dataJSON.dari.role})`,
                        position: 'topRight',
                        theme: 'light',
                        timeout: 2000,
                        color: 'green',
                        progressBar: false,
                    });
                }
            }
        }
    });

    const tombolTambah = document.querySelector('.tombol-tambah');
    if (tombolTambah) {
        tombolTambah.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin mengirim surat ini?',
                text: "Periksa data kembali!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, kirim!',
                cancelButtonText: 'Batal'
            }).then(async (result) => {
                if (result.value) {
                    this.submit();
                }
            });
        });
    }

    const tombolEdit = document.querySelector('.tombol-edit');
    if (tombolEdit) {
        tombolEdit.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin menyimpan perubahan ini?',
                text: "Periksa kembali perubahan!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    this.submit();
                }
            });
        });
    }

    $("#dataTable").DataTable();

    $('.custom-file-input').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // Message
    const flashdata = document.querySelector('.flashdata');
    if (flashdata) {
        const toID = document.querySelector('.data-to_id');
        const message = flashdata.children;
        Swal.fire({
            icon: message[0].innerHTML,
            title: message[1].innerHTML,
            text: message[2].innerHTML,
            showConfirmButton: false,
            timer: 1500
        });
        if (toID) {
            let delayWebsocket = setInterval(function () {
                if (ws.readyState == 1) {
                    ws.send(JSON.stringify({
                        'keterangan': 'kirim surat',
                        'dari': dataUser,
                        'kepada': {
                            id: toID.innerHTML
                        }
                    }));
                    clearInterval(delayWebsocket);
                }
            }, 100);
        }
    }
});

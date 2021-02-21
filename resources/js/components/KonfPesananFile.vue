<template>
    <div>
        <div class="row justify-content-between mb-4 ml-0 mr-2">
            <div class="custom-control custom-checkbox mt-2 ml-1">
                <input
                    type="checkbox"
                    class="custom-control-input"
                    @click="checkAll()"
                    v-model="isCheckAll"
                    id="PilihSemua"
                />
                <label class="custom-control-label" for="PilihSemua">
                    Pilih Semua
                </label>
            </div>
            <button
                type="button"
                class="btn btn-primary-yellow btn-rounded ml-1 pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center"
                onclick="window.location.href=''"
                style="border-radius: 30px"
            >
                Tambah File
            </button>
        </div>
        <table class="table table-hover mb-9">
            <thead
                class="bg-primary-purple text-white"
                style="border-radius: 25px 25px 15px 15px"
            >
                <tr>
                    <th scope="col-md-auto"></th>
                    <th scope="col-md-auto">ID</th>
                    <th scope="col-md-auto">Nama File</th>
                    <th scope="col-md-auto">Produk</th>
                    <th scope="col-md-auto">Biaya</th>
                    <th scope="col-md-auto"></th>
                </tr>
            </thead>
            <tbody style="font-size: 14px">
                <tr v-for="(f, idx) in konFiles" :key="idx">
                    <td scope="row">
                        <div class="custom-control custom-checkbox mt-0 ml-1">
                            <input
                                :id="f.id_konfigurasi"
                                type="checkbox"
                                class="custom-control-input"
                                :value="f.id_konfigurasi"
                                v-model="konFileTerpilih"
                                @change="updateCheckall()"
                            />
                            <label
                                class="custom-control-label"
                                :for="f.id_konfigurasi"
                            ></label>
                        </div>
                    </td>
                    <td>
                        {{ f.id_konfigurasi }}
                    </td>
                    <td>
                        {{ f.nama_file }}
                    </td>
                    <td>
                        {{ f.nama_produk }}
                    </td>
                    <td>Rp.{{ f.biaya }}</td>
                    <td>
                        <span>
                            <i class="material-icons mr-2 pointer"> edit </i>
                            <i
                                class="material-icons pointer"
                                style="color: red"
                            >
                                delete
                            </i>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ["konFiles"],
    data() {
        return {
            isCheckAll: true,
            konFileTerpilih: [],
            pesanan: {},
        };
    },
    methods: {
        checkAll: function () {
            this.isCheckAll = !this.isCheckAll;
            this.konFileTerpilih = [];
            if (this.isCheckAll) {
                for (var key in this.konFiles) {
                    this.konFileTerpilih.push(
                        this.konFiles[key].id_konfigurasi
                    );
                }
            }
        },
        updateCheckall: function () {
            if (this.konFileTerpilih.length == this.konFiles.length) {
                this.isCheckAll = true;
            } else {
                this.isCheckAll = false;
            }
        },
    },
    mounted() {},
    created() {
        this.konFiles.forEach((v) => {
            this.konFileTerpilih.push(v.id_konfigurasi);
        });
    },
};
</script>

<style></style>

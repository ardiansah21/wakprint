<template>
    <div class="container mt-5 mb-5">
        <label class="font-weight-bold" style="font-size: 48px"
            >Konfigurasi Pesanan</label
        >
        <div class="row justify-content-between mb-5">
            <div class="col-md-4 mt-5" style="border-radius: 10px">
                <div
                    class="bg-light-purple pl-4 pr-4 pt-4 pb-4 mb-4"
                    style="border-radius: 10px"
                >
                    <label class="font-weight-bold mb-3" style="font-size: 24px"
                        >Penerimaan</label
                    >
                    <!-- {{ penerimaan }} -->
                    <div
                        class="form-group custom-control custom-radio mb-4"
                        style="font-size: 14px"
                    >
                        <input
                            id="rbAmbilTempat"
                            name="radio"
                            class="custom-control-input"
                            type="radio"
                            value="Ditempat"
                            v-model="penerimaan"
                            checked
                        />
                        <label class="custom-control-label" for="rbAmbilTempat"
                            >Ambil di Tempat Percetakan</label
                        >
                        <label class="text-truncate-multiline mb-2">
                            <!-- {{ $konfigurasi->product->partner->alamat_toko ?? '-' }} -->
                        </label>
                    </div>
                    <div
                        class="form-group custom-control custom-radio mr-0 mb-4"
                    >
                        <div class="row justify-content-between ml-0">
                            <input
                                id="rbAntarTempat"
                                name="radio"
                                class="custom-control-input"
                                type="radio"
                                v-model="penerimaan"
                                value="Diantar"
                            />
                            <label
                                class="custom-control-label"
                                for="rbAntarTempat"
                                >Pengantaran</label
                            >
                            <a
                                class="col-md-auto text-right mb-2"
                                href="/profil/alamat?fromOrder=true"
                                style="font-size: 12px"
                            >
                                {{
                                    member.alamat.alamat.length !== null ? "Ubah" : ""
                                }}
                            </a>
                        </div>
                        <label v-if="member.alamat.alamat.length !== 0" class="text-truncate SemiBold mb-2 ml-0">
                            <!-- TODO: buat pengecekan jika belum ada alamat -->
                            {{
                                member.alamat.alamat.length !== 0
                                    ? member.alamat.alamat[
                                        member.alamat.IdAlamatUtama
                                    ]["NamaPenerima"]
                                    : member.nama_lengkap
                            }}
                        </label>
                        <label
                            v-if="member.alamat.alamat.length !== 0"
                            class="text-truncate-multiline mb-2 ml-0 mb-5"
                        >
                            {{
                                member.alamat.alamat[
                                    member.alamat.alamat.IdAlamatUtama
                                ]["AlamatJalan"]
                            }},
                            {{
                                member.alamat.alamat[
                                    member.alamat.alamat.IdAlamatUtama
                                ]["Kelurahan"]
                            }},
                            {{
                                member.alamat.alamat[
                                    member.alamat.alamat.IdAlamatUtama
                                ]["Kecamatan"]
                            }},
                            {{
                                member.alamat.alamat[
                                    member.alamat.alamat.IdAlamatUtama
                                ]["KabupatenKota"]
                            }},
                            {{
                                member.alamat.alamat[
                                    member.alamat.alamat.IdAlamatUtama
                                ]["Provinsi"]
                            }},
                            {{
                                member.alamat.alamat[
                                    member.alamat.alamat.IdAlamatUtama
                                ]["KodePos"]
                            }},
                        </label>
                        <label
                            v-else
                            class="text-truncate-multiline mb-2 ml-0 mb-5"
                        >
                            -
                        </label>
                    </div>
                    <div
                        v-show="penerimaan === 'Diantar'"
                        class="row justify-content-between"
                    >
                        <label class="col-md-auto font-weight-bold mb-2"
                            >Biaya</label
                        >
                        <label
                            class="col-md-auto font-weight-bold text-right mb-2"
                            >{{ rupiah(ongkir) }}</label
                        >
                    </div>
                    <!-- <button
                        @click="() => this.$root.gotosite('/profil/alamat')"
                    >
                        test
                    </button>-->
                </div>
                <div
                    class="bg-light-purple pl-4 pr-4 pt-4 pb-4"
                    style="border-radius: 10px; font-size: 14px"
                >
                    <label class="font-weight-bold mb-3" style="font-size: 24px"
                        >Ringkasan Pemesanan</label
                    >
                    <div class="row justify-content-between">
                        <label id="subTotalFile" class="col-md-auto mb-2"
                            >Subtotal {{ konFileTerpilih.length }} file</label
                        >
                        <label class="col-md-auto text-right mb-2">{{
                            rupiah(onSubtotalFile())
                        }}</label>
                    </div>
                    <div
                        v-show="onSubtotalAtk().jumlahJenis > 0"
                        class="row justify-content-between"
                    >
                        <label class="col-md-auto mb-2">
                            Subtotal {{ onSubtotalAtk().jumlahJenis }} jenis atk
                            x {{ onSubtotalAtk().jumlahTotal }}
                            buah
                        </label>
                        <label class="col-md-auto text-right mb-2">{{
                            rupiah(onSubtotalAtk().total)
                        }}</label>
                    </div>

                    <div
                        v-show="penerimaan === 'Diantar'"
                        class="row justify-content-between mb-2"
                    >
                        <label class="col-md-auto mb-2">Biaya Pengiriman</label>
                        <label class="col-md-auto text-right mb-2">{{
                            rupiah(ongkir)
                        }}</label>
                    </div>
                    <div class="row justify-content-between">
                        <label class="col-md-auto SemiBold mb-2">Total</label>
                        <label
                            id="totalHargaPesanan"
                            class="col-md-auto SemiBold text-right mb-2"
                            >{{ rupiah(onTotalBiaya()) }}</label
                        >
                    </div>
                    <div class="row justify-content-between">
                        <label class="col-md-auto SemiBold mb-2"
                            >Saldo Kamu</label
                        >
                        <label class="col-md-auto SemiBold text-right mb-2">
                            {{
                                rupiah(
                                    member.jumlah_saldo != null
                                        ? member.jumlah_saldo
                                        : 0
                                )
                            }}
                        </label>
                    </div>
                    <div class="row justify-content-between">
                        <label class="col-md-auto SemiBold mb-2"
                            >Sisa Saldo Kamu</label
                        >
                        <label class="col-md-auto SemiBold text-right mb-3">{{
                            rupiah(member.jumlah_saldo - onTotalBiaya())
                        }}</label>
                    </div>
                    <label
                        v-show="
                            member.jumlah_saldo == null ||
                            onTotalBiaya() > member.jumlah_saldo
                        "
                        class="text-muted text-justify mb-2"
                    >
                        Saldo kamu tidak mencukupi, silahkan melakukan pengisian
                        saldo setelah pesanan kamu dibuat"
                    </label>
                </div>
            </div>
            <div class="col-md-8 ml-0 mt-5" style="font-size: 18px">
                <div class="row justify-content-between mb-4 ml-0 mr-2">
                    <div class="custom-control custom-checkbox mt-2 ml-1">
                        <input
                            type="checkbox"
                            class="custom-control-input"
                            @click="checkAll()"
                            v-model="isCheckAll"
                            id="PilihSemua"
                        />
                        <label class="custom-control-label" for="PilihSemua"
                            >Pilih Semua</label
                        >
                    </div>
                    <button
                        type="button"
                        class="btn btn-primary-yellow btn-rounded ml-1 pt-1 pb-1 pl-4 pr-4 font-weight-bold text-center"
                        style="border-radius: 30px"
                        onclick="window.location.href='/konfigurasi-file'">
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
                    <!-- <div
                class="table-scrollbar pl-0 pr-2 mb-5"
                style="max-height: 270px"
                    >-->
                    <tbody style="font-size: 14px">
                        <tr v-for="(f, idx) in konFiles" :key="idx">
                            <td scope="row">
                                <div
                                    class="custom-control custom-checkbox mt-0 ml-1"
                                >
                                    <input
                                        :id="f.id_konfigurasi"
                                        type="checkbox"
                                        class="custom-control-input"
                                        :value="f.id_konfigurasi"
                                        v-model="konFileTerpilih"
                                        @click="updateCheckall()"
                                    />
                                    <label
                                        class="custom-control-label"
                                        :for="f.id_konfigurasi"
                                    ></label>
                                </div>
                            </td>
                            <td>{{ f.id_konfigurasi }}</td>
                            <td>{{ f.nama_file }}</td>
                            <td>{{ f.nama_produk }}</td>
                            <td>{{ rupiah(f.biaya) }}</td>
                            <td>
                                <span>
                                    <i
                                        class="material-icons mr-2 pointer"
                                        @click="onEditKonfigurasi(f.id_konfigurasi)">
                                        edit
                                    </i>
                                    <i
                                        class="material-icons pointer"
                                        style="color: red"
                                        @click="
                                            onHapusKonfigurasi(f.id_konfigurasi)
                                        "
                                        >delete</i
                                    >
                                </span>
                            </td>
                        </tr>
                    </tbody>
                    <!-- </div> -->
                </table>
                <label class="SemiBold mb-2 ml-0 mr-2">ATK</label>
                <div
                    v-for="(atk, i) in atks"
                    :key="i"
                    class="row justify-content-between ml-0 mr-2"
                >
                    <div
                        class="col-md-4 form-group custom-control custom-checkbox"
                    >
                        <!-- <input
                            :id="atk.id_atk + '_atk'"
                            type="checkbox"
                            class="custom-control-input"
                            style="width: 100%"
                            v-model="jumlahPerAtk[atk.id_atk].terpilih"
                        />-->
                        <input
                            type="checkbox"
                            :id="atk.id_atk + '_atk'"
                            class="custom-control-input"
                            style="width: 100%"
                            v-model="atkTerpilih"
                            :value="atk.id_atk"
                        />

                        <!--
                            :value="{
                                id: atk.id_atk,
                                jumlah: jumlahPerAtk[atk.id_atk],
                        }"-->
                        <label
                            class="custom-control-label text-break align-middle"
                            :for="atk.id_atk + '_atk'"
                            style="width: 100%"
                        >
                            {{ atk.nama }}
                            <!-- <i
                                class="material-icons align-middle ml-2"
                                style="color: #c4c4c4"
                                >help</i
                            > -->
                        </label>
                    </div>
                    <div class="col-md-auto form-group">
                        <!-- <vue-numeric-input
                            size="100px"
                            align="center"
                            :v-model="jumlahPerAtk[atk.id_atk]"
                            :value="1"
                            :min="1"
                            :max="atk.jumlah"
                            :step="1"
                            :disabled="isDisabled(atk.id_atk)"
                            @change="(val) => tt(val)"
                            @blur="tt(value)"
                        ></vue-numeric-input>-->

                        <vue-numeric-input
                            size="100px"
                            align="center"
                            :min="1"
                            :max="atk.jumlah"
                            :step="1"
                            v-model="jumlahPerAtk[atk.id_atk]"
                            :disabled="isDisabled(atk.id_atk)"
                        ></vue-numeric-input>
                    </div>
                    <div class="col-md-4 text-right">
                        <label
                            id="hargaAtkLabel"
                            class="SemiBold mb-2 ml-0"
                            style="width: 100%"
                            >{{ rupiah(atk.harga) }}</label
                        >
                    </div>
                </div>
            </div>
        </div>
        <button
            class="btn btn-primary-wakprint btn-lg btn-block font-weight-bold mb-5"
            style="border-radius: 30px; font-size: 24px"
            @click="buatPesanan()"
        >
            Buat Pesanan
        </button>
    </div>
</template>

<script>
import VueNumericInput from "vue-numeric-input";

export default {
    props: ["member", "konFiles", "atks"],
    data() {
        return {
            isCheckAll: true,
            konFileTerpilih: [], //id
            atkTerpilih: [], //id
            jumlahPerAtk: [],
            penerimaan: "Ditempat",
            ongkir: 10000,
        };
    },
    methods: {
        checkAll: function () {
            this.isCheckAll = !this.isCheckAll;
            this.konFileTerpilih = [];
            if (this.isCheckAll) {
                // Check all
                for (var key in this.konFiles) {
                    this.konFileTerpilih.push(
                        this.konFiles[key].id_konfigurasi
                    );
                }
            }
        },
        updateCheckall: function () {
            if (this.konFileTerpilih.length == this.konFiles.length) {
                this.isCheckAll = false;
            } else {
                this.isCheckAll = true;
            }
        },
        isDisabled: function (id) {
            return !this.atkTerpilih.includes(id);
            // return this.atkTerpilih.find((o) => o.id === id) == undefined;
        },
        onSubtotalFile: function () {
            var totalBiayaFile = 0;
            this.konFileTerpilih.forEach((v) => {
                totalBiayaFile += this.konFiles[
                    indexWhere(this.konFiles, (f) => f.id_konfigurasi == v)
                ].biaya;
            });
            return totalBiayaFile;
        },
        onSubtotalAtk: function () {
            var atk = new Object();
            atk.total = 0;
            atk.jumlahJenis = 0;
            atk.jumlahTotal = 0;
            this.atkTerpilih.forEach((v, i) => {
                var idx = indexWhere(this.atks, (atk) => atk.id_atk == v);
                atk.total += this.jumlahPerAtk[v] * this.atks[idx].harga;
                atk.jumlahTotal += this.jumlahPerAtk[v];
            });
            atk.jumlahJenis = this.atkTerpilih.length;
            return atk;
        },
        onDetailAtkShare: function () {
            var arr = new Array();
            this.atkTerpilih.forEach((v, i) => {
                var atk = new Array();
                var idx = indexWhere(this.atks, (atk) => atk.id_atk == v);
                atk[0] = this.atks[idx].nama;
                atk[1] = this.atks[idx].harga;
                atk[2] = this.jumlahPerAtk[v];
                atk[3] = atk[1] * atk[2];
                arr.push(atk);
            });
            return arr;
        },
        onTotalBiaya: function () {
            var _ongkir = this.penerimaan === "Diantar" ? this.ongkir : 0;
            return _ongkir + this.onSubtotalFile() + this.onSubtotalAtk().total;
        },
        rupiah: function (val) {
            return (
                "Rp." +
                val.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1.")
            );
        },
        onEditKonfigurasi: function (id) {
            window.location.href="konfigurasi-file/edit/" + id;
        },
        onHapusKonfigurasi: function (id) {
            axios.delete("/konfigurasi-file/delete/" + id).then((res) => {
                if (res.status == 204) {
                    alert("Konfigurasi File Berhasil di hapus");
                    location.reload();
                }
            });
        },
        buatPesanan: function () {
            axios.post("/konfigurasi-pesanan/create", {
                    konFileTerpilih: this.konFileTerpilih,
                    atks: this.onDetailAtkShare(),
                    penerimaan: this.penerimaan,
                    subTotalFile: this.onSubtotalFile(),
                    ongkir: this.ongkir,
                    totalBiaya: this.onTotalBiaya(),
                }).then((response) => {
                    if (response.status == 201) {
                        var data = response.data;
                        this.$root.gotosite(
                            "/konfigurasi-pesanan/konfirmasi?" +
                                "atks=" +
                                data.atks +
                                "&konFileTerpilih=" +
                                data.konFileTerpilih +
                                "&penerimaan=" +
                                data.penerimaan +
                                "&subTotalFile=" +
                                data.subTotalFile +
                                "&ongkir=" +
                                data.ongkir +
                                "&totalBiaya=" +
                                data.totalBiaya
                        );
                    }
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    created() {
        this.konFiles.forEach((v) => {
            this.konFileTerpilih.push(v.id_konfigurasi);
        });
        // this.atks.forEach((v) => {
        //     this.jumlahPerAtk[v.id_atk] = { terpilih: Boolean, jumlah: 1 };
        // });
        this.atks.forEach((v) => {
            this.jumlahPerAtk[v.id_atk] = 1;
        });
    },
    mounted() {},
    components: {
        VueNumericInput,
    },
};
function indexWhere(array, conditionFn) {
    const item = array.find(conditionFn);
    return array.indexOf(item);
}
</script>

<style>
.vue-numeric-input .btn {
    background: #bc41be !important;
}
</style>

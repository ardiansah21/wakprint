<template>
    <div>
        <div class="search-input mr-0 ml-2 mb-4">
            <div
                class="input-group main-search-input-p mr-0 justify-content-between"
            >
                <input
                    v-model="search"
                    id="keyword"
                    type="text"
                    role="search"
                    class="form-control"
                    placeholder="Cari produk disini"
                    aria-label="Cari produk disini"
                    aria-describedby="basic-addon2"
                    style="
                        border: 0px solid white;
                        border-radius: 30px;
                        font-size: 18px;
                    "
                />

                <i id="cari" class="material-icons my-auto mx-1" style
                    >search</i
                >
            </div>
        </div>

        <div class="mb-4 ml-0">
            <!-- <div class="col-md-3"> -->
            <!-- btn-group-toggle -->
            <div
                class="btn-group btn-group-toggle mb-4 ml-2"
                style="display: inline-table; !importaint"
            >
                <label
                    for="checkboxSemua"
                    class="btn btn-yellow-wakprint btn-outline-black mr-2 pt-1 pb-1 pl-4 pr-4 mt-2"
                    style="border-radius: 30px; font-size: 18px"
                    :class="{ active: isCheckAll }"
                >
                    <input
                        id="checkboxSemua"
                        type="checkbox"
                        v-model="isCheckAll"
                        @click="checkAll()"
                    />
                    Semua
                </label>
                <label
                    v-for="(j, i) in jenis_kertas"
                    :key="i"
                    :for="j"
                    class="btn btn-yellow-wakprint btn-outline-black mt-2 mr-2 pt-1 pb-1 pl-4 pr-4"
                    :class="{ active: jenisKertasTerpilih.includes(j) }"
                    style="border-radius: 30px; font-size: 18px"
                >
                    <input
                        :id="j"
                        type="checkbox"
                        :value="j"
                        v-model="jenisKertasTerpilih"
                        @change="updateCheckall()"
                    />
                    {{ j }}
                </label>
            </div>
            <div class="row justify-content-between px-2">
                <div class="col-ml-auto ml-3">
                    <!-- <select v-model="urutkan">
                        <option disabled value>Ururtkan</option>
                        <option>Terbaru</option>
                        <option>Harga Berwarna Tertinggi</option>
                        <option>Harga Berwarna Terendah</option>
                        <option>Harga Hitam-Putih Tertinggi</option>
                        <option>Harga Hitam-Putih Terendah</option>
                    </select>-->
                    <div class="dropdown">
                        <button
                            id="dropdownFilterProduk"
                            class="is-flex btn btn-default btn-lg shadow-sm dropdown-toggle border border-gray"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            style="font-size: 16px; text-align: left"
                        >
                            {{ urutkan == "" ? "Urutkan" : urutkan }}
                        </button>

                        <div
                            id="filterProdukList"
                            class="dropdown-menu"
                            aria-labelledby="dropdownKertas"
                            style="font-size: 16px"
                        >
                            <span
                                class="dropdown-item cursor-pointer"
                                @click="onSort('Terbaru')"
                                >Terbaru</span
                            >
                            <span
                                class="dropdown-item cursor-pointer"
                                @click="onSort('Harga Berwarna Tertinggi')"
                                >Harga Berwarna Tertinggi</span
                            >
                            <span
                                class="dropdown-item cursor-pointer"
                                @click="onSort('Harga Berwarna Terendah')"
                                >Harga Berwarna Terendah</span
                            >
                            <span
                                class="dropdown-item cursor-pointer"
                                @click="onSort('Harga Hitam-Putih Tertinggi')"
                                >Harga Hitam-Putih Tertinggi</span
                            >
                            <span
                                class="dropdown-item cursor-pointer"
                                @click="onSort('Harga Hitam-Putih Terendah')"
                                >Harga Hitam-Putih Terendah</span
                            >
                        </div>
                    </div>
                </div>

                <div class="col-ml-auto">
                    <div class="btn-group btn-group-toggle">
                        <label
                            v-for="(jp, i) in jenis_printer_show"
                            :key="i"
                            class="btn btn-yellow-wakprint btn-outline-black ml-1 mr-1 pt-1 pb-1 pl-4 pr-4"
                            style="border-radius: 30px; font-size: 18px"
                            :class="{ active: jenis_printer.includes(jp) }"
                        >
                            <input
                                :id="jp"
                                type="checkbox"
                                autocomplete="off"
                                :value="jp"
                                v-model="jenis_printer"
                            />
                            {{ jp }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="container bg-light-purple pt-3 pb-3 pl-4 pr-4 mb-4 ml-2"
            style="border-radius: 5px"
        >
            <label class="SemiBold mb-2 ml-0" style="font-size: 18px"
                >Fitur</label
            >
            <br />
            <div class="container" style="font-size: 18px">
                <div
                    v-for="(f, i) in fitur"
                    :key="i"
                    class="row custom-control custom-checkbox justify-content-left ml-0"
                >
                    <div class="ml-1 mr-4">
                        <div class="row">
                            <input
                                type="checkbox"
                                class="custom-control-input"
                                :id="f.uniqid"
                                :value="f"
                                v-model="fiturTerpilih"
                            />
                            <label class="custom-control-label" :for="f.uniqid">
                                {{ f.nama }}
                                <!-- <i v-tooltip ="{
                                    content: f.deskripsi,
                                    placement: 'right-center',
                                    classes: ['info'],
                                    targetClasses: ['it-has-a-tooltip'],
                                    offset: 16,
                                    delay: {
                                    show: 500,
                                    hide: 300,
                                    },}"
                                class="material-icons md-18 align-middle ml-2" style="color:#C4C4C4">help</i> -->
                            </label>
                            <v-popover
                                trigger="hover"
                                :placement="'right'"
                                :offset="0"
                                :delay="{ show: 500, hide: 300 }"
                            >
                                <i
                                    class="material-icons md-18 align-middle ml-2"
                                    style="color: #c4c4c4"
                                    >help</i
                                >
                                <template slot="popover">
                                    <img
                                        v-show="f.foto_fitur"
                                        :src="f.foto_fitur"
                                        class="img-thumbnail ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                                        alt="foto fitur"
                                    />
                                    <h5>{{ f.deskripsi }}</h5>
                                </template>
                            </v-popover>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mr-0 ml-2">
            <div class="produk row justify-content-between mb-4 ml-0 mr-0">
                <h1 class="center" v-show="filteredListProduct.length == 0">
                    Maaf produk tidak ditemukan
                </h1>
                <!-- <img
                    v-show="this.$root.loading"
                    src="https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif"
                    style="position: absolute;"
                /> -->
                <!-- {{filteredListProduct}} -->
                <div
                    v-for="(p, i) in filteredListProduct"
                    :key="i"
                    class="col-md-6 mb-4"
                >
                    <card-produk-component
                        :produk="p"
                        :isFavorite="
                            produk_favorit_member.includes(p.id_produk)
                        "
                        @update-favorite="produk_favorit_member = $event"
                    ></card-produk-component>
                </div>
            </div>
        </div>

        <!-- // -->
    </div>
</template>

<script>
import cardProdukComponent from "./cardProdukComponent.vue";
export default {
    components: { cardProdukComponent },
    props: ["produks"],
    data() {
        return {
            isCheckAll: true,
            search: "",
            urutkan: "",
            jenis_kertas: [],
            jenisKertasTerpilih: [],
            jenis_printer_show: [],
            jenis_printer: [],
            fitur: [],
            fiturTerpilih: [],
            produk_favorit_member: [],
        };
    },
    methods: {
        checkAll: function () {
            this.isCheckAll = !this.isCheckAll;
            this.jenisKertasTerpilih = [];
            if (this.isCheckAll) {
                this.jenis_kertas.forEach((e) => {
                    this.jenisKertasTerpilih.push(e);
                });
            }
        },
        updateCheckall: function () {
            if (this.jenisKertasTerpilih.length == this.jenis_kertas.length) {
                this.isCheckAll = true;
            } else {
                this.isCheckAll = false;
            }
        },
        onSort: function (val) {
            this.urutkan = val;
        },
    },

    computed: {
        filteredListProduct() {
            // return this.produks.filter((p) => {
            //     return p.nama.toLowerCase().includes(this.search.toLowerCase());
            // });

            var sort = this.urutkan;
            var up = "asc";
            function col() {
                switch (sort) {
                    case "Terbaru":
                        return "created_at";
                        break;
                    case "Harga Berwarna Tertinggi":
                        up = "desc";
                        return "harga_berwarna";
                        break;
                    case "Harga Berwarna Terendah":
                        return "harga_berwarna";
                        break;
                    case "Harga Hitam-Putih Tertinggi":
                        up = "desc";
                        return "harga_hitam_putih";
                        break;
                    case "Harga Hitam-Putih Terendah":
                        return "harga_hitam_putih";
                        break;
                    default:
                        return "nama";
                        break;
                }
            }

            return _.orderBy(
                this.produks.filter((p) => {
                    var byQuery = this.search
                        .toLowerCase()
                        .split(" ")
                        .every((v) => {
                            return (
                                p.nama.toLowerCase().includes(v) ||
                                p.jenis_kertas.toLowerCase().includes(v) ||
                                p.jenis_printer.toLowerCase().includes(v) ||
                                p.fitur.toLowerCase().includes(v) ||
                                p.deskripsi.toLowerCase().includes(v)
                            );
                        });
                    var byTypePageSheet = this.jenisKertasTerpilih.includes(
                        p.jenis_kertas
                    );
                    var byTypePrinter = this.jenis_printer.includes(
                        p.jenis_printer
                    );
                    var byTypeFeature = true;
                    if (this.fiturTerpilih.length != 0) {
                        for (let i = 0; i < this.fiturTerpilih.length; i++) {
                            const ft = this.fiturTerpilih[i].nama;
                            if (p.fitur.includes(ft)) {
                                byTypeFeature = byTypeFeature && true;
                            } else {
                                byTypeFeature = byTypeFeature && false;
                            }
                        }
                    }

                    return (
                        byQuery &&
                        byTypePageSheet &&
                        byTypePrinter &&
                        byTypeFeature
                    );
                }),
                col(),
                up
            );
        },
    },
    created() {
        this.jenis_kertas = [
            ...new Set(arrayColumn(this.produks, "jenis_kertas")),
        ];

        this.jenisKertasTerpilih = this.jenis_kertas;

        this.jenis_printer_show = [
            ...new Set(arrayColumn(this.produks, "jenis_printer")),
        ];
        this.jenis_printer = this.jenis_printer_show;

        [...new Set(arrayColumn(this.produks, "fitur"))].forEach((f) => {
            this.fitur = JSON.parse(f);
        });

        // this.fiturTerpilih = this.fitur;

        if (Object.keys(this.$root.user_login).length !== 0) {
            this.produk_favorit_member = this.$root.user_login.produk_favorit;
        }
    },
};
function arrayColumn(array, columnName) {
    return array.map(function (value, index) {
        return value[columnName];
    });
}
</script>

<style>
</style>

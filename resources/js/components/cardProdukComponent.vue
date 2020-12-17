<template>
    <div
        class="pointer"
        @click="$root.gotosite('/produk/detail/' + produk.id_produk)"
    >
        <div class="card shadow mb-2" style="border-radius: 10px">
            <div
                v-show="this.produk.status_diskon === 'Tersedia'"
                class="text-center"
                style="position: relative"
            >
                <div
                    class="bg-promo"
                    style="
                        position: absolute;
                        top: 55%;
                        left: 10%;
                        width: 75px;
                        height: 50px;
                        border-radius: 0px 0px 8px 8px;
                    "
                >
                    <label
                        class="font-weight-bold mb-1 mt-3"
                        style="font-size: 12px"
                        >Promo</label
                    >
                </div>
            </div>
            <!-- <span>{{this.$root.member.nama_lengkap}}</span> -->
            <button
                v-show="Object.keys(this.$root.user_login).length !== 0"
                class="btn fa fa-heart fa-2x fa-responsive cursor-pointer"
                :class="{ 'text-danger': isFavorite }"
                @click="setFavorite(produk.id_produk)"
                style="
                    position: absolute;
                    top: 5%;
                    left: 87%;
                    transform: translate(-50%, -50%);
                    -ms-transform: translate(-50%, -50%);
                    background: transparent;
                "
            ></button>
            <img
                class="card-img-top pointer"
                src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg"
                style="height: 180px; border-radius: 10px 10px 0px 0px"
                alt="Terdapat Kesalahan Penampilan Foto"
            />
            <div class="card-body">
                <div class="row justify-content-between">
                    <label
                        class="col-md-7 text-truncate ml-0"
                        style="font-size: 14px"
                    >
                        <!-- {{ produk.nama_toko }} -->
                    </label>
                    <label
                        class="col-md-auto card-text text-right mr-0"
                        style="font-size: 14px"
                    >
                        <i class="material-icons md-18 align-middle mr-0"
                            >location_on</i
                        >
                        100 m
                    </label>
                </div>
                <label
                    class="card-title text-truncate-multiline font-weight-bold"
                    style="font-size: 24px; min-height: 75px"
                    >{{ produk.nama }}</label
                >
                <label
                    class="card-text text-truncate-multiline"
                    style="font-size: 18px; min-height: 62px"
                    >{{ produk.deskripsi }}</label
                >
                <div class="row justify-content-left ml-0 mr-0">
                    <label
                        class="card-text text-truncate SemiBold mr-2"
                        style="font-size: 14px"
                    >
                        <i class="material-icons md-18 align-middle mr-1"
                            >description</i
                        >
                        {{ produk.jenis_kertas }}
                    </label>
                    <label
                        class="card-text text-truncate SemiBold"
                        style="font-size: 14px"
                    >
                        <i class="material-icons md-18 align-middle mr-1"
                            >print</i
                        >
                        {{ produk.jenis_printer }}
                    </label>
                </div>
            </div>
            <div
                class="card-footer card-footer-primary cursor-pointer"
                style="border-radius: 0px 0px 10px 10px"
            >
                <div class="row justify-content-between ml-0 mr-0">
                    <div>
                        <i
                            class="material-icons md-24 align-middle text-white mr-2"
                            >color_lens</i
                        >
                        <label
                            class="card-text SemiBold text-white my-auto mr-2"
                            style="font-size: 16px"
                        >
                            <del
                                v-if="this.produk.status_diskon === 'Tersedia'"
                                >{{
                                    $root.rupiah(produk.harga_hitam_putih)
                                }}</del
                            >
                            <div v-else>
                                {{ $root.rupiah(produk.harga_hitam_putih) }}
                            </div>
                        </label>
                        <label
                            v-show="this.produk.status_diskon === 'Tersedia'"
                            class="card-text SemiBold text-white my-auto mr-2"
                            style="font-size: 16px"
                            >{{ harga_hitamputih_diskon }}</label
                        >
                        <br />
                        <i
                            class="material-icons md-24 align-middle text-primary-yellow mr-2"
                            >color_lens</i
                        >
                        <label
                            class="card-text SemiBold text-primary-yellow my-auto mr-2"
                            style="font-size: 16px"
                        >
                            <del
                                v-if="this.produk.status_diskon === 'Tersedia'"
                                >{{ $root.rupiah(produk.harga_berwarna) }}</del
                            >
                            <div v-else>
                                {{ $root.rupiah(produk.harga_berwarna) }}
                            </div>
                        </label>
                        <label
                            v-show="this.produk.status_diskon === 'Tersedia'"
                            class="card-text SemiBold text-primary-yellow my-auto mr-2"
                            style="font-size: 16px"
                            >{{ harga_berwarna_diskon }}</label
                        >
                    </div>
                    <div class="my-auto">
                        <label
                            class="card-text mt-0 mr-0 SemiBold"
                            style="font-size: 18px"
                        >
                            <i
                                class="material-icons md-24 align-middle mr-1"
                                style="color: #fcff82"
                                >star</i
                            >
                            {{ produk.rating }}
                        </label>
                    </div>
                </div>
            </div>
            <!-- // -->
        </div>
    </div>
</template>

<script>
export default {
    props: ["produk", "isFavorite"],
    data() {
        return {
            harga_berwarna_diskon: 0,
            harga_hitamputih_diskon: 0,
        };
    },
    methods: {
        setFavorite(id) {
            axios
                .post("/favorit/status/" + id, {
                    id_produk: id,
                    fromAxios: true,
                })
                .then((res) => {
                    this.$emit("update-favorite", res.data);
                });
        },
    },
    computed: {},
    mounted() {
        console.log(this.produk.status_diskon);
        if (this.produk.status_diskon === "Tersedia") {
            console.log("adadadada");
            this.harga_berwarna_diskon =
                this.produk.harga_berwarna * this.produk.jumlah_diskon >
                this.produk.maksimal_diskon
                    ? this.produk.harga_berwarna - this.produk.maksimal_diskon
                    : this.produk.harga_berwarna -
                      this.produk.harga_berwarna * this.produk.jumlah_diskon;
            this.harga_hitamputih_diskon =
                this.produk.harga_berwarna * this.produk.jumlah_diskon >
                this.produk.maksimal_diskon
                    ? this.produk.harga_hitam_putih -
                      this.produk.maksimal_diskon
                    : this.produk.harga_hitam_putih -
                      this.produk.harga_hitam_putih * this.produk.jumlah_diskon;
        }
    },
};
</script>

<style>
label {
    cursor: pointer;
}
</style>

<template>
    <div>
        <div
            v-for="(d, i) in data"
            :key="i"
            class="row justify-content-between ml-0 mr-2"
        >
            <div class="col-md-4 form-group custom-control custom-checkbox">
                <input
                    type="checkbox"
                    class="custom-control-input"
                    id="checkboxAtka }}"
                    value="value->nama }}"
                    style="width: 100%"
                />
                <label
                    class="custom-control-label text-break align-middle"
                    for="checkboxAtka }}"
                    style="width: 100%"
                >
                    {{ d.nama }}
                    <i
                        class="material-icons align-middle ml-2"
                        style="color: #c4c4c4"
                        >help</i
                    >
                </label>
            </div>
            <div class="col-md-auto form-group">
                <vue-numeric-input
                    v-model="value"
                    size="100px"
                    align="center"
                    :min="1"
                    :max="10"
                    :step="2"
                ></vue-numeric-input>
            </div>
            <div class="col-md-4 text-right">
                <label
                    id="hargaAtkLabel a }}"
                    class="SemiBold mb-2 ml-0"
                    style="width: 100%"
                >
                    Rp.value->harga
                </label>
            </div>
        </div>
    </div>
</template>

<script>
import VueNumericInput from "vue-numeric-input";
export default {
    props: ["data"],
    data() {
        return {
            value: 1,
        };
    },
    components: {
        VueNumericInput,
    },
};
</script>

<style>
</style>

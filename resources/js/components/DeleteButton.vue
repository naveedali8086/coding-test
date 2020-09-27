<template>

    <button type="button" class="btn btn-danger" @click="deleteAction" :disabled="is_deleting">
        <span v-if="!is_deleting">Delete</span>
        <span v-if="is_deleting" class="spinner-border spinner-border-sm"></span>
    </button>

</template>

<script>
import sendRequest from "../common";

export default {

    props: ['id', 'uri'],

    data: function () {
        return {
            is_deleting: false
        }
    },

    methods: {

        deleteAction: function () {

            this.is_deleting = true;

            let form_data = new FormData();
            // required by Laravel
            form_data.set('_token', document.head.querySelector("meta[name=csrf-token]").content);
            form_data.set('id', this.id);

            sendRequest(`${this.uri}`, 'POST', form_data, () => {
                this.is_deleting = false;

            }, (response) => {
                window.location.reload();
            });

        }

    },
}
</script>

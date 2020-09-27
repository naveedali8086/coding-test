<template>

    <button type="button" class="btn btn-danger" @click="deleteAction">
        <span v-if="!is_deleting">Delete</span>
        <span v-if="is_deleting" class="spinner-border spinner-border-sm"></span>
    </button>

</template>

<script>
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

            // submitting form
            fetch(`${window.location.origin}/coding-test/${this.uri}`, {
                method: 'POST',
                body: form_data,
                headers: {'Accept': 'application/json'}
            }).finally(() => {
                this.is_deleting = false;

            }).then((response) => {

                    const response_code = response.status;

                    response.json().then((response) => {

                        if (response_code === 200) {

                            alert(response.message);

                            if (!response.has_err) {
                                window.location.reload();
                            }

                        } else {
                            console.log(`Looks like there was a problem. Status Code: ${response.status}`);
                            return;
                        }

                    });


                }
            ).catch(function (err) {
                console.log('Fetch Error :-S', err);
            });

        }

    },
}
</script>

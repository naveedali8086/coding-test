<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header font-weight-bold">Create Company</div>

                    <div class="card-body">

                        <form @submit.prevent="onSubmit">

                            <input-control id="name" label="Name" v-bind:error="form_data.errors.name"
                                           v-bind:value="form_data.fields.name"
                                           v-on:input="form_data.fields.name = $event"/>

                            <input-control id="address" label="Address" v-bind:error="form_data.errors.address"
                                           v-bind:value="form_data.fields.address"
                                           v-on:input="form_data.fields.address = $event"/>

                            <input-control id="telephone" label="Telephone" v-bind:error="form_data.errors.telephone"
                                           v-bind:value="form_data.fields.telephone"
                                           v-on:input="form_data.fields.telephone = $event"/>

                            <submit-button v-bind:is_submitting="is_submitting"/>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data: function () {
        return {

            form_data: {

                fields: {
                    name: '',
                    address: '',
                    telephone: '',
                },
                errors: {
                    name: '',
                    address: '',
                    telephone: '',
                },

            },

            is_submitting: false

        }
    },

    methods: {

        onSubmit: function () {

            this.is_submitting = true;
            this.clearErrors();

            let form_data = new FormData();

            const form_fields = this.form_data.fields;
            for (const field_name in form_fields) {
                form_data.set(field_name, form_fields[field_name]);
            }

            // required by Laravel
            form_data.set('_token', document.head.querySelector("meta[name=csrf-token]").content);
alert(`${window.location.origin}/coding-test/save-company`);
            // submitting form
            fetch(`${window.location.origin}/coding-test/save-company`, {
                method: 'POST',
                body: form_data,
                headers: {'Accept': 'application/json'}
            }).finally(() => {
                this.is_submitting = false;

            }).then((response) => {

                    const response_code = response.status;

                    response.json().then((response) => {

                        if (response_code === 200) {
                            if (!response.has_err) {
                                this.resetForm();
                            }
                            alert(response.message);

                        } else if (response_code === 422) { // showing validation errors
                            const errors = response.errors;
                            for (const field_name in errors) {
                                this.form_data.errors[field_name] = errors[field_name][0];
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

        },

        resetForm: function () {
            const fields = this.form_data.fields;
            for (const field_name in fields) {
                this.form_data.fields[field_name] = '';
            }
        },

        clearErrors: function () {
            const errors = this.form_data.errors;
            for (const field_name in errors) {
                this.form_data.errors[field_name] = '';
            }
        }

    },

}
</script>

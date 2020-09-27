<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header font-weight-bold">{{ this.caption }}</div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-striped">
                                <thead>
                                <tr v-html="this.generateHeaderRow()"></tr>
                                </thead>

                                <tbody v-html="generated_row">
                                </tbody>
                            </table>

                        </div>

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
            table_data: [],
            fetching_data: false
        }
    },

    props: ['uri', 'table_headers', 'caption', 'generateBodyRows'],

    methods: {

        getData: function () {

            this.fetching_data = true;

            fetch(`${window.location.origin}/coding-test/${this.uri}`, {
                method: 'GET',
                headers: {'Accept': 'application/json'}
            }).finally(() => {
                this.fetching_data = false;

            }).then((response) => {

                    const response_code = response.status;

                    response.json().then((response) => {

                        if (response_code === 200) {
                            if (!response.has_err) {
                                this.table_data = response.data;
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

        generateHeaderRow() {
            let header_row = '';
            this.table_headers.forEach((column) => {
                header_row += `<th scope="col">${column}</th>`;
            });
            return header_row;
        }

    },

    computed: {
        generated_row: function () {
            return this.generateBodyRows(this.table_data);
        }
    },

    created() {
        this.getData();
    }

}
</script>

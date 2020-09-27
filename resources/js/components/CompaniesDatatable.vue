<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header font-weight-bold">Companies</div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-striped">

                                <thead>

                                <th v-for="column in this.column_names" :key="column" scope="col">{{ column }}</th>

                                </thead>

                                <tbody>

                                <tr v-for="(company, index) in this.table_data" :key="company.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ company.name }}</td>
                                    <td>{{ company.address }}</td>
                                    <td>{{ company.telephone }}</td>
                                    <td>
                                        <delete-button :id="company.id" uri="delete-company"/>
                                        <edit-button :uri="'company/'+company.id"/>
                                    </td>
                                </tr>

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
import sendRequest from "../common";

export default {

    data: function () {

        return {
            column_names: ['S.No.', 'Name', 'Address', 'Telephone', 'Action'],
            table_data: [],
            fetching_data: false
        }

    },

    methods: {

        getData: function () {

            this.fetching_data = true;

            sendRequest('get-companies', 'GET', '', () => {
                this.fetching_data = false;

            }, (response) => {
                this.table_data = response.data;
            });

        }

    },

    created() {
        this.getData();
    }

}
</script>

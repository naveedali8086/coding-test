<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header font-weight-bold">Employees</div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-striped">

                                <thead>

                                <th v-for="column in this.column_names" :key="column" scope="col">{{ column }}</th>

                                </thead>

                                <tbody>

                                <tr v-for="(employee, index) in this.table_data" :key="employee.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ employee.name }}</td>
                                    <td>{{ employee.email }}</td>
                                    <td>{{ employee.mobile_num }}</td>
                                    <td>{{ employee.address }}</td>
                                    <td>{{ employee.salary }}</td>
                                    <td>{{ employee.company }}</td>
                                    <td>
                                        <delete-button :id="employee.id" uri="delete-employee"/>
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
            column_names: ['S.No.', 'Name', 'Email', 'Mobile No', 'Address', 'Salary', 'Company', 'Action'],
            table_data: [],
            fetching_data: false
        }

    },

    methods: {

        getData: function () {

            this.fetching_data = true;

            sendRequest('get-employees', 'GET', '', () => {
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

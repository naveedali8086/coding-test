<template>
    <datatable :table_headers="column_names"
               :uri="uri"
               v-bind:caption="caption"
               v-bind:generateBodyRows="generateBodyRows"/>
</template>

<script>
import Datatable from "./Datatable";

export default {

    components: {Datatable},

    data: function () {

        return {
            column_names: [
                'S.No.',
                'Name',
                'Address',
                'Telephone'
            ],
            caption: 'Companies',
            uri: 'get-companies'
        }
    },

    methods: {

        generateBodyRows: function (data) {
            let body_rows = '';
            let counter = 0;
            data.forEach((obj) => {
                counter++;
                body_rows += `<tr>
                <td>${counter}</td>
                <td>${obj.name}</td>
                <td>${obj.address}</td>
                <td>${obj.telephone}</td>
                </tr>`;
            });
            return body_rows;
        }

    }

}
</script>

<template>
    <div>
        <h2> Registro de Endereços </h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>CEP</th>
                    <th>Logradouro</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>UF</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="address in result">
                    <td>{{ address.cep }}</td>
                    <td>{{ address.logradouro }}</td>
                    <td>{{ address.bairro }}</td>
                    <td>{{ address.cidade }}</td>
                    <td>{{ address.uf }}</td>
                </tr>
            </tbody>
        </table>
        
    </div>
</template>
  
<script>
import Vue from 'vue';
import axios from 'axios';

Vue.use(axios);

export default {
    name: 'ListAddress',
    data() {
        return {
            address: [],
            addresses: {id: '', cep: '', logradouro: '', bairro: '', cidade: '', uf: ''},
        };
    },
    created() {
        this.AddressLoad();
    },
    methods: {AddressLoad() {
        var page = "http://localhost:8000/api/";
        axios.get(page)
        .then(({data}) => {
            console.log(data);
            this.result = data;
        })
        .catch((error) => {
            console.log(error);
        });
    },
}
};


</script>
  
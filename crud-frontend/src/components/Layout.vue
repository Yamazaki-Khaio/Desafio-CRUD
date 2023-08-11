<template>
    <div class="crud-layout">
      <v-container fluid>
        
        <v-row>
          <v-col
            cols="12"
            sm="6"
            md="4"
            lg="3"
            v-for="(address, index) in filteredAddresses"
            :key="index"
          >
            <v-card>
              <v-card-title>{{ address.logradouro }}</v-card-title>
              <v-card-text>
                <p><strong>CEP:</strong> {{ address.cep }}</p>
                <p><strong>Bairro:</strong> {{ address.bairro }}</p>
                <p><strong>Cidade:</strong> {{ address.cidade }}</p>
                <p><strong>UF:</strong> {{ address.uf }}</p>
                <v-btn @click="editAddress(index)" color="primary">Edit</v-btn>
                <v-btn @click="removeAddress(index)" color="error">Remove</v-btn>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="6" md="4" lg="3">
            <v-card>
              <v-card-text>
                <v-text-field
                  v-model="newAddress"
                  label="New Address"
                  placeholder="Enter a new address"
                ></v-text-field>
                <v-btn @click="addAddress" color="success">Add New</v-btn>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="searchQuery"
              label="Search"
              placeholder="Search addresses"
            ></v-text-field>
          </v-col>
        </v-row>
      </v-container>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    data() {
      return {
        addresses: [], // To store fetched addresses
        newAddress: "",
        searchQuery: "",
      };
    },
    computed: {
      filteredAddresses() {
        return this.addresses.filter((address) =>
          address.logradouro.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      },
    },
    methods: {
      async fetchData() {
        try {
          const response = await axios.get("http://localhost:8000/api/");
          this.addresses = response.data;
        } catch (error) {
          console.error("Error fetching data:", error);
        }
      },
      addAddress() {
        // Your logic for adding an address
      },
      editAddress(index) {
        // Your logic for editing an address
      },
      removeAddress(index) {
        // Your logic for removing an address
      },
    },
    mounted() {
      this.fetchData(); // Fetch data when the component is mounted
    },
  };
  </script>
  
  <style scoped>
  .crud-layout {
    margin: 20px;
  }
  </style>
  
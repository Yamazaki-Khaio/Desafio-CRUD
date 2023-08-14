<template>
  <div id="app">
    <Header @openAddAddressModal="openAddAddressModal" />
    <Layout>
      <div class="content">
        <SearchInput v-model="searchQuery" @input="filterAddresses" :placeholder="searchPlaceholder" @search="search" />
        <CardView :addresses="filteredAddresses" @edit="editAddress" @remove="openDeleteConfirmationModal" />
      </div>
    </Layout>
    <Footer />
    <Modal :showModal="showAddAddressModal" @close="closeAddAddressModal">
      <template v-slot:default>
        <AddAddressForm :newAddress="newAddress" :buttonText="formButtonText" :formTitle="formTitle"
          @submit="saveOrUpdateAddress" @cancel="closeAddAddressModal" />
      </template>
      <template v-slot:footer>
      </template>
    </Modal>
    <Modal :showModal="showModalMessage" @close="closeModal">
      <template v-slot:default>
        <div class="modal-content">
          <template v-if="modalMessageType === 'success'">
            <!-- Content for success message -->
            <p>Address added successfully!</p>
          </template>
          <template v-else-if="modalMessageType === 'error'">
            <!-- Content for error message -->
            <p>An error occurred. Please check the form fields and try again.</p>
          </template>
          <template v-else-if="modalMessageType === 'warning'">
            <!-- Content for warning message -->
            <p>Warning: This CEP already exists in the database. Do you still want to add it?</p>
            <button @click="addDuplicateAddress" class="modal-action-button">Add Anyway</button>
          </template>
          <template v-if="modalMessageType === 'delete'">
            <!-- Content for success message -->
            <p>Tem certeza que deseja remover este endereço?</p>
            <button @click="confirmRemoveAddress" class="modal-action-button">Sim</button>
          </template>
        </div>
        <div class="modal-footer">
          <button @click="closeModal" class="modal-close-button">Close</button>
        </div>
      </template>
    </Modal>
  </div>
</template>

<script>
import Header from './components/Header.vue';
import Layout from './components/Layout.vue';
import Footer from './components/Footer.vue';
import CardView from './components/CardView.vue';
import AddAddressForm from './components/Form.vue';
import SearchInput from './components/Input.vue'; // Import your SearchInput component here
import Modal from './components/Modal.vue';
import axios from 'axios';

export default {
  components: {
    Header,
    Layout,
    Footer,
    CardView,
    AddAddressForm,
    SearchInput,
    Modal,
  },
  data() {
    return {
      addresses: [],
      filteredAddresses: [],
      searchQuery: '',
      searchPlaceholder: 'Pesquisar por CEP ou Logradouro...',
      showAddAddressModal: false,
      newAddress: {
        CEP: '',
        Logradouro: '',
        Bairro: '',
        Cidade: '',
        UF: '',
      },
      isEditing: false,
      formButtonText: 'Save',
      formTitle: 'Add New Address',
      showModalMessage: false,
      modalMessageType: '',
      addressToDeleteId: null,
    };
  },
  async created() {
    await this.fetchAddresses();
  },
  methods: {
    closeModal() {
      this.showModalMessage = false;
      this.modalMessageType = '';
    },
    async fetchAddresses() {
      try {
        const response = await axios.get('http://localhost:8000/api/');
        this.addresses = response.data;
        this.filteredAddresses = this.addresses; // Initialize filteredAddresses
      } catch (error) {
        console.error('Error fetching addresses:', error);
      }
    },
    async addAddress(newAddress) {
      try {
        this.editing = false;
        const response = await axios.post('http://localhost:8000/api/save', newAddress);
        this.addresses.push(response.data);
        this.filteredAddresses = this.addresses; // Update filteredAddresses
        this.showModalMessage = true;
        this.modalMessageType = 'success';
      } catch (error) {
        modalMessageType = 'error';
        console.error(error);
      }
    },
    async filterAddresses() {
      this.filteredAddresses = this.addresses.filter(address =>
        address.Logradouro.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
        address.CEP.startsWith(this.searchQuery)
      );
    },
    async editAddress(id) {
      try {
        this.isEditing = true;
        const response = await axios.get(`http://localhost:8000/api/${id}`);
        if (response.status === 200) {
          console.log(response.data)
          this.newAddress = { ...response.data };
          this.showAddAddressModal = true;
          this.formButtonText = 'Update'; // Change button text for editing
          this.formTitle = 'Edit Address'; // Change form title for editing
          this.showModalMessage = true;
          this.modalMessageType = 'success';
        }
      } catch (error) {
        this.modalMessageType = 'error';
        console.error(error);
      }
    },

    async saveOrUpdateAddress(address) {
      try {
        if (this.isEditing) {
          const id = address.id; // Extract ID from the edited address
          const response = await axios.put(`http://localhost:8000/api/update/${id}`, address);
          if (response.status === 200) {
            this.fetchAddresses();
            this.closeAddAddressModal();
            console.log('Address updated successfully');
          }
        } else {
          const response = await axios.post('http://localhost:8000/api/save', address);
          if (response.status === 201) {
            this.fetchAddresses();
            this.closeAddAddressModal();
            console.log('Address added successfully');
          }
        }
      } catch (error) {
        console.error(error);
      }
    },
    async search() {
      console.log('Searching for', this.searchQuery);
      if (this.searchQuery) {
        try {
          const response = await axios.get(`http://localhost:8000/api/search/${this.searchQuery}`);
          if (response.status === 200) {
            if (response.data.length > 0) {
              this.filteredAddresses = response.data;
            } else {
              await this.searchAndSave();
            }
          }
        } catch (error) {
          console.error('Error during search:', error);
        }
      }
    },
    async searchAndSave() {
      console.log('Searching and saving for', this.searchQuery);
      try {
        // Perform Google API search here using this.inputValue
        const googleResponse = await axios.get(`https://maps.googleapis.com/maps/api/geocode/json?address=${this.searchQuery}&key=AIzaSyAMgyQfa8YPpotoHm0HH3bI9z75oNql75w`);
        console.log(googleResponse.data);
        if (googleResponse.data.status === 'OK') {
          const googleResult = googleResponse.data.results[0];
          console.log('Google result:', googleResult.postcode_localities[0]);
          const newAddress = {
            CEP: googleResult.address_components[0].short_name,
            Logradouro: googleResult.address_components[1].short_name,
            Bairro: googleResult.postcode_localities[0],
            Cidade: googleResult.address_components[2].long_name,
            UF: googleResult.address_components[3].short_name,
          };
          // Check if the CEP already exists in your addresses array
          const existingAddress = this.addresses.find(address => address.CEP === newAddress.CEP);

          if (!existingAddress) {
            // Save data to your backend using a POST request
            const saveResponse = await axios.post('http://localhost:8000/api/save', newAddress);
            this.fetchAddresses();
            this.showModalMessage = true;
            this.modalMessageType = 'success';

            // Handle the response of saving data
            console.log('Saved data:', saveResponse.data);
          } else {
            this.modalMessageType = 'warning';
            console.log('CEP already exists:', existingAddress);
          }
        }
      } catch (error) {
        this.modalMessageType = 'error';
        console.error('Error during search and save:', error);
      }
    },

    openDeleteConfirmationModal(id) {
      this.modalMessageType = 'delete';
      this.showModalMessage = true;
      this.addressToDeleteId = id;
    },

    confirmRemoveAddress() {
      this.removeAddress(this.addressToDeleteId)
        .then(() => {
          this.closeModal();
        })
        .catch(error => {
          console.error(error);
        });
    },

    async removeAddress(id) {
      console.log('Removing address with id', id);
      try {
        console.log('Removing address with id', id);
        const response = await axios.delete(`http://localhost:8000/api/delete/${id}`);
        if (response.status === 200) {
          this.addresses = this.addresses.filter(address => address.id !== id);
          this.filteredAddresses = this.addresses;
          this.showModalMessage = true;
          this.modalMessageType = 'remove';
          console.log('Address removed successfully');
        }

      } catch (error) {
        this.modalMessageType = 'error';
        console.error(error);
      }
    },
    openAddAddressModal() {
      this.showAddAddressModal = true;
      this.formButtonText = 'Save';
      this.formTitle = 'Add New Address';
      this.isEditing = false;
    },
    closeAddAddressModal() {
      this.showAddAddressModal = false;
      this.clearFields();
    },
    saveNewAddress() {
      if (this.validateForm()) {
        this.addAddress(this.newAddress);
        this.closeAddAddressModal();
      }
    },
    clearFields() {
      this.newAddress = {
        CEP: '',
        Logradouro: '',
        Bairro: '',
        Cidade: '',
        UF: '',
      };
    },
    validateForm() {
      const requiredFields = ['CEP', 'Logradouro', 'Bairro', 'Cidade', 'UF'];

      for (const field of requiredFields) {
        if (!this.newAddress[field]) {
          // Field is missing, show an error message or handle the error accordingly
          this.showModalMessage = true;
          this.modalMessageType = 'error';
          return false;
        }
      }

      return true;
    },

  },
};
</script>

<style>
.content {
  padding: 20px;
  max-width: 1200px;
  margin: 0 auto;
}

.card-list {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 20px;
  margin-top: 20px;
}

.cancel-button,
.save-button {
  padding: 12px 24px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s, color 0.3s;
}

.cancel-button {
  background-color: #ccc;
  color: white;
}

.save-button {
  background-color: #3498db;
  color: white;
  margin-left: 10px;
}

.cancel-button:hover,
.save-button:hover {
  opacity: 0.8;
}

/* Responsividade */
@media (max-width: 1366px) {

  .cancel-button,
  .save-button {
    padding: 10px 20px;
    font-size: 14px;
  }
}

@media (max-width: 1920px) {

  .cancel-button,
  .save-button {
    padding: 14px 28px;
    font-size: 18px;
  }
}

@media (max-width: 414px) {

  .cancel-button,
  .save-button {
    padding: 8px 16px;
    font-size: 12px;
  }
}
</style>

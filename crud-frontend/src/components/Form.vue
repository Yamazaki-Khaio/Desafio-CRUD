<template>
  <div class="add-address-form">
    <h2>{{ formTitle }}</h2>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="cep">CEP</label>
        <input v-model="newAddress.CEP" type="text" id="cep" placeholder="CEP" />
      </div>
      <div class="form-group">
        <label for="logradouro">Logradouro</label>
        <input v-model="newAddress.Logradouro" type="text" id="logradouro" placeholder="Logradouro" />
      </div>
      <div class="form-group">
        <label for="bairro">Bairro</label>
        <input v-model="newAddress.Bairro" type="text" id="bairro" placeholder="Bairro" />
      </div>
      <div class="form-group">
        <label for="cidade">Cidade</label>
        <input v-model="newAddress.Cidade" type="text" id="cidade" placeholder="Cidade" />
      </div>
      <div class="form-group">
        <label for="uf">UF</label>
        <input v-model="newAddress.UF" type="text" id="uf" placeholder="UF" />
      </div>
      <div class="button-container">
        <button class="cancel-button" @click="cancel">Cancelar</button>
        <button class="save-button" type="submit">{{ buttonText }}</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    newAddress: Object,
    buttonText: String,
    formTitle: String,
  },
  methods: {
    submitForm() {
      this.$emit('submit', this.newAddress);
    },
    cancel() {
      this.$emit('cancel');
    },
  },
};
</script>

<style scoped>
.add-address-form {
  width: 100%;
  max-width: 400px;
  padding: 20px;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
  text-align: center;
}

h2 {
  margin-bottom: 10px;
}

.form-group {
  margin-bottom: 15px;
  text-align: left;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
}

input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.button-container {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

.cancel-button {
  background-color: #ccc;
}

.save-button {
  background-color: #3498db;
  color: white;
  margin-left: 10px;
}

.cancel-button,
.save-button {
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.cancel-button:hover,
.save-button:hover {
  opacity: 0.8;
}
</style>

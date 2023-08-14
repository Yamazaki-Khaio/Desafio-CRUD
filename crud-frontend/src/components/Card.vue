<template>
  <div class="card">
    <h3 class="card-title">CEP: {{ address.CEP }}</h3>
    <p class="card-text">Logradouro: {{ address.Logradouro }}</p>
    <p class="card-text">Bairro: {{ address.Bairro }}</p>
    <p class="card-text">Cidade: {{ address.Cidade }}</p>
    <p class="card-text">UF: {{ address.UF }}</p>
    <div class="button-container">
      <button class="card-button edit-button" @click="editAddress">Edit</button>
      <button class="card-button remove-button" @click="removeAddress">Remove</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    address: Object
  },
  methods: {
    editAddress() {
      this.$emit('edit', this.address.id);
    },
    removeAddress() {
      this.$emit('remove', this.address.id);
    }
  }
};
</script>

<style scoped>
.card {
  padding: 20px;
  background: linear-gradient(135deg, #f8f9fa, #ced4da);
  width: calc(33.33% - 20px);
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 15px;
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
  justify-content: space-between;
  flex-direction: column;
  display: flex;
  margin-bottom: 20px;
  transition: transform 0.2s, box-shadow 0.2s;
}
.card:hover {
  transform: translateY(-3px);
  box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
}

.card-title {
  margin: 0;
  font-size: 1.2rem;
  font-weight: bold;
}

.card-text {
  margin: 5px 0;
  font-size: 1rem;
  color: #555;
}

.button-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 10px;
}

.card-button {
  padding: 8px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.2s;
  font-weight: bold;
  text-transform: uppercase;
  max-width: 45%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.edit-button {
  background-color: #007bff;
  color: white;
}

.remove-button {
  background-color: #dc3545;
  color: white;
}

.card-button:hover {
  opacity: 0.8;
}

/* Responsividade */
@media (max-width: 1366px) {
  .card {
    padding: 15px;
  }

  .card-title {
    font-size: 1rem;
  }

  .card-text {
    font-size: 0.9rem;
  }

  .card-button {
    font-size: 0.8rem;
    padding: 5px 10px;
  }
}

@media (max-width: 1920px) {
  .card {
    padding: 30px;
  }

  .card-title {
    font-size: 1.5rem;
  }

  .card-text {
    font-size: 1.2rem;
  }

  .card-button {
    font-size: 1rem;
    padding: 8px 15px;
  }
}

@media (max-width: 414px) {
  .card {
    padding: 10px;
  }

  .card-title {
    font-size: 0.9rem;
  }

  .card-text {
    font-size: 0.8rem;
  }

  .card-button {
    font-size: 0.7rem;
    padding: 4px 8px;
  }
}
</style>

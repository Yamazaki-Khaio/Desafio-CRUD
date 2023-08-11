<template>
  <v-card class="mx-auto" max-width="280" outlined>
    <v-card-item class="card-item">
      <div class="card-content">
        <div class="text-overline mb-1">{{ address.cep }}</div>
        <div class="text-h6 mb-1">{{ address.logradouro }}</div>
        <div class="text-caption">
          <p><strong>Bairro:</strong> {{ address.bairro }}</p>
          <p><strong>Cidade:</strong> {{ address.cidade }}</p>
          <p><strong>UF:</strong> {{ address.uf }}</p>
        </div>
      </div>
      <v-card-actions class="card-actions">
        <v-btn outlined color="primary" class="btn-edit">Editar</v-btn>
        <v-btn outlined color="error" class="btn-delete">Deletar</v-btn>
      </v-card-actions>
    </v-card-item>
  </v-card>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      address: {
        cep: "",
        logradouro: "",
        bairro: "",
        cidade: "",
        uf: "",
      },
    };
  },
  methods: {
    async fetchData() {
      try {
        const response = await axios.get("http://localhost:8000/api/");
        if (response.data.length > 0) {
          this.address = response.data[0];
        }
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    },
  },
  created() {
    this.fetchData();
  },
};
</script>

<style scoped>
.card-item {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  background-color: #f5f5f5;
  border-radius: 8px;
  padding: 12px;
  transition: background-color 0.3s;
}

.card-item:hover {
  background-color: #e0e0e0;
}

.card-content {
  flex: 1;
}

.card-actions {
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
}

.btn-edit,
.btn-delete {
  font-weight: 600;
  text-transform: none;
  border-radius: 4px;
  padding: 6px 12px;
  margin-top: 8px;
}

.btn-edit {
  color: #2196f3;
  border-color: #2196f3;
}

.btn-delete {
  color: #f44336;
  border-color: #f44336;
}

.text-overline,
.text-h6,
.text-caption {
  margin: 0;
}

/* Your other styles */
</style>

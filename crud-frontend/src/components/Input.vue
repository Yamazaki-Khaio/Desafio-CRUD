<template>
  <div class="search-input">
    <input v-model="searchQuery" @input="handleInput" type="text" :placeholder="placeholder" />
    <button @click="search">Pesquisar</button>
  </div>
</template>

<script>
export default {
  props: {
    value: String,
    placeholder: String,
  },
  data() {
    return {
      searchQuery: this.value,
    };
  },
  methods: {
    handleInput() {
      this.$emit('input', this.searchQuery);
    },
    search() {
      if (this.searchQuery) {
        this.$emit('search', this.searchQuery); // Emit search event to App.vue
      }
    },
  },
};
</script>

<style scoped>
.search-input {
  display: flex;
  align-items: center;
  max-width: 400px;
  margin-bottom: 20px;
}

input {
  flex: 1;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

button {
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  background-color: #3498db;
  color: white;
  font-weight: bold;
  cursor: pointer;
  margin-left: 10px;
}
</style>

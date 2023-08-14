<template>
    <header>
    <div class="header">
        <h1>Desafio Full Stack - Address Manager </h1>
        <button class="add-button" @click="openAddAddressModal">Add New Address</button>
        </div>
    </header>
</template>

<script>
export default {
  methods: {
    openAddAddressModal() {
      this.$emit('openAddAddressModal');
    },
  },
};
</script>

<style scoped>
.header {
    background-color: #333;
    color: #fff;
    text-align: justify-start;
    padding: 10px;
    justify-content: space-between;
}
.add-button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
</style>

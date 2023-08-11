<template>
    <form @submit.prevent="submitForm">
      <slot></slot>
      <button type="submit">Enviar</button>
    </form>
  </template>
  
  <script>
  export default {
    methods: {
      submitForm() {
        this.$emit('submit');
      },
    },
  };
  </script>
  
  <style scoped>
  /* Estilos para o formulário */
  </style>
  
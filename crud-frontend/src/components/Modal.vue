<template>
    <div class="modal">
      <div class="modal-header">
        <slot name="header">Título do Modal</slot>
      </div>
      <div class="modal-body">
        <slot></slot>
      </div>
      <div class="modal-footer">
        <slot name="footer">
          <button @click="closeModal">Fechar</button>
        </slot>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      closeModal() {
        this.$emit('close');
      },
    },
  };
  </script>
  
  <style scoped>
  /* Estilos para o modal */
  </style>
  
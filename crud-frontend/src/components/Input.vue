<template>
  <input v-model="value" placeholder="Pesquise um endereço" />
</template>
  
<script>
export default {
  props: ['value'],
};
</script>
<style>
input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
}

input:focus {
  outline: none;
  border-color: #333;
}

input::placeholder {
  color: #ccc;
}

input:focus::placeholder {
  color: #333;
}

input::-webkit-input-placeholder {
  color: #ccc;
}

</style>
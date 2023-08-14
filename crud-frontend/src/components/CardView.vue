<template>
  <div class="card-list">
    <Card v-for="address in addresses" :key="address.id" :address="address" @edit="editAddress" @remove="removeAddress" />
  </div>
</template>

<script>
import Card from './Card.vue';

export default {
  props: {
    addresses: Array
  },
  components: {
    Card
  },
  methods: {
    editAddress(id) {
      this.$emit('edit', id);
    },
    removeAddress(id) {
      this.$emit('remove', id);
    }
  }
};
</script>

<style scoped>
.card-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin-top: 20px;
}

@media (max-width: 1366px) {
  .card-list {
    justify-content: center;
    margin-top: 10px;
  }
}

@media (max-width: 992px) {
  .card-list {
    flex-direction: column;
    align-items: center;
  }
}

@media (max-width: 1920px) {
  .card-list {
    justify-content: space-between;
    margin-top: 20px;
  }
}

@media (max-width: 414px) {
  .card-list {
    justify-content: center;
    margin-top: 10px;
  }
}
</style>

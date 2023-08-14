<template>
    <footer class="footer">
      <p>&copy; {{ currentYear }} Address Manager</p>
    </footer>
  </template>
  
  <script>
  export default {
    data() {
      return {
        currentYear: new Date().getFullYear(),
      };
    },
  };
  </script>
  
  <style scoped>
  .footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px;
    position: fixed;
    bottom: 0;
    width: 100%;
    z-index: 1; /* Ensure the footer is above other elements */
  }
  </style>
  
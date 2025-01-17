<template>
  <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Mi Perfil</h2>
    
    <!-- Mostrar los datos del perfil si están disponibles -->
    <div v-if="user">
      <p><strong>Nombre:</strong> {{ user.name }}</p>
      <p><strong>Apellido:</strong> {{ user.apellido }}</p>
      <p><strong>Correo electrónico:</strong> {{ user.email }}</p>
      <p><strong>Teléfono:</strong> {{ user.telefono }}</p>
    </div>

    <!-- Mensajes de error -->
    <div v-if="errorMessage" class="text-red-600 text-sm mt-4">{{ errorMessage }}</div>
    
 
    
    <!-- Botón de cerrar sesión -->
    <div class="mt-6">
      <button 
        @click="logout" 
        class="w-full bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 transition"
      >
        Cerrar sesión
      </button>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import axios from 'axios';

interface User {
  name: string;
  apellido: string;
  email: string;
  telefono: string;
}

export default defineComponent({
  name: 'ProfileForm',
  data() {
    return {
      user: null as User | null,
      errorMessage: '',
      successMessage: '',
    };
  },
  mounted() {
    this.checkAuthentication();
    this.fetchProfile();
  },
  methods: {
    checkAuthentication() {
      const token = localStorage.getItem('auth_token');
      if (!token) {
        // Redirigir a la página de inicio de sesión si no hay token
        this.$router.push('/login');
      }
    },
    async fetchProfile() {
      const token = localStorage.getItem('auth_token'); // Obtener el token de localStorage
      
      if (!token) {
        this.errorMessage = "No estás autenticado. Por favor, inicia sesión.";
        return;
      }

      try {
        const response = await axios.get('http://localhost:8000/api/profile', {
          headers: {
            Authorization: `Bearer ${token}`,
          }
        });
        this.user = response.data;
      } catch (error) {
        if (axios.isAxiosError(error)) {
          if (error.response) {
            this.errorMessage = error.response.data.message || "Error al obtener los datos del perfil.";
          } else {
            this.errorMessage = "No se recibió respuesta del servidor.";
          }
        } else {
          this.errorMessage = "Ocurrió un error inesperado.";
        }
      }
    },
    logout() {
      localStorage.removeItem('auth_token'); // Eliminar el token
      this.$router.push('/login'); // Redirigir a la página de inicio de sesión
    }
  }
});
</script>

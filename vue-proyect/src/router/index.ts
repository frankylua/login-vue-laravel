import { createRouter, createWebHistory } from 'vue-router';
import LoginForm from '../components/LoginForm.vue';
import RegisterForm from '../components/RegisterForm.vue';
import ProfileUser from '../components/ProfileUser.vue';


const routes = [
  {
    path: '/',
    redirect: '/login', // Redirige a /login cuando accedes a la raíz
  },
  {
    path: '/login',
    name: 'Login',
    component: LoginForm
  },
  {
    path: '/register',
    name: 'Register',
    component: RegisterForm
  },
  {
    path: '/profile',
    name: 'Profile',
    component: ProfileUser
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;

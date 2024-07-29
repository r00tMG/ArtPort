<script>
import Dropdown from "@/components/Dropdown.vue";

export default {
    name: 'Navbar',
  components: {Dropdown},
  setup(){

    const token = localStorage.getItem('role')
    const name = localStorage.getItem('name')
    const email = localStorage.getItem('email')
    //console.log(token, name, email)
    return {
      token,
      name,
      email
    }

  }

}
</script>

<template>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarData">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <router-link class="navbar-brand" to="/">Art Port</router-link>
            </div>
            <div class="collapse navbar-collapse" id="navbarData">
                <ul class="nav navbar-nav navbar-right">
                    <li><a v-if="name" href="#aboutMe">About Me</a></li>
                    <li><router-link v-if="name" to="/artistes">My Portfolio</router-link></li>
                    <li><a v-if="name" href="#">Contact Me</a></li>
                  <Dropdown />

                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>

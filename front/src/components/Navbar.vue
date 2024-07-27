<script>
import Dropdown from "@/components/Dropdown.vue";

export default {
    name: 'Navbar',
  components: {Dropdown}

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
                    <li><a href="#aboutMe">About Me</a></li>
                    <li><a href="#myPortfolio">My Portfolio</a></li>
                    <li><a href="#contactMe">Contact Me</a></li>
                  <Dropdown />

                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>

</style>

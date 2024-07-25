<script >

import Navbar from "../../components/Navbar.vue";
import Footer from "../../components/Footer.vue";
import {onMounted, ref} from "vue";
import axios from "axios";
import * as assert from "node:assert";

export default {
    name: "ArtisteIndex",
    methods: {assert},
    components:{Navbar,Footer},
    setup(){
        const artistes = ref([])
        onMounted(async () => {
            const r = await axios.get('api/artistes')
            artistes.value = await r.data
            console.log(artistes.value)
        })
        return{
            artistes
        }
    }
}

</script>
<template>


    <!--NAVBAR-->
   <Navbar />


    <div class="container-fluid bg1">
        <div class="container w-75 m-auto">
          <div class="d-flex my-4 justify-content-between ">
            <router-link to="/create" class="btn btn-primary">Create</router-link>
            <h3 style="font-size: 30px" class="underline">Lists of my projects.</h3>
          </div>
          <table class="table table-dark table-responsive">
            <thead>
              <tr class="">
                  <th>Titre</th>
                  <th>Image</th>
                  <th>description</th>
                  <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="artiste in artistes[0]">
                  <td v-text="artiste.titre"></td>
                  <td><img :src="artiste.image" alt="image du projet" width="60px"></td>
                  <td v-text="artiste.description"></td>

              </tr>
            </tbody>
        </table>
        </div>
    </div>


    <!--Third-sec-->
   <Footer />
</template>

<style scoped>
.navbar {
    padding-top: 10px;
    padding-bottom: 10px;
    font-size: 15px;
    letter-spacing: 5px;
    font-family: Montserrat, sans-serif;
}

#navbarData li a:hover {
    color: #f9b433 !important;

}

.bg1 {
    background-color: #eb9e12;
    color: #ffffff;
}

.bg2 {
    background-color: #7b5511;
    color: #ffffff;
}

.bg3 {
    background-color: #48310b;
    color: #ffffff;
}
.container-fluid {
    padding-top: 150px;
    padding-bottom: 70px;
}

.margin {
    margin-bottom: 50px;
}

#the-pic {
    border-radius: 30%;
}

p {
    font-size: 22px;
    font-family: cursive;
    line-height: 40px;
}

h3 {
    font-family: Montserrat, serif !important;
}

.underline {
    text-decoration: underline wavy #d69813;
}

#project a:hover {
    color: #ffffff !important;
    opacity: 0.8;
}

.project-link {
    margin-top: -40px;
    padding-bottom: 40px;
}

.fa {
    padding: 20px;
    font-size: 40px !important;
    text-align: center;
    text-decoration: none;
    margin: 5px 2px;
    border-radius: 50%;
}

fa a:hover {
    opacity: 0.7;
    color: #ffffff;
}

.fa-facebook {
    background: #3B5998;
    color: white;
    width: 80px !important;
    border-radius: 50% !important;
}

.fa-twitter {
    background: #55ACEE;
    color: white;
}

.fa-linkedin {
    background: #007bb5;
    color: white;
}

.fa-instagram {
    background: #125688;
    color: white;
}

.fa-reddit {
    background: #ff5700;
    color: white;
}

.fa-github {
    background: #9a42db;
    color: white;
}
</style>

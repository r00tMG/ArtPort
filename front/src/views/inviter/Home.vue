<script >

import Navbar from "../../components/Navbar.vue";
import Footer from "../../components/Footer.vue";
import {onMounted, ref} from "vue";
import axios from "axios";
import {useRoute} from "vue-router";
import ArtisteLike from "@/views/inviter/ArtisteLike.vue";

export default {
    name: "ArtisteIndex",
    components:{ArtisteLike, Navbar,Footer},

    setup(){
        const artistes = ref([])
        onMounted(async () => {

            const r = await axios.get('http://localhost:8000/api/home',{
              headers:{
                'Accept':`application/json`
              }
            })
            artistes.value = await r.data
            console.log(artistes.value)
        })







      return{
        artistes,

      }
    }
}

</script>
<template>


    <!--NAVBAR-->
   <Navbar />

    <!--First-sec-->
    <div id="aboutMe" class="container-fluid bg1 text-center">
        <h3 class="margin">Hii , I am a Artist.</h3>
        <img src="https://images.pexels.com/photos/92129/pexels-photo-92129.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="a developer pic" class="img-responsive margin" style="display:inline" width="500" height="500" id="the-pic">
        <p>
            I am an aspiring artist, passionate about exploring new creative techniques. I have a foundational understanding of traditional drawing, painting, and digital illustration. My journey in art includes experimenting with different mediums like watercolor, acrylics, and digital tools such as Photoshop and Illustrator. I am currently delving deeper into character design and animation.
        </p>
    </div>

    <!--Second-sec-->
    <div id="myPortfolio" class="container-fluid bg2 text-center">
        <h3 style="margin-top: -5px; margin-bottom: 90px; font-size: 30px; letter-spacing: 6px" class="underline">Here are some of my projects.</h3>
<!--        <div class="row" v-if="artistes[0]">
            <div class="col-sm-4" v-for="artiste in artistes[0]" :key="artiste.id">
                <img :src="artistes.storage + '/' + artiste.image" alt="project pic" class="img-responsive img-fluid margin" style="display:inline" width="300" height="300" id="project-pic-1">
                <p id="project" class="project-link"><router-link :to="`/show/${artiste.id}`" v-text="artiste.titre"></router-link></p>
            </div>
        </div>-->
<!--      <div class="container m-auto">
        <div class="row">
          <div class="card col-md-4 m-3" v-if="artistes[0]" v-for="artiste in artistes[0]" :key="artiste.id" style="width: 24rem;">
            <div class="card-header">{{ artiste.user.name }}</div>
            <img :src="artistes.storage + '/' + artiste.image" class="card-img-top img-fluid" width="200px" height="200px" alt="...">
            <div class="card-body">
              <h5  class="card-title"><router-link :to="`/show/${artiste.id}`" v-text="artiste.titre"></router-link></h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
          </div>
        </div>
      </div>-->
        <div class="row" >
          <div class="col-md-3" v-if="artistes[0]" v-for="artiste in artistes[0]" :key="artiste.id">
          <div class="card shadow-sm">
            <div class="card-header" v-text="artiste.user.name"></div>
            <img :src="artistes.storage + '/' + artiste.image"  alt="image du produit" class="img-fluid" width="200px" height="200px"/>
            <div class="card-body">
              <h5  class="card-title"><router-link :to="`/show/${artiste.id}`" v-text="artiste.titre"></router-link></h5>
<!--              <p class="card-text">
                This is a wider card with supporting text below as a natural lead-in t
                o additional content. This content is a little bit longer.</p>-->
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <ArtisteLike :portfolio-id="artiste.id" ></ArtisteLike>
                </div>
<!--                <small class="text-body-secondary">9 mins</small>-->
              </div>
            </div>
          </div>
        </div>
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

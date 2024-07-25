<script >

import Navbar from "../../components/Navbar.vue";
import Footer from "../../components/Footer.vue";
import {onMounted, ref} from "vue";
import axios from "axios";

export default {
    name: "ArtisteIndex",
    components:{Navbar,Footer},
    setup(){
        const artistes = ref([])
        onMounted(async () => {
            const r = await axios.get('api/artistes')
            artistes.value = await r.data
            console.log(artistes.value[0][2])
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
        <div class="row" v-if="artistes[0]">
            <div class="col-md-4" v-for="artiste in artistes[0]" :key="artiste.id">
                <img :src="artiste.image" alt="project pic" class="img-responsive margin" style="display:inline" width="500" height="500" id="project-pic-1">
                <p id="project" class="project-link"><router-link :to="`/artistes/${artiste.id}`" v-text="artiste.titre"></router-link></p>
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

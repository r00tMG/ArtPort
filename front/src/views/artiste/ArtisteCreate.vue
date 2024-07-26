<script>
import Footer from "../../components/Footer.vue";
import Navbar from "../../components/Navbar.vue";
import {ref} from "vue";
import {useRouter} from "vue-router";
import axios from "axios";

export default {
    name: "ArtisteCreate",
    components: {Navbar, Footer},
    setup(){
        const titre = ref('titre')
        const description = ref('description')
        const image = ref(null)
        const artiste = ref({})
        const errors = ref({})
        const router = useRouter()
        const onImage = (e) => {
            image.value = e.target.files[0]
            console.log(image.value)
        }
        const onSubmit = async () => {
            const formData = new FormData()
            formData.append('titre', titre.value)
            formData.append('description', description.value)
            if(image.value){
                formData.append('image', image.value)
            }
            console.log(titre.value, description.value, image.value.name)

            try {
                const token = localStorage.getItem('token')
                const r = await axios.post('http://localhost:8000/api/artistes',formData,{
                    headers:{
                      'Content-Type':'multipart/form-data',
                      'Authorization' : `Bearer ${token}`
                    }
                })
                artiste.value = await r.data
                console.log(artiste.value)
                await router.push('/artistes')
            }catch (error) {
                if (error.response && error.response.status === 422) {
                    errors.value = error.response.data.errors;
                    console.error("Validation errors:", errors.value);
                } else {
                    console.error("Error: La requête a échoué", error);
                }
            }

        }

        return{
            titre,
            description,
            image,
            onImage,
            onSubmit,
            errors
        }
    }
}
</script>

<template>
    <Navbar />
    <div class="container-fluid bg1">
        <div class="container w-50 bg-light p-5 shadow around m-auto">
            <h3 style="margin-top: -5px; margin-bottom: 90px; font-size: 30px; letter-spacing: 6px" class="text-center underline">Create your projects</h3>
            <form @submit.prevent="onSubmit" class="w-50" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <input placeholder="titre" class="form-control" name="titre" v-model="titre" required>
                    <div v-if="errors.titre" class="text-danger">{{ errors.titre[0] }}</div>
                </div>
                <div class="form-group mb-3">
                    <textarea placeholder="description" class="form-control" name="description" v-model="description" required></textarea>
                    <div v-if="errors.description" class="text-danger">{{ errors.description[0] }}</div>
                </div>
                <div class="form-group mb-3">
                    <input class="form-control" type="file" name="image" @change="onImage">
                    <div v-if="errors.image" class="text-danger">{{ errors.image[0] }}</div>
                </div>
                <div class="form-group text-center">
                  <button class="btn btn-primary"  type="submit" >Save</button>
                </div>
            </form>

        </div>
    </div>

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

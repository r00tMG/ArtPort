<script>
    import Navbar from "../../components/Navbar.vue";
    import Footer from "../../components/Footer.vue";
    import {onMounted, ref} from "vue";
    import {useRoute} from "vue-router";
    import axios from "axios";

    export default {
        name: "ArtisteShow",
        components: {Footer, Navbar},
        setup(){
            const route = useRoute()
            const artiste = ref()
          const commentaires = ref([])
          const artiste_id = ref('')
          const comment = ref('')
            onMounted(async ()=>{
                try {

                    const r = await axios.get(`http://localhost:8000/api/show/${route.params.id}`,{
                        headers:{
                          'Accept':'application/json',
                        }
                    })
                    artiste.value = await r.data
                    //console.log(artiste.value.storage)
                }catch (error){
                    console.error("Error: Votre requête retourne une erreur",error)
                }
            })
          const fetchRatings = async () => {
            const token = localStorage.getItem('token');
            const r = await axios.get(`http://localhost:8000/api/artistes/${route.params.id}/commentaires`)
            commentaires.value = await r.data
            //console.log(ratings.value[0][0])

          }
          onMounted(async ()=>{
            await fetchRatings()
          })
          const submitComment = async () => {
            try {
              const r = await axios.post('http://localhost:8000/api/commentaires', {
                artiste_id: route.params.id,
                comment: comment.value
              });
              console.log(await r.data)
              await fetchRatings();
            } catch (error) {
              console.error('Erreur lors de la soumission de la notation:', error);
              alert('Une erreur est survenue lors de la soumission de la notation');
            }
          };
            return{
                artiste,
              submitComment,
              artiste_id,
              comment,
              commentaires
            }
        }
    }
</script>

<template>
    <Navbar />
    <div id="myPortfolio" class="container-fluid bg2 text-center" v-if="artiste">
        <h3 style="margin-top: -5px; margin-bottom: 90px; font-size: 30px; letter-spacing: 6px" class="underline">Here are some details of {{artiste[0].titre}}.</h3>
        <div class="row" >
            <div class="container w-75 m-auto" >
                <img :src="artiste.storage + '/' + artiste[0].image" alt="project pic" class="img-responsive margin " style="display:inline" width="900" height="500" id="project-pic-1">
                <p id="project" class="project-link" >
                    {{ artiste[0].description }}
<!--                  <router-link :to="`/artistes/show/${artiste.titre}-${artiste.id}`" v-text="artiste.titre"></router-link>-->
                </p>

              <div class="w-50 m-auto">
                <h3 class="text-center my-5">Commentaires</h3>
                <div v-for="commentaire in commentaires[0]" :key="commentaire.id">
<!--                  <p><strong>{{ commentaire.user.name }}</strong> ({{ commentaire.commentaire }}/5)</p>-->
                  <p>{{ commentaire.comment }}</p>
                </div>
                <form @submit.prevent="submitComment">

                  <div class="form-group w-25 m-auto mb-2">
                    <textarea v-model="comment" name="comment" class="form-control" placeholder="Commentaire"></textarea>
                  </div>
                  <div class="form-group text-center">
                    <button class="btn btn-primary" >Soumettre</button>
                  </div>
                </form>
              </div>
            </div>
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

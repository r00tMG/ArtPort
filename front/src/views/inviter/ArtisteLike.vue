<script>
import {onMounted, ref} from "vue";
import axios from "axios";

export default {
  name: "ArtisteLike",
  props: {
    portfolioId: {
      type: Number,
      required: true
    }
  },
  setup(props) {
    const liked = ref(false);
    const likesCount = ref(0);

    const fetchLikes = async () => {
      const response = await axios.get(`http://localhost:8000/api/artistes/${props.portfolioId}/like`);
      likesCount.value = response.data.count;
      liked.value = response.data.liked;
    };

    const onLike = async () => {
      if (liked.value) {
        await axios.delete(`http://localhost:8000/api/artistes/${props.portfolioId}/like`);
        liked.value = false;
        likesCount.value--;
      } else {
        await axios.post(`http://localhost:8000/api/artistes/${props.portfolioId}/like`);
        liked.value = true;
        likesCount.value++;
      }
    };

    onMounted(fetchLikes);

    return {
      liked,
      likesCount,
      onLike
    };
  }
}
</script>

<template>
  <div>
    <button type="button" @click="onLike" class="btn btn-sm primary">{{ liked ? 'Unlike' : 'Like' }}</button>
    <div>{{ likesCount }} likes</div>
  </div>
</template>


<style scoped>

</style>
<template>
    <div>
        <label class="form-label" :for="label">
            {{ label }}
        </label>
        <div class="form-group mb-3">
            <input class="form-control" type="file" :name="name" @change=uploadImage>
        </div>
        <div v-if="previewImage" class="mb-3">
            <img :src="previewImage">
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            previewImage:null
        }
    },
    props:{
        label:String,
        name:String,
    },
    methods:{
        uploadImage(e){
            const image = e.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                this.previewImage = e.target.result;
            }
        }
    }
    
}
</script>
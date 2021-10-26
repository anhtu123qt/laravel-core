<template>
    <div>
        <button 
        :route="fullRoute" 
        :class="btnClass" 
        :type="btnType"
        @click="onClick"
        >
        {{btnName}}
        </button>
    </div>
</template>
<script>
export default {
    props:{
        btnClass:String,
        btnName:String,
        btnType:String,
        route:String,
    },
    data(){
      return {
        param1:"",
        param2:"",
      }
    },
    computed:{
      fullRoute() {
        return "${this.route}/${param1}/${param2}";
      }
    },
    methods:{
      onClick(){
        window.location.href=this.route;
      }
    }
}
</script>
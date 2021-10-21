<template>
   <div>
        <label class="form-label" :for="label">
            {{ label }}
        </label>
        <div class="form-group mb-3">
            <input :value="value" class='form-control' :type="type" :name="name" :placeholder="label">
        </div>
       
   </div>
</template>
<script>
export default {
    props:{
        'label':String,
        'name':String,
        'type':String,
        'value':String,
    },
   
}
</script>

<template>
    <div>
        <label class="form-label" :for="label">
            {{ label }}
        </label>
        <div class="form-group mb-3">
            <textarea :value="value" class="form-control" :cols="cols" :rows="rows" :name="name" :placeholder="label"></textarea>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        name:String,
        label:String,
        value:String,
        cols:String,
        rows:String,
    }
}
</script>
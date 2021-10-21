require('./bootstrap');

require('alpinejs');

import Vue from "vue";
import Title from "./components/Title";
import Button from "./components/Button";
import Input from "./components/Input";
import TextArea from "./components/TextArea";
import UploadImage from "./components/UploadImage";

var app = new Vue({
    el:"#app",
    components:{
        'base-title':Title,
        'base-button':Button,
        'base-input':Input,
        'base-text-area':TextArea,
        'base-upload-image':UploadImage,
    }
})


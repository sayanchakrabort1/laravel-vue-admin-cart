<template>

<div class="container">
    <div class="imgbox">
        <img class="img" :src="'images/' + image"/> 
    </div>

    <div class="contentArea">
        <h3 class="common" v-cloak>Hello! {{ email }}.</h3>
        <p class="common">Welcome back! What you want to do today?</p>

        <div v-if="Number(count)">
            <p class="common" v-cloak> Your total number of Products: {{ count }} </p>
        </div>
        <div v-else>
            <p class="common"> You have no products, try adding some!  </p>
        </div>

        <ul style="color: white;">
        <li><a class="btn btn-success listSpacer" href="/showproducts">View Your Products</a></li>
        <li><a class="btn btn-success listSpacer" href="/manageproduct">Manage Your Products</a></li>
        <li><a class="btn btn-success listSpacer" href="/addproduct">Add Product</a></li>
        </ul>
    </div>
    
</div>
    

</template>

<script>

    export default {

        mounted() {
            console.log('Component mounted.')
        },

        data() {

            return {
              csrfToken: null,
            };
        },

        props: ['email' , 'image' , 'count'],

        created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        },

        methods: {

            
        }

    }

</script>

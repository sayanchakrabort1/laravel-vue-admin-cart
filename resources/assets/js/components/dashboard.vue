<template>

    <div class="main-div container">
       
        <div id="details" class="container-fluid content">
            <p style="display: hidden; padding-top:75px;"></p>
            <h1>Details:</h1>

             <h3>Current number of users: {{ user }} </h3>

             <h3>Current number of products: {{ prod }} </h3>

             <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer 
                took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged.Contrary to popular belief, Lorem Ipsum is not simply random text. 
                It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. 
                Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more 
                obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word 
                in classical literature, discovered the undoubtable source.
            </p>
        </div>

        <div id="users" class="container-fluid content">
            <p style="display: hidden; padding-top:75px;"></p>
            <h1>Online users:</h1>

            <div class="container showTable">
                <p v-if="msg" class="alert alert-success">Mail has been sent </p>
                <div v-if="arrayFlag == 0">
                    <table class="table table-bordered table-hover buffer">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in array" v-bind:key="index" >
                                <td>{{ index }}</td>
                                <td>{{ item }}</td>
                            <div>
                                <form method = "post" autocomplete = "off" action = "/mailCatcher">
                                    <input type="hidden" :value= email name="sender">
                                    <input type="hidden" :value= item name="recipient">
                                    <input type="hidden" name="_token" :value="csrfToken">
                                    <textarea name="text" style="resize:none; margin-top:1%;"></textarea>
                                    <button class="btn btn-success" type="submit" style="margin-bottom:10%; margin-left:2.5%;">Send</button>
                                </form>
                            </div>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else>
                    <div class="container" style="max-width:600px; width:100%; height: 400px;">
                        <h1 style="margin-top:20%;">Sorry there are no users! :(</h1>
                    </div>
                </div> 
            </div>
             
        </div>

        <div id="create" class="container-fluid content">

            <h2>Create another Admin</h2>
            <small class="alert-danger">Admin has all priviledges</small>
            <div>
                <div v-if="admin == '1'" class="alert-success">Admin created successfully. </div>
                <form method = "post" autocomplete="off" action="/adminCreate" v-on:submit="checker">

                    <label class="flex-column">New admin Email:</label>
                    <input type="text" name="email" class="flex-column" placeholder="johndoe@test.com" v-model="mail" @keydown.space.prevent>
                    <small style="color:red;" v-if="emailFlag">Email cannot be empty</small>    

                    <label class="flex-column">Password:</label>
                    <input type="password" class="flex-column" name="pass" v-model="pass" @keydown.space.prevent>
                    <small style="color:red;" v-if="passFlag">Password cannot be empty</small>

                    <input type="hidden" name="_token" class="flex-column" :value="csrfToken">
                    <input type="submit" class="flex-column btn btn-toolbar" value="Submit" style="margin-top:1%;">
                </form>
            </div>

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
              arrayFlag:0,
              mail: "",
              pass: "",
              emailFlag: 0,
              passFlag: 0,
              error: 0,
            };
        },

        props: ['array' , 'prod' , 'user' , 'email' , 'msg' , 'admin'],

        created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        if(this.array["1"]== undefined){
            this.arrayFlag=1;
            }
        },

        methods: {
            checker(event) {
                this.error=0;
               if(this.mail == ""){
                 this.emailFlag=1;
                 this.error=1;
               } else {
                 this.emailFlag=0;
               }

               if(this.pass == ""){
                 this.passFlag=1;
                 this.error=1;
               } else {
                 this.passFlag=0;
               }

               if(this.error == 1){
                 event.preventDefault();
               } else {
                 this.error=0;
               }
            }
        }

    }

</script>
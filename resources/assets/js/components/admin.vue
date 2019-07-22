<template>
<div>
    <div>
        <h1 class="text-center text-success"> Login page</h1>

        <br/>
            <div class="col-sm-12" style="border:1px solid skyblue; padding:5%; border-radius:8px;">
                <form action="/admin/verify" autocomplete="off" method="post" v-on:submit="checker">
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" name="email" id="email"  v-model="email" @keydown.space.prevent>
                        <small style="color:red;" v-if="emailFlag">Email cannot be empty</small>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <div style="display:flex; flex-direction:row;">
                          <input :type="holder" class="form-control" name="pass" placeholder="Password" id="pwd" v-model="pass" @keydown.space.prevent><button type="button" v-on:click="clicker"><i  class="fa fa-eye hey"></i></button>
                        </div>
                        <small style="color:red;" v-if="passFlag">Password cannot be empty</small>
                    </div>
                        <input type="hidden" name="_token" :value="csrfToken">
                    <button type="submit" class="btn btn-success btn-lg">Submit</button>
                </form>
            </div>
        </div>
        <div class="alert alert-warning" style="margin:0 auto; margin-top:1%;">
        This is admin login page. <a href="/login" style="text-decoration:none;"> Click here</a> to goto user page.
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
              email: '',
              pass: '',
              csrfToken: null,
              emailFlag: 0,
              passFlag: 0,
              error: 0,
              holder: "password",
            };
        },

        created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        },

        methods: {

            checker(event) {
                this.error=0;
               if(this.email == ""){
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
            },

            clicker(){
              if (this.holder == "password") {
                this.holder="text";
              } else {
                this.holder="password";
              }
            },


        }

    }

</script>
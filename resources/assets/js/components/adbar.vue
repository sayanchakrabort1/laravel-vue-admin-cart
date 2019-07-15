 <template>
    <div class="wrapper" id="wrapper">
        <header>
        <nav>
            <div class="menu-icon">
                <i class="fa fa-bars fa-2x"></i>
            </div>
            <div class="logo" >
                Electronics Shop
            </div>
            <div class="menu">
                <ul>
                    <li><a href="#wrapper" class="btn none">Home</a></li>
                    <li><a href="#details" class="btn none">Details</a></li>
                    <li><a href="#users" class="btn none">Users</a></li>
                    <li><a href="#create" class="btn none">Create Admin</a></li>
                    <li><strong>{{ email }}</strong><a href="/logout" class="btn none"><i class="fas fa-sign-out-alt">Sign out</i></a></li>
                    <!-- <li><a href="#" class="btn">Profile</a></li> -->
                </ul>
            </div>
        </nav>
        </header>
    </div>
</template>

<script>

    export default {

        mounted() {
            console.log('Component mounted.')
            
        },

        props: ['email'],


    }

</script>
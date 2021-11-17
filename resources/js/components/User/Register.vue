<template>
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Show password</label>
        <div class="col-md-8">
            <input v-on:click="showPassword" type="checkbox" id="showPassword" class="form-check-input" >
        </div>
    </div>
</template>

<script>
export default {
    methods:{
        showPassword(){
            $('#showPassword').click(function(){
                if('password' == $('#password').attr('type')   ) {
                    $('#password').prop('type', 'text');
                    $('#password-confirm').prop('type', 'text');
                }
                else{
                    $('#password').prop('type', 'password');
                    $('#password-confirm').prop('type', 'password');
                }
            });
        }
    }
}
</script>
<template>
    <div> 
        <div class="overlay show" v-show="loading"></div>
        <div class="spanner show" v-show="loading">
            <div class="loader-section">
                <div class="loader"></div>
            </div>
            <p>Loading...</p>
        </div>
        <!-- login wrapper -->
        <div class="login-register-link">
            <a href="/" class="ms-auto button register-now-btn">Login Now</a>
        </div>
        <div class="login-wrapper">
            <!-- register now button -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="image-overlay">
                        <img src="/assets/img/img01.png" alt="">
                        <div class="content">
                            <h4>
                                Welcome To Black Girl Film School
                            </h4>
                            <h1>
                                Learning Platform
                            </h1>
                            <div class="heading-bar">
                                <span></span>
                                <span></span>
                            </div>
                            <p>
                                Take professional film courses, Schedule a video meeting with industry film leaders and
                                do much
                                more.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login-form">
                        <img src="/assets/img/logo.svg" alt="">
                        <h2>
                            <span class="t-primary">Hi</span>, verify your account
                        </h2>
                        <div class="heading-bar">
                            <span></span>
                            <span></span>
                        </div>
                        <form @submit="_verify_user">
                            <h6><span class="bar"></span>Verification<span class="bar"></span></h6>
                            <label class="form-label" for="number">OTP *</label>
                            <input type="number" v-model="otp" class="form-control" placeholder="Enter OTP sent to your email" id="number" /> 
                            <button type="submit" :disabled="loading" class="button" > <i v-if="loading" class="fa fa-spinner fa-spin"></i>  Verify</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- login wrapper end -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            step: 1,
            otp: '', 
        }
    },
    mounted() {
    },
    methods: {
        _verify_user(e) {
            e.preventDefault();
            try {
                if ( !this.otp ) {
                    this.$swal.fire({
                        icon: 'error',
                        title: 'OTP feilds are required!'
                    });
                    return false;
                }
                let data = {
                    token: this.otp, 
                }
                this.loading = true;
                axios.post(`/verify_user`, data)
                    .then(response => { 
                        if (response.data.status == 1) {
                            this.$swal({
                                icon: 'success',
                                title: response.data.msg,
                            })
                            window.location = '/user';
                        } else { 
                            this.$swal({
                                icon: 'error',
                                title: response.data.msg,
                            })
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .finally(fsr => this.loading = false)
            } catch (error) {
                console.log(error)
            }
        }
    }
}
</script>
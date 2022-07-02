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
            <a href="/register" class="ms-auto button register-now-btn">Register Now</a>
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
                            <span class="t-primary">Hi</span>, will you sign in now
                        </h2>
                        <div class="heading-bar">
                            <span></span>
                            <span></span>
                        </div>
                        <form @submit="_login_user">
                            <h6><span class="bar"></span>Login<span class="bar"></span></h6>
                            <label for="email">Email Address *</label>
                            <input type="email" v-model="email" class="form-control" id="email" />
                            <label for="password">Password *</label>
                            <div class="position-relative">
                                <input type="password" v-model="password" class="form-control" id="password" />
                                <button type="button" class="show-hide-pass">
                                    <svg width="20" height="17" viewBox="0 0 20 17" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M18.4177 0.216186C18.1248 -0.0720618 17.65 -0.0720618 17.3571 0.216186L15.2693 2.27086C13.6565 1.1629 11.8555 0.575426 10 0.575426C7.94315 0.575426 5.94745 1.29542 4.21856 2.64201C2.51054 3.96402 1.08697 5.87061 0.0614407 8.20811C-0.020262 8.39433 -0.0204886 8.60544 0.0608142 8.79184C0.946427 10.8222 2.13598 12.5255 3.55444 13.7999L1.58307 15.74L1.51045 15.8228C1.2926 16.1117 1.3168 16.5218 1.58307 16.7838C1.87596 17.0721 2.35084 17.0721 2.64373 16.7838L18.4177 1.26002L18.4903 1.17724C18.7082 0.888283 18.684 0.478229 18.4177 0.216186ZM4.61636 12.7548L6.75422 10.6508C6.32259 10.0256 6.086 9.28501 6.086 8.50118C6.086 6.36842 7.83371 4.6473 10 4.6473C10.7921 4.6473 11.5527 4.88178 12.1867 5.30457L14.1892 3.33382C12.8815 2.49055 11.4565 2.05163 10 2.05163C8.29025 2.05163 6.61992 2.65424 5.14764 3.80096C3.73781 4.89217 2.52945 6.46072 1.61706 8.40041L1.5704 8.50138L1.61575 8.60027C2.40872 10.2948 3.43049 11.7038 4.61636 12.7548ZM11.0935 6.3804C10.7618 6.21412 10.3876 6.1235 10 6.1235C8.66236 6.1235 7.586 7.18349 7.586 8.50118C7.586 8.88505 7.67671 9.2495 7.8468 9.57561L11.0935 6.3804ZM13.1366 8.31584L13.238 8.32693C13.6456 8.39909 13.9167 8.78282 13.8434 9.18403C13.556 10.7567 12.2992 11.996 10.7022 12.2813C10.2946 12.3541 9.90425 12.088 9.83026 11.6869C9.75628 11.2858 10.0267 10.9016 10.4342 10.8288C11.4152 10.6536 12.1904 9.88917 12.367 8.92273C12.4343 8.55496 12.7675 8.30017 13.1366 8.31584ZM16.997 4.81439C17.3279 4.56924 17.7981 4.63452 18.0472 4.96021C18.773 5.90914 19.4072 6.99852 19.9384 8.20722C20.0205 8.39401 20.0205 8.60586 19.9386 8.79271C17.8613 13.5289 14.1345 16.4245 10 16.4245C9.05878 16.4245 8.12751 16.2747 7.23057 15.9801C6.83766 15.851 6.62544 15.4329 6.75657 15.0463C6.8877 14.6596 7.31252 14.4507 7.70543 14.5798C8.44973 14.8242 9.22068 14.9483 10 14.9483C13.3046 14.9483 16.381 12.6864 18.2727 8.82978L18.4284 8.50138L18.3755 8.38456C17.9948 7.5784 17.5645 6.83896 17.0898 6.17414L16.8488 5.84799C16.5997 5.52231 16.666 5.05955 16.997 4.81439Z"
                                            fill="#BCC5D2" />
                                    </svg>  
                                </button>
                            </div>
                            <a href="/forget-password" class="forgot-password ms-auto">Forgot my password?</a>
                            <div class="form-check d-flex align-items-center mt-1">
                                <input class="form-check-input" v-model="remember_me" type="checkbox" value="" id="termsAndConditions">
                                <label class="form-check-label my -0" for="termsAndConditions">
                                    I agree to the Terms and Conditions & Privacy Policy.
                                </label>
                            </div>
                            <button type="submit" class="button" :disabled="loading" > <i v-if="loading" class="fa fa-spinner fa-spin"></i> Login</button>
                            <div class="d-flex align-items-center justify-content-between">
                                <h6>Or sign in with</h6>
                                <div class="d-flex align-items-center">
                                    <a href="/login/facebook" class="fb-login">
                                        <svg width="11" height="20" viewBox="0 0 11 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.5858 0.00416134L7.94737 0C4.98322 0 3.06766 1.9319 3.06766 4.92203V7.19141H0.414863C0.18563 7.19141 0 7.37409 0 7.59943V10.8875C0 11.1128 0.185842 11.2953 0.414863 11.2953H3.06766V19.5922C3.06766 19.8175 3.25329 20 3.48252 20H6.94366C7.17289 20 7.35852 19.8173 7.35852 19.5922V11.2953H10.4603C10.6895 11.2953 10.8751 11.1128 10.8751 10.8875L10.8764 7.59943C10.8764 7.49123 10.8326 7.38762 10.7549 7.31105C10.6772 7.23448 10.5714 7.19141 10.4613 7.19141H7.35852V5.26763C7.35852 4.34298 7.58267 3.87358 8.808 3.87358L10.5853 3.87295C10.8144 3.87295 11 3.69027 11 3.46514V0.411972C11 0.187052 10.8146 0.00457747 10.5858 0.00416134Z"
                                                fill="#1976D3" />
                                        </svg>
                                    </a>
                                    <a href="/login/google" class="google-login">
                                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.3636 22.8874C19.109 24.7917 16.1841 26.0003 13.0001 26.0003C8.26223 26.0003 4.10324 23.3901 1.84863 19.5816L2.69271 15.6907L6.43413 14.9961C7.30248 17.7991 9.92271 19.8558 13.0001 19.8558C14.493 19.8558 15.8793 19.3835 17.0219 18.5457L20.6172 19.0941L21.3636 22.8874Z"
                                                fill="#59C36A" />
                                            <path
                                                d="M21.3636 22.8886L20.6171 19.0953L17.0218 18.5469C15.8793 19.3848 14.4929 19.857 13 19.857V26.0015C16.184 26.0015 19.1089 24.7929 21.3636 22.8886Z"
                                                fill="#00A66C" />
                                            <path
                                                d="M6.14446 12.9913C6.14446 13.6921 6.2511 14.3624 6.43391 14.987L1.84842 19.5725C0.705851 17.653 0 15.3983 0 12.9913C0 10.5843 0.705851 8.32967 1.84842 6.41016L5.52864 7.04354L6.43391 10.9956C6.2511 11.6202 6.14446 12.2905 6.14446 12.9913Z"
                                                fill="#FFDA2D" />
                                            <path
                                                d="M25.9998 13C25.9998 16.9608 24.1667 20.5104 21.3636 22.887L17.0218 18.5452C17.9054 17.9053 18.6519 17.0522 19.1394 16.0468H13C12.5734 16.0468 12.2383 15.7116 12.2383 15.2851V10.7148C12.2383 10.2882 12.5734 9.95312 13 9.95312H25.0248C25.3905 9.95312 25.7104 10.2121 25.7713 10.5777C25.9237 11.3699 25.9998 12.1925 25.9998 13Z"
                                                fill="#4086F4" />
                                            <path
                                                d="M19.1394 16.0468C18.6519 17.0522 17.9054 17.9053 17.0219 18.5452L21.3636 22.887C24.1667 20.5104 25.9998 16.9609 25.9998 13C25.9998 12.1925 25.9237 11.3699 25.7713 10.5777C25.7104 10.2121 25.3904 9.95312 25.0248 9.95312H13V16.0468H19.1394Z"
                                                fill="#4175DF" />
                                            <path
                                                d="M21.5769 3.63077C21.5922 3.84404 21.5007 4.04214 21.3636 4.19443L18.1035 7.43932C17.8446 7.71353 17.418 7.744 17.1133 7.51549C15.9097 6.61672 14.493 6.14446 13.0001 6.14446C9.92271 6.14446 7.30248 8.20103 6.43413 11.0042L1.84863 6.41868C4.10324 2.61013 8.26223 0 13.0001 0C16.0317 0 18.9871 1.11717 21.3027 3.0671C21.4703 3.20426 21.5617 3.41749 21.5769 3.63077Z"
                                                fill="#FF641A" />
                                            <path
                                                d="M17.1132 7.51549C17.4179 7.74405 17.8444 7.71353 18.1034 7.43932L21.3635 4.19443C21.5007 4.04214 21.5921 3.8441 21.5768 3.63077C21.5615 3.41744 21.4702 3.20426 21.3026 3.0671C18.987 1.11717 16.0316 0 13 0V6.14446C14.4929 6.14446 15.9097 6.61672 17.1132 7.51549Z"
                                                fill="#F03800" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
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
            remember_me: true,
            email: '', 
            password: ''
        }
    },
    mounted() {
    },
    methods: {
        _login_user(e) {
            e.preventDefault();
            try {
                if ( 
                    !this.email || 
                    !this.password
                ) {
                    this.$swal.fire({
                        icon: 'error',
                        title: 'All feilds are required!'
                    });
                    return false;
                }
                let data = { 
                    email: this.email, 
                    password: this.password,
                    remember_me: this.remember_me
                }
                this.loading = true;
                axios.post(`/login_user`, data)
                    .then(response => { 
                        if (response.data.status == 1) {
                            this.$swal({
                                icon: 'success',
                                title: response.data.msg,
                            })
                            window.location = '/intended_view';
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
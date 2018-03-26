<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/architects'">Arhi klub</router-link></li>
                            <li>Izmena arhitekte</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena arhitekte</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="name">Ime</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name" v-model="architect.name">
                                <small class="form-text text-muted" v-if="error != null && error.name">{{ error.name[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="city">Grad</label>
                                <input type="text" name="city" class="form-control" id="city" placeholder="Grad" v-model="architect.city">
                                <small class="form-text text-muted" v-if="error != null && error.city">{{ error.city[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="country">Država</label>
                                <input type="text" name="city" class="form-control" id="country" placeholder="Grad" v-model="architect.country">
                                <small class="form-text text-muted" v-if="error != null && error.country">{{ error.country[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefon</label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Telefon" v-model="architect.phone">
                                <small class="form-text text-muted" v-if="error != null && error.phone">{{ error.phone[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="email">Email adresa</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email adresa" v-model="architect.email">
                                <small class="form-text text-muted" v-if="error != null && error.email">{{ error.email[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="url">Web adresa</label>
                                <input type="text" name="utl" class="form-control" id="url" placeholder="Web adresa" v-model="architect.url">
                                <small class="form-text text-muted" v-if="error != null && error.url">{{ error.url[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="company">Kompanija</label>
                                <input type="text" name="utl" class="form-control" id="company" placeholder="Kompanija" v-model="architect.company">
                                <small class="form-text text-muted" v-if="error != null && error.company">{{ error.company[0] }}</small>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Izmeni</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <!--<upload-image-helper :image="user.image" :defaultImage="'img/user-image.png'" :titleImage="'User'" :error="error" @uploadImage="upload($event)"></upload-image-helper>-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
//    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import swal from 'sweetalert2';

    export default {
        data(){
          return {
              architect: {},
              error: null
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
//            'upload-image-helper': UploadImageHelper,
        },
        created(){
            this.getArchi();
        },
        methods: {
            submit(){
                axios.patch('api/architects/' + this.architect.id, this.architect)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Izmenjeno',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.error = null;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getArchi(){
                axios.get('api/architects/' + this.$route.params.id)
                    .then(res => {
                        this.architect = res.data.architect;
                        console.log(this.architect);
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
        }
    }
</script>
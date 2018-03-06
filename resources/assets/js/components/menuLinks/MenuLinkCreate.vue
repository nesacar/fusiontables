<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Home</router-link></li>
                            <li><router-link tag="a" :to="'/menus'">Menu</router-link></li>
                            <li>Menu link edit</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Menu link edit</h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <h5>General info</h5>
                        <hr>
                        <form @submit.prevent="general()">

                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <h5>Language info</h5>
                        <hr>
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Title" v-model="link.title">
                                <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" name="link" class="form-control" id="link" placeholder="Link" v-model="link.link">
                                <small class="form-text text-muted" v-if="error != null && error.link">{{ error.link[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="desc">Description</label>
                                <input type="text" name="Description" class="form-control" id="desc" placeholder="Description" v-model="link.desc">
                                <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="sufix">Sufix</label>
                                <input type="text" name="sufix" class="form-control" id="sufix" placeholder="Sufix" v-model="link.sufix">
                                <small class="form-text text-muted" v-if="error != null && error.sufix">{{ error.sufix[0] }}</small>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Create on English</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';

    export default {
        data(){
          return {
              link: {},
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'switches': Switches
        },
        methods: {
            submit(locale){
                axios.post('api/menu-links?menu_id=' + this.$route.params.id, this.link)
                    .then(res => {
                        this.$router.push('/menu-links/' + this.$route.params.id + '/sort');
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });

                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            }
        }
    }
</script>
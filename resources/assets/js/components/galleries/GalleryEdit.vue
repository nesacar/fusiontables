<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/galleries'">Galerije</router-link></li>
                            <li>Izmena galerije</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena galerije</h5>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="card">
                        <h5>Slike galerije</h5>
                        <hr>
                        <div id="gallery" v-if="images">
                            <div v-for="image in images" class="photo">
                                <font-awesome-icon icon="times" @click="deleteImage(image)" />
                                <img :src="image.file_path_small" class="img-thumbnail" alt="gallery.title">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <h5>Generalne</h5>
                        <hr>
                        <form @submit.prevent="general()">
                            <div class="form-group">
                                <label for="title">Naziv</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Naziv" v-model="gallery.title">
                                <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="order">Redosled</label>
                                <input type="text" name="order" class="form-control" id="order" placeholder="Redosled" v-model="gallery.order">
                                <small class="form-text text-muted" v-if="error != null && error.order">{{ error.title[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="gallery.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni generalna</button>
                            </div>
                        </form>
                    </div><!-- .card -->
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <h5>Upload slika</h5>
                        <hr>
                        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="showSuccess()"></vue-dropzone>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';
    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.css';

    export default {
        data(){
          return {
              gallery: {},
              error: null,
              images: {},
              dropzoneOptions: {
                  url: 'api/galleries/' + this.$route.params.id + '/images',
                  thumbnailWidth: 150,
                  maxFilesize: 0.5,
                  headers: { "Authorization": "Bearer " + this.$auth.getToken() }
              }
          }
        },
        computed: {
            user(){
                return this.$store.getters.getUser;
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches,
            'vue-dropzone': vue2Dropzone
        },
        created(){
            this.getGallery();
            this.getImages();
        },
        methods: {
            getGallery(){
                axios.get('api/galleries/' + this.$route.params.id)
                    .then(res => {
                        if(res.data.gallery != null){
                            this.gallery = res.data.gallery;
                        }
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            general(){
                axios.patch('api/galleries/' + this.gallery.id, this.gallery)
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
            getImages(){
                axios.get('api/galleries/' + this.$route.params.id + '/images')
                    .then(res => {
                        this.images = res.data.images;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            deleteImage(image){
                axios.post('api/images/' + image.id + '/destroy')
                    .then(res => {
                        this.images = this.images.filter(function (item) {
                            return image.id != item.id;
                        });
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            showSuccess(){
                this.getImages();
            }
        }
    }
</script>
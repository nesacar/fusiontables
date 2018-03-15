<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/posts'">Članci</router-link></li>
                            <li>Izmena članka</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena članka</h5>
                    </div>
                </div>

                <!--
                <div class="col-md-12">
                    <div class="card">
                        <h5>Gallery images</h5>
                        <hr>
                        <div id="gallery" v-if="photos">
                            <div v-for="photo in photos" class="photo">
                                <font-awesome-icon icon="times" @click="deletePhoto(photo)" />
                                <img :src="photo.file_path_small" class="img-thumbnail" alt="post.title">
                            </div>
                        </div>
                    </div>
                </div>
                -->

                <div class="col-md-4">
                    <div class="card">
                        <h5>Generalne informacije</h5>
                        <hr>
                        <form @submit.prevent="general()">
                            <div class="form-group">
                                <label for="category">Kategorija</label>
                                <select name="category" id="category" class="form-control" v-model="post.category_id">
                                    <option :value="index" v-for="(category, index) in lists">{{ category }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.category_id">{{ error.category_id[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="post.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <div class="form-group" v-if="post.category_id == 3">
                                <label for="author">Autor</label>
                                <input type="text" name="author" class="form-control" id="author" placeholder="Autor" v-model="post.author">
                                <small class="form-text text-muted" v-if="error != null && error.author">{{ error.author[0] }}</small>
                            </div>

                            <upload-image-helper
                                    :image="post.image"
                                    :defaultImage="null"
                                    :titleImage="'članka'"
                                    :error="error"
                                    @uploadImage="upload($event)"
                                    @removeRow="remove($event)"
                            ></upload-image-helper>

                            <upload-pdf-helper
                                    :pdf="post.pdf"
                                    :domain="domain"
                                    :defaultPdf="'/themes/ft/img/pdf-icon.jpg'"
                                    :titlePdf="'članka'"
                                    :error="error"
                                    @uploadPdf="uploadPdf($event)"
                                    @removeRow="remove($event)"
                            ></upload-pdf-helper>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni generalno</button>
                            </div>
                        </form>
                    </div><!-- .card -->
                    <!--
                    <div class="card">
                        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="showSuccess()"></vue-dropzone>
                    </div>
                    -->
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <h5>Jezičke informacije</h5>
                        <hr>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="srb-tab" data-toggle="tab" href="#srb" role="tab" aria-controls="home" aria-selected="true">Srpski</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="eng-tab" data-toggle="tab" href="#eng" role="tab" aria-controls="contact" aria-selected="false">Engleski</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="hrv-tab" data-toggle="tab" href="#hrv" role="tab" aria-controls="contact" aria-selected="false">Hrvatski</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="rus-tab" data-toggle="tab" href="#rus" role="tab" aria-controls="contact" aria-selected="false">Ruski</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="srb" role="tabpanel" aria-labelledby="srb-tab">
                                <form @submit.prevent="submit('sr')">
                                    <div class="form-group">
                                        <label for="title">Naslov</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Naslov" v-model="post.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" v-model="post.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="short">Kratak opis</label>
                                        <textarea name="short" id="short" cols="3" rows="4" class="form-control" placeholder="Kratak opis" v-model="post.short"></textarea>
                                        <small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Opis</label>
                                        <ckeditor
                                                v-model="post.body"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni srpski</button>
                                    </div>
                                </form>
                            </div><!-- #srb -->

                            <div class="tab-pane fade" id="eng" role="tabpanel" aria-labelledby="eng-tab">
                                <form @submit.prevent="submit('en')">
                                    <div class="form-group">
                                        <label for="title2">Naslov</label>
                                        <input type="text" name="title" class="form-control" id="title2" placeholder="Naslov" v-model="postEng.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug2">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug2" placeholder="Slug" v-model="postEng.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="shortIta">Kratak opis</label>
                                        <textarea name="short" id="shortIta" cols="3" rows="4" class="form-control" placeholder="Kratak opis" v-model="postEng.short"></textarea>
                                        <small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Opis</label>
                                        <ckeditor
                                                v-model="postEng.body"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni engleski</button>
                                    </div>
                                </form>
                            </div><!-- #eng -->

                            <div class="tab-pane fade" id="hrv" role="tabpanel" aria-labelledby="hrv-tab">
                                <form @submit.prevent="submit('hr')">
                                    <div class="form-group">
                                        <label for="title3">Naslov</label>
                                        <input type="text" name="title" class="form-control" id="title3" placeholder="Naslov" v-model="postHrv.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug3">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug3" placeholder="Slug" v-model="postHrv.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="short3">Kratak opis</label>
                                        <textarea name="short" id="short3" cols="3" rows="4" class="form-control" placeholder="Kratak opis" v-model="postHrv.short"></textarea>
                                        <small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Opis</label>
                                        <ckeditor
                                                v-model="postHrv.body"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni hrvatski</button>
                                    </div>
                                </form>
                            </div><!-- #hrv -->

                            <div class="tab-pane fade" id="rus" role="tabpanel" aria-labelledby="rus-tab">
                                <form @submit.prevent="submit('ru')">
                                    <div class="form-group">
                                        <label for="title4">Naslov</label>
                                        <input type="text" name="title" class="form-control" id="title4" placeholder="Naslov" v-model="postRus.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug4">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug4" placeholder="Slug" v-model="postRus.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="short4">Kratak opis</label>
                                        <textarea name="short" id="short4" cols="3" rows="4" class="form-control" placeholder="Kratak opis" v-model="postRus.short"></textarea>
                                        <small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Opis</label>
                                        <ckeditor
                                                v-model="postRus.body"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni ruski</button>
                                    </div>
                                </form>
                            </div><!-- #rus -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { apiHost } from '../../config';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import UploadPdfHelper from '../helper/UploadPdfHelper.vue';
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';
    import Ckeditor from 'vue-ckeditor2';
    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.css';

    export default {
        data(){
          return {
              post: {},
              postEng: {},
              postHrv: {},
              postRus: {},
              error: null,
              lists: {},
              photos: {},
              config: {
                  toolbar: [
                      [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'Image', 'Link', 'Unlink', 'Source' ],
                      { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                      '/',
                      { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                  ],
                  height: 300,
                  filebrowserBrowseUrl: 'filemanager/show'
              },
              dropzoneOptions: {
                  url: 'api/posts/' + this.$route.params.id + '/gallery',
                  thumbnailWidth: 150,
                  maxFilesize: 0.5,
                  headers: { "Authorization": "Bearer " + this.$auth.getToken() }
              },
              domain : apiHost
          }
        },
        computed: {
            post_id(){
                return this.post.id;
            },
            user(){
                return this.$store.getters.getUser;
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'upload-pdf-helper': UploadPdfHelper,
            'switches': Switches,
            'ckeditor': Ckeditor,
            'vue-dropzone': vue2Dropzone
        },
        created(){
            this.getPost('sr');
            this.getPost('en');
            this.getPost('hr');
            this.getPost('ru');
            this.getList();
            //this.getPhotos();
        },
        methods: {
            getPost(locale){
                axios.get('api/posts/' + this.$route.params.id + '?locale=' + locale)
                    .then(res => {
                        if(res.data.post != null){
                            if(locale == 'sr') {
                                this.post = res.data.post;
                            }else if(locale == 'hr'){
                                this.postHrv = res.data.post;
                            }else if(locale == 'ru'){
                                this.postRus = res.data.post;
                            }else{
                                this.postEng = res.data.post;
                            }
                        }
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            submit(locale){
                let data = {};
                if(locale == 'sr'){
                    data = this.post;
                    this.post.user_id = this.user.id;
                }else if(locale == 'hr'){
                    data = this.postHrv;
                    this.postHrv.user_id = this.user.id;
                }else if(locale == 'ru'){
                    data = this.postRus;
                    this.postRus.user_id = this.user.id;
                }else{
                    data = this.postEng;
                    this.postEng.user_id = this.user.id;
                }
                axios.post('api/posts/' + this.post.id + '/lang?locale=' + locale, data)
                    .then(res => {
                        if(locale == 'sr') {
                            this.post = res.data.post;
                        }else if(locale == 'hr'){
                            this.postHrv = res.data.post;
                        }else if(locale == 'ru'){
                            this.postRus = res.data.post;
                        }else{
                            this.postEng = res.data.post;
                        }
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.error = null;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            general(){
                this.post.user_id = this.user.id;
                axios.patch('api/posts/' + this.post.id, this.post)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uspeh',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.error = null;
                    }).catch(e => {
                    console.log(e.response);
                    this.error = e.response.data.errors;
                });
            },
            upload(image){
                axios.post('api/posts/' + this.post.id + '/image', { file: image[0] })
                    .then(res => {
                        console.log(res);
                        this.post.image = res.data.image;
                        this.error = null;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }).catch(e => {
                    console.log(e);
                    this.error = e.response.data.errors;
                });
            },
            uploadPdf(pdf){
                axios.post('api/posts/' + this.post.id + '/pdf', { file: pdf[0] })
                    .then(res => {
                        console.log(res);
                        this.post.pdf = res.data.pdf;
                        this.error = null;
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Uploudovano',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }).catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            getList(){
                axios.get('api/categories/lists')
                    .then(res => {
                        this.lists = res.data.categories;
                    }).catch(e => {
                    console.log(e.response);
                    this.error = e.response.data.errors;
                });
            },
            getPhotos(){
                axios.get('api/posts/' + this.$route.params.id + '/gallery')
                    .then(res => {
                        console.log(res);
                        this.photos = res.data.photos;
                    }).catch(e => {
                    console.log(e.response);
                    this.error = e.response.data.errors;
                });
            },
            deletePhoto(photo){
                axios.post('api/photos/' + photo.id + '/destroy')
                    .then(res => {
                        console.log(res);
                        this.photos = this.photos.filter(function (item) {
                            return photo.id != item.id;
                        });
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            showSuccess(){
                this.getPhotos();
            }
        }
    }
</script>
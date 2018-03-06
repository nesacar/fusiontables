<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Home</router-link></li>
                            <li><router-link tag="a" :to="'/posts'">Posts</router-link></li>
                            <li>Product edit</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Product edit</h5>
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
                        <h5>General info</h5>
                        <hr>
                        <form @submit.prevent="general()">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control" v-model="post.category_id">
                                    <option :value="index" v-for="(category, index) in lists">{{ category }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.category_id">{{ error.category_id[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Published</label><br>
                                <switches v-model="post.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <upload-image-helper
                                    :image="post.image"
                                    :defaultImage="null"
                                    :titleImage="'Post'"
                                    :error="error"
                                    @uploadImage="upload($event)"
                                    @removeRow="remove($event)"
                            ></upload-image-helper>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Edit general</button>
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
                        <h5>Language info</h5>
                        <hr>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#eng" role="tab" aria-controls="home" aria-selected="true">English</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#ita" role="tab" aria-controls="contact" aria-selected="false">Italian</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="eng" role="tabpanel" aria-labelledby="home-tab">
                                <form @submit.prevent="submit('en')">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Title" v-model="post.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" v-model="post.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="short">Short</label>
                                        <textarea name="short" id="short" cols="3" rows="4" class="form-control" placeholder="Short text" v-model="post.short"></textarea>
                                        <small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Body</label>
                                        <ckeditor
                                                v-model="post.body"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Edit on English</button>
                                    </div>
                                </form>
                            </div><!-- #eng -->

                            <div class="tab-pane fade" id="ita" role="tabpanel" aria-labelledby="contact-tab">
                                <form @submit.prevent="submit('it')">
                                    <div class="form-group">
                                        <label for="title2">Title</label>
                                        <input type="text" name="title" class="form-control" id="title2" placeholder="Title" v-model="postIta.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug2">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug2" placeholder="Slug" v-model="postIta.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="shortIta">Short</label>
                                        <textarea name="short" id="shortIta" cols="3" rows="4" class="form-control" placeholder="Short text" v-model="postIta.short"></textarea>
                                        <small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Body</label>
                                        <ckeditor
                                                v-model="postIta.body"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Edit on Italian</button>
                                    </div>
                                </form>
                            </div><!-- #ita -->
                        </div>
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
    import Ckeditor from 'vue-ckeditor2';
    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.css';

    export default {
        data(){
          return {
              post: {},
              postIta: {},
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
              }
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
            'switches': Switches,
            'ckeditor': Ckeditor,
            'vue-dropzone': vue2Dropzone
        },
        created(){
            this.getPost('en');
            this.getPost('it');
            this.getList();
            //this.getPhotos();
        },
        methods: {
            getPost(locale){
                axios.get('api/posts/' + this.$route.params.id + '?locale=' + locale)
                    .then(res => {
                        if(res.data.post != null){
                            if(locale == 'en'){
                                this.post = res.data.post;
                            }else{
                                this.postIta = res.data.post;
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
                if(locale == 'en'){
                    data = this.post;
                    this.post.user_id = this.user.id;
                }else{
                    data = this.postIta;
                    this.postIta.user_id = this.user.id;
                }
                axios.post('api/posts/' + this.post.id + '/lang?locale=' + locale, data)
                    .then(res => {
                        if(locale == 'en'){
                            this.post = res.data.post;
                        }else{
                            this.postIta = res.data.post;
                        }
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
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
                            title: 'Success',
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
            getList(){
                axios.get('api/categories/lists')
                    .then(res => {
                        console.log(res);
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
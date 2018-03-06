<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Home</router-link></li>
                            <li><router-link tag="a" :to="'/collections'">Collections</router-link></li>
                            <li>Collection edit</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Collection edit</h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <h5>General info</h5>
                        <hr>
                        <form @submit.prevent="general()">
                            <div class="form-group">
                                <label for="collections">Parent collection</label>
                                <select name="collections" id="collections" class="form-control" v-model="collection.parent">
                                    <option :value="index" v-for="(coll, index) in collections" v-if="index != collection.id">{{ coll }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Order</label>
                                <input type="text" name="order" class="form-control" id="order" placeholder="Order" v-model="collection.order">
                                <small class="form-text text-muted" v-if="error != null && error.order">{{ error.order[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Published</label><br>
                                <switches v-model="collection.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <upload-image-helper
                                    :image="collection.image"
                                    :defaultImage="null"
                                    :titleImage="'Collection'"
                                    :error="error"
                                    @uploadImage="upload($event)"
                                    @removeRow="remove($event)"
                            ></upload-image-helper>

                            <upload-image-helper
                                    :image="collection.heroImage"
                                    :defaultImage="null"
                                    :titleImage="'Desktop hero image'"
                                    :error="error"
                                    @uploadImage="uploadHeroImage($event)"
                                    @removeRow="remove($event)"
                            ></upload-image-helper>

                            <upload-image-helper
                                    :image="collection.heroImageMobile"
                                    :defaultImage="null"
                                    :titleImage="'Mobile hero image'"
                                    :error="error"
                                    @uploadImage="uploadHeroImageMobile($event)"
                                    @removeRow="remove($event)"
                            ></upload-image-helper>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Edit general</button>
                                </div>
                        </form>
                    </div>
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
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Title" v-model="collection.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" v-model="collection.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Collection description</label>
                                        <ckeditor
                                                v-model="collection.desc"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
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
                                        <input type="text" name="title" class="form-control" id="title2" placeholder="Title" v-model="collectionIta.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug2">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug2" placeholder="Slug" v-model="collectionIta.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Collection description</label>
                                        <ckeditor
                                                v-model="collectionIta.desc"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
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

    export default {
        data(){
          return {
              collection: {},
              collections: {},
              collectionIta: {},
              error: null,
              config: {
                  toolbar: [
                      [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'Image', 'Link', 'Unlink', 'Source' ],
                      { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                      '/',
                      { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                  ],
                  height: 300,
                  filebrowserBrowseUrl: 'media'
              }
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'switches': Switches,
            'ckeditor': Ckeditor
        },
        created(){
            this.getCollection('en');
            this.getCollection('it');
            this.getParentCollections();
        },
        methods: {
            getParentCollections(){
                axios.get('api/collections/parent-lists')
                    .then(res => {
                        this.collections = res.data.collections;
                    }).catch(e => {
                    console.log(e.response);
                    this.error = e.response.data.errors;
                });
            },
            getCollection(locale){
                axios.get('api/collections/' + this.$route.params.id + '?locale=' + locale)
                    .then(res => {
                        if(res.data.collection != null){
                            if(locale == 'en'){
                                this.collection = res.data.collection;
                            }else{
                                this.collectionIta = res.data.collection;
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
                    data = this.collection;
                }else{
                    data = this.collectionIta;
                }
                axios.post('api/collections/' + this.collection.id + '/lang?locale=' + locale, data)
                    .then(res => {
                        if(locale == 'en'){
                            this.collection = res.data.collection;
                        }else{
                            this.collectionIta = res.data.collection;
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
                axios.patch('api/collections/' + this.collection.id, this.collection)
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
                axios.post('api/collections/' + this.collection.id + '/image', { image: image[0] })
                    .then(res => {
                        this.collection.image = res.data.image;
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
            uploadHeroImage(image){
                axios.post('api/collections/' + this.collection.id + '/heroImage', { image: image[0] })
                    .then(res => {
                        this.collection.heroImage = res.data.image;
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
            uploadHeroImageMobile(image){
                axios.post('api/collections/' + this.collection.id + '/heroImageMobile', { image: image[0] })
                    .then(res => {
                        this.collection.heroImageMobile = res.data.image;
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
            }
        }
    }
</script>
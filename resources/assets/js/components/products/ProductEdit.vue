<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/products'">Proizvodi</router-link></li>
                            <li>Izmena proizvoda</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena proizvoda</h5>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="card">
                        <h5>Slike galerije</h5>
                        <hr>
                        <div id="gallery" v-if="photos">
                            <div v-for="photo in photos" class="photo">
                                <font-awesome-icon icon="times" @click="deletePhoto(photo)" />
                                <img :src="photo.file_path_small" class="img-thumbnail" alt="product.title">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card">
                        <h5>Generalne <a :href="link" class="btn btn-primary btn-sm" target="_blank" style="width: 80px; float: right;">pregled</a></h5>
                        <hr>
                        <form @submit.prevent="general()">
                            <div class="form-group">
                                <label for="collection">Kolekcija</label>
                                <select name="collection" id="collection" class="form-control" v-model="product.collection_id">
                                    <option :value="index" v-for="(collection, index) in lists">{{ collection }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.collection_id">{{ error.collection_id[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="price_small">Cena</label>
                                <input type="text" name="title" class="form-control" id="price_small" placeholder="Cena" v-model="product.price_small">
                                <small class="form-text text-muted" v-if="error != null && error.price_small">{{ error.price_small[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="price_outlet">Outlet cena</label>
                                <input type="text" name="price_outlet" class="form-control" id="price_outlet" placeholder="Outlet cena" v-model="product.price_outlet">
                                <small class="form-text text-muted" v-if="error != null && error.price_outlet">{{ error.price_outlet[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="product.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <upload-image-helper
                                    :image="product.image"
                                    :defaultImage="null"
                                    :titleImage="'proizvoda'"
                                    :error="error"
                                    @uploadImage="upload($event)"
                                    @removeRow="remove($event)"
                            ></upload-image-helper>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Izmeni generalna</button>
                            </div>
                        </form>
                    </div><!-- .card -->

                    <div class="card">
                        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" @vdropzone-success="showSuccess()"></vue-dropzone>
                    </div>

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
                            <!--<li class="nav-item">-->
                                <!--<a class="nav-link" id="hvr-tab" data-toggle="tab" href="#hrv" role="tab" aria-controls="contact" aria-selected="false">Hrvatski</a>-->
                            <!--</li>-->
                            <!--<li class="nav-item">-->
                                <!--<a class="nav-link" id="rus-tab" data-toggle="tab" href="#rus" role="tab" aria-controls="contact" aria-selected="false">Ruski</a>-->
                            <!--</li>-->
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="srb" role="tabpanel" aria-labelledby="srb-tab">
                                <form @submit.prevent="submit('sr')">
                                    <div class="form-group">
                                        <label for="title">Naslov</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Naslov" v-model="product.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" v-model="product.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="short">Kratak opis</label>
                                        <textarea name="short" id="short" cols="3" rows="4" class="form-control" placeholder="Kratak opis" v-model="product.short"></textarea>
                                        <small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Opis</label>
                                        <ckeditor
                                                v-model="product.body"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Karakteristike</label>
                                        <ckeditor
                                                v-model="product.body2"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body2[0] }}</small>
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
                                        <input type="text" name="title" class="form-control" id="title2" placeholder="Naslov" v-model="productEng.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug2">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug2" placeholder="Slug" v-model="productEng.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="shortIta">Kratak opis</label>
                                        <textarea name="short" id="shortIta" cols="3" rows="4" class="form-control" placeholder="Kratak opis" v-model="productEng.short"></textarea>
                                        <small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Opis</label>
                                        <ckeditor
                                                v-model="productEng.body"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Karakteristike</label>
                                        <ckeditor
                                                v-model="productEng.body2"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body2[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni engleski</button>
                                    </div>
                                </form>
                            </div><!-- #eng -->

                            <!--<div class="tab-pane fade" id="hrv" role="tabpanel" aria-labelledby="hrv-tab">-->
                                <!--<form @submit.prevent="submit('hr')">-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="title3">Naslov</label>-->
                                        <!--<input type="text" name="title" class="form-control" id="title3" placeholder="Naslov" v-model="productHrv.title">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="slug3">Slug</label>-->
                                        <!--<input type="text" name="slug" class="form-control" id="slug3" placeholder="Slug" v-model="productHrv.slug">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="short3">Kratak opis</label>-->
                                        <!--<textarea name="short" id="short3" cols="3" rows="4" class="form-control" placeholder="Kratak opis" v-model="productHrv.short"></textarea>-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label>Opis</label>-->
                                        <!--<ckeditor-->
                                                <!--v-model="productHrv.body"-->
                                                <!--:config="config">-->
                                        <!--</ckeditor>-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label>Karakteristike</label>-->
                                        <!--<ckeditor-->
                                                <!--v-model="productHrv.body2"-->
                                                <!--:config="config">-->
                                        <!--</ckeditor>-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body2[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<button class="btn btn-primary" type="submit">Izmeni hrvatski</button>-->
                                    <!--</div>-->
                                <!--</form>-->
                            <!--</div>&lt;!&ndash; #hrv &ndash;&gt;-->

                            <!--<div class="tab-pane fade" id="rus" role="tabpanel" aria-labelledby="rus-tab">-->
                                <!--<form @submit.prevent="submit('ru')">-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="title4">Naslov</label>-->
                                        <!--<input type="text" name="title" class="form-control" id="title4" placeholder="Naslov" v-model="productRus.title">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="slug4">Slug</label>-->
                                        <!--<input type="text" name="slug" class="form-control" id="slug4" placeholder="Slug" v-model="productRus.slug">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="short4">Kratak opis</label>-->
                                        <!--<textarea name="short" id="short4" cols="3" rows="4" class="form-control" placeholder="Kratak opis" v-model="productRus.short"></textarea>-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label>Opis</label>-->
                                        <!--<ckeditor-->
                                                <!--v-model="productRus.body"-->
                                                <!--:config="config">-->
                                        <!--</ckeditor>-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label>Karakteristike</label>-->
                                        <!--<ckeditor-->
                                                <!--v-model="productRus.body2"-->
                                                <!--:config="config">-->
                                        <!--</ckeditor>-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.desc">{{ error.body2[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<button class="btn btn-primary" type="submit">Izmeni ruski</button>-->
                                    <!--</div>-->
                                <!--</form>-->
                            <!--</div>&lt;!&ndash; #rus &ndash;&gt;-->
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
              product: {},
              productEng: {},
//              productHrv: {},
//              productRus: {},
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
                  url: 'api/products/' + this.$route.params.id + '/gallery',
                  thumbnailWidth: 150,
                  maxFilesize: 0.5,
                  headers: { "Authorization": "Bearer " + this.$auth.getToken() }
              }
          }
        },
        computed: {
            link(){
                return this.product.link;
            },
            product_id(){
                return this.product.id;
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
            this.getProduct('sr');
            this.getProduct('en');
//            this.getProduct('hr');
//            this.getProduct('ru');
            this.getList();
            this.getPhotos();
        },
        methods: {
            getProduct(locale){
                axios.get('api/products/' + this.$route.params.id + '?locale=' + locale)
                    .then(res => {
                        if(res.data.product != null){
                            if(locale == 'sr') {
                                this.product = res.data.product;
//                            }else if(locale == 'ru') {
//                                this.productRus = res.data.product;
//                            }else if(locale == 'hr'){
//                                this.productHrv = res.data.product;
                            }else{
                                this.productEng = res.data.product;
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
                if(locale == 'sr') {
                    data = this.product;
                    this.product.user_id = this.user.id;
//                }else if(locale == 'ru') {
//                    data = this.productRus;
//                    this.productRus.user_id = this.user.id;
//                }else if(locale == 'hr'){
//                    data = this.productHrv;
//                    this.productHrv.user_id = this.user.id;
                }else{
                    data = this.productEng;
                    this.productEng.user_id = this.user.id;
                }
                axios.post('api/products/' + this.product.id + '/lang?locale=' + locale, data)
                    .then(res => {
                        if(locale == 'sr') {
                            this.product = res.data.product;
//                        }else if(locale == 'ru') {
//                            this.productRus = res.data.product;
//                        }else if(locale == 'hr'){
//                            this.productHrv = res.data.product;
                        }else{
                            this.productEng = res.data.product;
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
                this.product.user_id = this.user.id;
                axios.patch('api/products/' + this.product.id, this.product)
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
            upload(image){
                axios.post('api/products/' + this.product.id + '/image', { file: image[0] })
                    .then(res => {
                        this.product.image = res.data.image;
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
                axios.get('api/collections/lists')
                    .then(res => {
                        this.lists = res.data.collections;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            getPhotos(){
                axios.get('api/products/' + this.$route.params.id + '/gallery')
                    .then(res => {
                        this.photos = res.data.photos;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            deletePhoto(photo){
                axios.post('api/photos/' + photo.id + '/destroy')
                    .then(res => {
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
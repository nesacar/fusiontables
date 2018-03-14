<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/collections'">Kolekcije</router-link></li>
                            <li>Izmena kolekcije</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena kolekcije</h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <h5>Generalne informacije</h5>
                        <hr>
                        <form @submit.prevent="general()">
                            <div class="form-group">
                                <label for="collections">Nad kolekcija</label>
                                <select name="collections" id="collections" class="form-control" v-model="collection.parent">
                                    <option :value="index" v-for="(coll, index) in collections" v-if="index != collection.id">{{ coll }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Redosled</label>
                                <input type="text" name="order" class="form-control" id="order" placeholder="Redosled" v-model="collection.order">
                                <small class="form-text text-muted" v-if="error != null && error.order">{{ error.order[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="collection.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <upload-image-helper
                                    :image="collection.image"
                                    :defaultImage="null"
                                    :titleImage="'kolekcije'"
                                    :error="error"
                                    @uploadImage="upload($event)"
                                    @removeRow="remove($event)"
                            ></upload-image-helper>

                            <!--
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
                            -->

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Izmeni generalno</button>
                                </div>
                        </form>
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
                                <!--<a class="nav-link" id="hrv-tab" data-toggle="tab" href="#hrv" role="tab" aria-controls="contact" aria-selected="false">Hrvatski</a>-->
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
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Naslov" v-model="collection.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" v-model="collection.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Opis</label>
                                        <ckeditor
                                                v-model="collection.short"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>
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
                                            <input type="text" name="title" class="form-control" id="title2" placeholder="Naslov" v-model="collectionEng.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug2">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug2" placeholder="Slug" v-model="collectionEng.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Opis</label>
                                        <ckeditor
                                                v-model="collectionEng.short"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>
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
                                        <!--<input type="text" name="title" class="form-control" id="title3" placeholder="Naslov" v-model="collectionHrv.title">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="slug3">Slug</label>-->
                                        <!--<input type="text" name="slug" class="form-control" id="slug3" placeholder="Slug" v-model="collectionHrv.slug">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label>Opis</label>-->
                                        <!--<ckeditor-->
                                                <!--v-model="collectionHrv.short"-->
                                                <!--:config="config">-->
                                        <!--</ckeditor>-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>-->
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
                                        <!--<input type="text" name="title" class="form-control" id="title4" placeholder="Naslov" v-model="collectionRus.title">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="slug4">Slug</label>-->
                                        <!--<input type="text" name="slug" class="form-control" id="slug4" placeholder="Slug" v-model="collectionRus.slug">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label>Opis</label>-->
                                        <!--<ckeditor-->
                                                <!--v-model="collectionRus.short"-->
                                                <!--:config="config">-->
                                        <!--</ckeditor>-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.short">{{ error.short[0] }}</small>-->
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

    export default {
        data(){
          return {
              collection: {},
              collections: {},
              collectionEng: {},
//              collectionHrv: {},
//              collectionRus: {},
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
            this.getCollection('sr');
            this.getCollection('en');
//            this.getCollection('hr');
//            this.getCollection('ru');
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
                            if(locale == 'sr') {
                                this.collection = res.data.collection;
//                            }else if(locale == 'hr'){
//                                this.collectionHrv = res.data.collection;
//                            }else if(locale == 'ru'){
//                                this.collectionRus = res.data.collection;
                            }else{
                                this.collectionEng = res.data.collection;
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
                    data = this.collection;
//                }else if(locale == 'hr'){
//                    data = this.collectionHrv;
//                }else if(locale == 'ru'){
//                    data = this.collectionRus;
                }else{
                    data = this.collectionEng;
                }
                axios.post('api/collections/' + this.collection.id + '/lang?locale=' + locale, data)
                    .then(res => {
                        if(locale == 'sr') {
                            this.collection = res.data.collection;
//                        }else if(locale == 'hr') {
//                            this.collectionHrv = res.data.collection;
//                        }else if(locale == 'ru'){
//                            this.collectionRus = res.data.collection;
                        }else{
                            this.collectionEng = res.data.collection;
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
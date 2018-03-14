<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li><router-link tag="a" :to="'/categories'">Kategorije</router-link></li>
                            <li>Izmena kategorije</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena kategorije</h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <h5>Generalne informacije</h5>
                        <hr>
                        <form @submit.prevent="general()">
                            <div class="form-group">
                                <label>Publikovano</label><br>
                                <switches v-model="category.publish" theme="bootstrap" color="primary"></switches>
                            </div>

                            <upload-image-helper
                                    :image="category.image"
                                    :defaultImage="null"
                                    :titleImage="'kategorije'"
                                    :error="error"
                                    @uploadImage="upload($event)"
                                    @removeRow="remove($event)"
                            ></upload-image-helper>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Izmeni generalna</button>
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
                                <a class="nav-link active" id="srb-tab" data-toggle="tab" href="#srb" role="tab" aria-controls="contact" aria-selected="false">Srpski</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="eng-tab" data-toggle="tab" href="#eng" role="tab" aria-controls="home" aria-selected="true">English</a>
                            </li>
                            <!--<li class="nav-item">-->
                                <!--<a class="nav-link" id="hrv-tab" data-toggle="tab" href="#hrv" role="tab" aria-controls="home" aria-selected="true">Hrvatski</a>-->
                            <!--</li>-->
                            <!--<li class="nav-item">-->
                                <!--<a class="nav-link" id="rus-tab" data-toggle="tab" href="#rus" role="tab" aria-controls="home" aria-selected="true">Ruski</a>-->
                            <!--</li>-->
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="srb" role="tabpanel" aria-labelledby="home-tab">
                                <form @submit.prevent="submit('sr')">
                                    <div class="form-group">
                                        <label for="title">Naslov</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Naslov" v-model="category.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" v-model="category.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Opis</label>
                                        <ckeditor
                                                v-model="category.short"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni srpski</button>
                                    </div>
                                </form>
                            </div><!-- #srb -->

                            <div class="tab-pane fade" id="eng" role="tabpanel" aria-labelledby="contact-tab">
                                <form @submit.prevent="submit('en')">
                                    <div class="form-group">
                                        <label for="title2">Naslov</label>
                                        <input type="text" name="title" class="form-control" id="title2" placeholder="Naslov" v-model="categoryEng.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug2">Slug</label>
                                        <input type="text" name="slug" class="form-control" id="slug2" placeholder="Slug" v-model="categoryEng.slug">
                                        <small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Opis</label>
                                        <ckeditor
                                                v-model="categoryEng.short"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni engleski</button>
                                    </div>
                                </form>
                            </div><!-- #eng -->

                            <!--<div class="tab-pane fade" id="hrv" role="tabpanel" aria-labelledby="contact-tab">-->
                                <!--<form @submit.prevent="submit('hr')">-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="title3">Naslov</label>-->
                                        <!--<input type="text" name="title" class="form-control" id="title3" placeholder="Naslov" v-model="categoryHrv.title">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="slug3">Slug</label>-->
                                        <!--<input type="text" name="slug" class="form-control" id="slug3" placeholder="Slug" v-model="categoryHrv.slug">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label>Opis</label>-->
                                        <!--<ckeditor-->
                                                <!--v-model="categoryHrv.short"-->
                                                <!--:config="config">-->
                                        <!--</ckeditor>-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<button class="btn btn-primary" type="submit">Izmeni hrvatski</button>-->
                                    <!--</div>-->
                                <!--</form>-->
                            <!--</div>&lt;!&ndash; #hrv &ndash;&gt;-->

                            <!--<div class="tab-pane fade" id="rus" role="tabpanel" aria-labelledby="contact-tab">-->
                                <!--<form @submit.prevent="submit('ru')">-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="title4">Naslov</label>-->
                                        <!--<input type="text" name="title" class="form-control" id="title4" placeholder="Naslov" v-model="categoryRus.title">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="slug4">Slug</label>-->
                                        <!--<input type="text" name="slug" class="form-control" id="slug4" placeholder="Slug" v-model="categoryRus.slug">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.slug">{{ error.slug[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label>Opis</label>-->
                                        <!--<ckeditor-->
                                                <!--v-model="categoryRus.short"-->
                                                <!--:config="config">-->
                                        <!--</ckeditor>-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>-->
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
              category: {},
              categoryEng: {},
//              categoryHrv: {},
//              categoryRus: {},
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
            this.getCategory('sr');
            this.getCategory('en');
//            this.getCategory('hr');
//            this.getCategory('ru');
        },
        methods: {
            getCategory(locale){
                axios.get('api/categories/' + this.$route.params.id + '?locale=' + locale)
                    .then(res => {
                        if(res.data.category != null){
                            if(locale == 'sr') {
                                this.category = res.data.category;
//                            }else if(locale == 'hr'){
//                                this.categoryHrv = res.data.category;
//                            }else if(locale == 'ru'){
//                                this.categoryRus = res.data.category;
                            }else{
                                this.categoryEng = res.data.category;
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
                    data = this.category;
//                }else if(locale == 'hr'){
//                    data = this.categoryHrv;
//                }else if(locale == 'ru'){
//                    data = this.categoryRus;
                }else{
                    data = this.categoryEng;
                }
                axios.post('api/categories/' + this.category.id + '/lang?locale=' + locale, data)
                    .then(res => {
                        if(locale == 'sr') {
                            this.category = res.data.category;
//                        }else if(locale == 'hr'){
//                            this.categoryHrv = res.data.category;
//                        }else if(locale == 'ru'){
//                            this.categoryRus = res.data.category;
                        }else{
                            this.categoryEng = res.data.category;
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
                axios.patch('api/categories/' + this.category.id, this.category)
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
                axios.post('api/categories/' + this.category.id + '/image', { image: image[0] })
                    .then(res => {
                        console.log(res);
                        this.category.image = res.data.image;
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
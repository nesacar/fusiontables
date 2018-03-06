<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Home</router-link></li>
                            <li><router-link tag="a" :to="'/collections'">Collections</router-link></li>
                            <li>Collection create</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Collection create</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="collections">Parent collection</label>
                                <select name="collections" id="collections" class="form-control" v-model="collection.parent">
                                    <option :value="index" v-for="(collection, index) in collections">{{ collection }}</option>
                                </select>
                            </div>
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
                                <label for="title">Order</label>
                                <input type="text" name="order" class="form-control" id="order" placeholder="Order" v-model="collection.order">
                                <small class="form-text text-muted" v-if="error != null && error.order">{{ error.order[0] }}</small>
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
                                <label>Published</label><br>
                                <switches v-model="collection.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
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
              collections: {},
              collection: {
                  desc: null,
                  publish: false
              },
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
            submit(){
                axios.post('api/collections', this.collection)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/collections');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            upload(image){
                this.collection.image = image[0];
            },
            uploadHeroImage(image){
                this.collection.heroImage = image[0];
            },
            uploadHeroImageMobile(image){
                this.collection.heroImageMobile = image[0];
            }
        }
    }
</script>
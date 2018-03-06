<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Home</router-link></li>
                            <li><router-link tag="a" :to="'/posts'">Posts</router-link></li>
                            <li>Post create</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Post create</h5>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <form @submit.prevent="submit()">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control" v-model="post.category_id">
                                    <option :value="index" v-for="(category, index) in lists">{{ category }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.category_id">{{ error.category_id[0] }}</small>
                            </div>
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
                                <small class="form-text text-muted" v-if="error != null && error.body">{{ error.body[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Published</label><br>
                                <switches v-model="post.publish" theme="bootstrap" color="primary"></switches>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <upload-image-helper
                            :image="post.image"
                            :defaultImage="null"
                            :titleImage="'Post'"
                            :error="error"
                            @uploadImage="upload($event)"
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
              post: {
                  desc: null,
                  publish: false,
                  category_id: 0
              },
              lists: {},
              error: null,
              config: {
                  toolbar: [
                      [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'Image', 'Link', 'Unlink', 'Source' ],
                      { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                      '/',
                      { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                  ],
                  height: 300,
                  filebrowserBrowseUrl: 'filemanager/show'
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
            'upload-image-helper': UploadImageHelper,
            'switches': Switches,
            'ckeditor': Ckeditor
        },
        created(){
            this.getList();
        },
        methods: {
            submit(){
                this.post.user_id = this.user.id;
                console.log(this.post);
                axios.post('api/posts', this.post)
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.$router.push('/posts');
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            },
            upload(image){
                console.log(image[0]);
                this.post.image = image[0];
            },
            getList(){
                axios.get('api/categories/lists')
                    .then(res => {
                        this.lists = res.data.categories;
                    }).catch(e => {
                        console.log(e.response);
                        this.error = e.response.data.errors;
                    });
            }
        }
    }
</script>
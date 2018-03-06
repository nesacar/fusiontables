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
                                        <button class="btn btn-primary" type="submit">Edit on English</button>
                                    </div>
                                </form>
                            </div><!-- #eng -->

                            <div class="tab-pane fade" id="ita" role="tabpanel" aria-labelledby="contact-tab">
                                <form @submit.prevent="submit('it')">
                                    <div class="form-group">
                                        <label for="titleIta">Title</label>
                                        <input type="text" name="title" class="form-control" id="titleIta" placeholder="Title" v-model="linkIta.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="linkIta">Link</label>
                                        <input type="text" name="link" class="form-control" id="linkIta" placeholder="Link" v-model="linkIta.link">
                                        <small class="form-text text-muted" v-if="error != null && error.link">{{ error.link[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="descIta">Description</label>
                                        <input type="text" name="Description" class="form-control" id="descIta" placeholder="Description" v-model="linkIta.desc">
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="sufixIta">Sufix</label>
                                        <input type="text" name="sufix" class="form-control" id="sufixIta" placeholder="Sufix" v-model="linkIta.sufix">
                                        <small class="form-text text-muted" v-if="error != null && error.sufix">{{ error.sufix[0] }}</small>
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

    export default {
        data(){
          return {
              link: {},
              linkIta: {},
              error: null,
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'switches': Switches
        },
        created(){
            this.getLink('en');
            this.getLink('it');
        },
        methods: {
            getLink(locale){
                axios.get('api/menu-links/' + this.$route.params.id + '?locale=' + locale)
                    .then(res => {
                        if(res.data.link != null){
                            if(locale == 'en'){
                                this.link = res.data.link;
                            }else{
                                this.linkIta = res.data.link;
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
                    data = this.link;
                }else{
                    data = this.linkIta;
                }
                axios.patch('api/menu-links/' + this.link.id + '?locale=' + locale, data)
                    .then(res => {
                        if(locale == 'en'){
                            this.link = res.data.link;
                        }else{
                            this.linkIta = res.data.link;
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
            }
        }
    }
</script>
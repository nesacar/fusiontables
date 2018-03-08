<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Home</router-link></li>
                            <li><router-link tag="a" :to="'/menus'">Meni</router-link></li>
                            <li>Izmena linka</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Izmena linka</h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <h5>Generalne informacije</h5>
                        <hr>
                        <form @submit.prevent="general()">
                            <div class="form-group">
                                <label for="parent">Nad link</label>
                                <select name="parent" id="parent" class="form-control" v-model="link.parent">
                                    <option :value="index" v-for="(link, index) in links">{{ link }}</option>
                                </select>
                                <small class="form-text text-muted" v-if="error != null && error.parent">{{ error.parent[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="order">Redosled</label>
                                <input type="text" name="order" class="form-control" id="order" placeholder="Redosled" v-model="link.order">
                                <small class="form-text text-muted" v-if="error != null && error.order">{{ error.order[0] }}</small>
                            </div>
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
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#srb" role="tab" aria-controls="home" aria-selected="true">Srpski</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#eng" role="tab" aria-controls="contact" aria-selected="false">Engleski</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="srb" role="tabpanel" aria-labelledby="home-tab">
                                <form @submit.prevent="submit('sr')">
                                    <div class="form-group">
                                        <label for="title">Naziv</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Naziv" v-model="link.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="link">Link</label>
                                        <input type="text" name="link" class="form-control" id="link" placeholder="Link" v-model="link.link">
                                        <small class="form-text text-muted" v-if="error != null && error.link">{{ error.link[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">Opis</label>
                                        <input type="text" name="Description" class="form-control" id="desc" placeholder="Opis" v-model="link.desc">
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="sufix">Sufix</label>
                                        <input type="text" name="sufix" class="form-control" id="sufix" placeholder="Sufix" v-model="link.sufix">
                                        <small class="form-text text-muted" v-if="error != null && error.sufix">{{ error.sufix[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni srpski</button>
                                    </div>
                                </form>
                            </div><!-- #srb -->

                            <div class="tab-pane fade" id="eng" role="tabpanel" aria-labelledby="contact-tab">
                                <form @submit.prevent="submit('en')">
                                    <div class="form-group">
                                        <label for="titleIta">Naziv</label>
                                        <input type="text" name="title" class="form-control" id="titleIta" placeholder="Naziv" v-model="linkEng.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="linkIta">Link</label>
                                        <input type="text" name="link" class="form-control" id="linkIta" placeholder="Link" v-model="linkEng.link">
                                        <small class="form-text text-muted" v-if="error != null && error.link">{{ error.link[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="descIta">Opis</label>
                                        <input type="text" name="Description" class="form-control" id="descIta" placeholder="Opis" v-model="linkEng.desc">
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="sufixIta">Sufix</label>
                                        <input type="text" name="sufix" class="form-control" id="sufixIta" placeholder="Sufix" v-model="linkEng.sufix">
                                        <small class="form-text text-muted" v-if="error != null && error.sufix">{{ error.sufix[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni engleski</button>
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
              linkEng: {},
              error: null,
              links: []
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'upload-image-helper': UploadImageHelper,
            'switches': Switches
        },
        created(){
            this.getLink('sr');
            this.getLink('en');
            this.getParentLinks();
        },
        methods: {
            getLink(locale){
                axios.get('api/menu-links/' + this.$route.params.id + '?locale=' + locale)
                    .then(res => {
                        if(res.data.link != null){
                            if(locale == 'sr'){
                                this.link = res.data.link;
                            }else{
                                this.linkEng = res.data.link;
                            }
                        }
                    })
                    .catch(e => {
                        console.log(e);
                        this.error = e.response.data.errors;
                    });
            },
            getParentLinks(){
                axios.get('api/menu-links/lists')
                    .then(res => {
                        if(res.data.links != null){
                            this.links = res.data.links;
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
                    data = this.link;
                }else{
                    data = this.linkEng;
                }
                axios.patch('api/menu-links/' + this.link.id + '?locale=' + locale, data)
                    .then(res => {
                        if(locale == 'sr'){
                            this.link = res.data.link;
                        }else{
                            this.linkEng = res.data.link;
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
                axios.post('api/menu-links/' + this.link.id + '/general', this.link)
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
            }
        }
    }
</script>
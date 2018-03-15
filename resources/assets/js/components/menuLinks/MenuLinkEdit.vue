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

                            <div class="tab-pane fade" id="eng" role="tabpanel" aria-labelledby="eng-tab">
                                <form @submit.prevent="submit('en')">
                                    <div class="form-group">
                                        <label for="title2">Naziv</label>
                                        <input type="text" name="title" class="form-control" id="title2" placeholder="Naziv" v-model="linkEng.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="link2">Link</label>
                                        <input type="text" name="link" class="form-control" id="link2" placeholder="Link" v-model="linkEng.link">
                                        <small class="form-text text-muted" v-if="error != null && error.link">{{ error.link[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc2">Opis</label>
                                        <input type="text" name="Description" class="form-control" id="desc2" placeholder="Opis" v-model="linkEng.desc">
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="sufixIta">Sufix</label>
                                        <input type="text" name="sufix" class="form-control" id="sufix2" placeholder="Sufix" v-model="linkEng.sufix">
                                        <small class="form-text text-muted" v-if="error != null && error.sufix">{{ error.sufix[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni engleski</button>
                                    </div>
                                </form>
                            </div><!-- #eng -->

                            <div class="tab-pane fade" id="hrv" role="tabpanel" aria-labelledby="hrv-tab">
                                <form @submit.prevent="submit('hr')">
                                    <div class="form-group">
                                        <label for="title3">Naziv</label>
                                        <input type="text" name="title" class="form-control" id="title3" placeholder="Naziv" v-model="linkHrv.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="link3">Link</label>
                                        <input type="text" name="link" class="form-control" id="link3" placeholder="Link" v-model="linkHrv.link">
                                        <small class="form-text text-muted" v-if="error != null && error.link">{{ error.link[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc3">Opis</label>
                                        <input type="text" name="Description" class="form-control" id="desc3" placeholder="Opis" v-model="linkHrv.desc">
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="sufix3">Sufix</label>
                                        <input type="text" name="sufix" class="form-control" id="sufix3" placeholder="Sufix" v-model="linkHrv.sufix">
                                        <small class="form-text text-muted" v-if="error != null && error.sufix">{{ error.sufix[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni hrvatski</button>
                                    </div>
                                </form>
                            </div><!-- #hrv -->

                            <div class="tab-pane fade" id="rus" role="tabpanel" aria-labelledby="rus-tab">
                                <form @submit.prevent="submit('ru')">
                                    <div class="form-group">
                                        <label for="title4">Naziv</label>
                                        <input type="text" name="title" class="form-control" id="title4" placeholder="Naziv" v-model="linkRus.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="link4">Link</label>
                                        <input type="text" name="link" class="form-control" id="link4" placeholder="Link" v-model="linkRus.link">
                                        <small class="form-text text-muted" v-if="error != null && error.link">{{ error.link[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc4">Opis</label>
                                        <input type="text" name="Description" class="form-control" id="desc4" placeholder="Opis" v-model="linkRus.desc">
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="sufix4">Sufix</label>
                                        <input type="text" name="sufix" class="form-control" id="sufix4" placeholder="Sufix" v-model="linkRus.sufix">
                                        <small class="form-text text-muted" v-if="error != null && error.sufix">{{ error.sufix[0] }}</small>
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
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import UploadImageHelper from '../helper/UploadImageHelper.vue';
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';

    export default {
        data(){
          return {
              link: {},
              linkEng: {},
              linkHrv: {},
              linkRus: {},
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
            this.getLink('hr');
            this.getLink('ru');
            this.getParentLinks();
        },
        methods: {
            getLink(locale){
                axios.get('api/menu-links/' + this.$route.params.id + '?locale=' + locale)
                    .then(res => {
                        if(res.data.link != null){
                            if(locale == 'sr') {
                                this.link = res.data.link;
                            }else if(locale == 'hr'){
                                this.linkHrv = res.data.link;
                            }else if(locale == 'ru'){
                                this.linkRus = res.data.link;
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
                if(locale == 'sr') {
                    data = this.link;
                }else if(locale == 'hr'){
                    data = this.linkHrv;
                }else if(locale == 'ru'){
                    data = this.linkRus;
                }else{
                    data = this.linkEng;
                }
                axios.patch('api/menu-links/' + this.link.id + '?locale=' + locale, data)
                    .then(res => {
                        if(locale == 'sr') {
                            this.link = res.data.link;
                        }else if(locale == 'hr'){
                            this.linkHrv = res.data.link;
                        }else if(locale == 'ru'){
                            this.linkRus = res.data.link;
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
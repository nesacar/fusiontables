<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Podešavanja izmena</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Podešavanja izmena</h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <h5>Osnovne informacije</h5>
                        <hr>
                        <form @submit.prevent="general()">
                            <div class="form-group">
                                <label for="Phone1">Telefon 1</label>
                                <input type="text" name="Phone1" class="form-control" id="Phone1" placeholder="Telefon 1" v-model="setting.phone1">
                                <small class="form-text text-muted" v-if="error != null && error.phone1">{{ error.phone1[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="Phone1">Telefon 2</label>
                                <input type="text" name="Phone2" class="form-control" id="Phone2" placeholder="Telefon 2" v-model="setting.phone2">
                                <small class="form-text text-muted" v-if="error != null && error.phone2">{{ error.phone2[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="Email1">Email 1</label>
                                <input type="email" name="Email1" class="form-control" id="Email1" placeholder="Enter email 1" v-model="setting.email1">
                                <small class="form-text text-muted" v-if="error != null && error.email1">{{ error.email1[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="Email2">Email 2</label>
                                <input type="email" name="Email2" class="form-control" id="Email2" placeholder="Enter email 2" v-model="setting.email2">
                                <small class="form-text text-muted" v-if="error != null && error.email2">{{ error.email2[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="text" name="Email2" class="form-control" id="facebook" placeholder="Enter facebook" v-model="setting.facebook">
                                <small class="form-text text-muted" v-if="error != null && error.facebook">{{ error.facebook[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="facebook">Twitter</label>
                                <input type="text" name="Twitter" class="form-control" id="twitter" placeholder="Enter twitter" v-model="setting.twitter">
                                <small class="form-text text-muted" v-if="error != null && error.twitter">{{ error.twitter[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="instagram">Instagram</label>
                                <input type="text" name="Instagram" class="form-control" id="instagram" placeholder="Enter instagram" v-model="setting.instagram">
                                <small class="form-text text-muted" v-if="error != null && error.instagram">{{ error.instagram[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="pinterest">Pinterest</label>
                                <input type="text" name="pinterest" class="form-control" id="pinterest" placeholder="Enter pinterest" v-model="setting.pinterest">
                                <small class="form-text text-muted" v-if="error != null && error.pinterest">{{ error.pinterest[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="analytics">Google Analytics</label>
                                <textarea name="Analytics" id="analytics" cols="5" rows="5" v-model="setting.analytics" class="form-control">{{ setting.analytics}}</textarea>
                                <small class="form-text text-muted" v-if="error != null && error.analytics">{{ error.analytics[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Newsletter</label><br>
                                <switches v-model="setting.newsletter" theme="bootstrap" color="primary"></switches>
                            </div>
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
                                        <label for="address">Adresa</label>
                                        <input type="text" name="address" class="form-control" id="address" placeholder="Adresa" v-model="setting.address">
                                        <small class="form-text text-muted" v-if="error != null && error.address">{{ error.address[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Naslov</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Naslov" v-model="setting.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="keywords">Ključne reči</label>
                                        <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Ključne reči" v-model="setting.keywords">
                                        <small class="form-text text-muted" v-if="error != null && error.keywords">{{ error.keywords[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Opis</label>
                                        <ckeditor
                                                v-model="setting.desc"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Footer tekst</label>
                                        <ckeditor
                                                v-model="setting.footer"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.footer[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni srpski</button>
                                    </div>
                                </form>
                            </div><!-- #srb -->

                            <div class="tab-pane fade" id="eng" role="tabpanel" aria-labelledby="eng-tab">
                                <form @submit.prevent="submit('en')">
                                    <div class="form-group">
                                        <label for="address2">Adresa</label>
                                        <input type="text" name="address" class="form-control" id="address2" placeholder="Adresa" v-model="settingEng.address">
                                        <small class="form-text text-muted" v-if="error != null && error.address">{{ error.address[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="title2">Naslov</label>
                                        <input type="text" name="title" class="form-control" id="title2" placeholder="Naslov" v-model="settingEng.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="keywords2">Ključne reči</label>
                                        <input type="text" name="keywords" class="form-control" id="keywords2" placeholder="Ključne reči" v-model="settingEng.keywords">
                                        <small class="form-text text-muted" v-if="error != null && error.keywords">{{ error.keywords[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Opis</label>
                                        <ckeditor
                                                v-model="settingEng.desc"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Footer tekst</label>
                                        <ckeditor
                                                v-model="settingEng.footer"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.footer[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Izmeni engleski</button>
                                    </div>
                                </form>
                            </div><!-- #eng -->

                            <!--<div class="tab-pane fade" id="hrv" role="tabpanel" aria-labelledby="hrv-tab">-->
                                <!--<form @submit.prevent="submit('hr')">-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="address3">Adresa</label>-->
                                        <!--<input type="text" name="address" class="form-control" id="address3" placeholder="Adresa" v-model="settingHrv.address">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.address">{{ error.address[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="title3">Naslov</label>-->
                                        <!--<input type="text" name="title" class="form-control" id="title3" placeholder="Naslov" v-model="settingHrv.title">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="keywords3">Ključne reči</label>-->
                                        <!--<input type="text" name="keywords" class="form-control" id="keywords3" placeholder="Ključne reči" v-model="settingHrv.keywords">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.keywords">{{ error.keywords[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label>Opis</label>-->
                                        <!--<ckeditor-->
                                                <!--v-model="settingHrv.desc"-->
                                                <!--:config="config">-->
                                        <!--</ckeditor>-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label>Footer tekst</label>-->
                                        <!--<ckeditor-->
                                                <!--v-model="settingHrv.footer"-->
                                                <!--:config="config">-->
                                        <!--</ckeditor>-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.desc">{{ error.footer[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<button class="btn btn-primary" type="submit">Izmeni hrvatski</button>-->
                                    <!--</div>-->
                                <!--</form>-->
                            <!--</div>&lt;!&ndash; #hrv &ndash;&gt;-->

                            <!--<div class="tab-pane fade" id="rus" role="tabpanel" aria-labelledby="rus-tab">-->
                                <!--<form @submit.prevent="submit('ru')">-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="address4">Adresa</label>-->
                                        <!--<input type="text" name="address" class="form-control" id="address4" placeholder="Adresa" v-model="settingRus.address">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.address">{{ error.address[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="title4">Naslov</label>-->
                                        <!--<input type="text" name="title" class="form-control" id="title4" placeholder="Naslov" v-model="settingRus.title">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label for="keywords4">Ključne reči</label>-->
                                        <!--<input type="text" name="keywords" class="form-control" id="keywords4" placeholder="Ključne reči" v-model="settingRus.keywords">-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.keywords">{{ error.keywords[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label>Opis</label>-->
                                        <!--<ckeditor-->
                                                <!--v-model="settingRus.desc"-->
                                                <!--:config="config">-->
                                        <!--</ckeditor>-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>-->
                                    <!--</div>-->
                                    <!--<div class="form-group">-->
                                        <!--<label>Footer tekst</label>-->
                                        <!--<ckeditor-->
                                                <!--v-model="settingRus.footer"-->
                                                <!--:config="config">-->
                                        <!--</ckeditor>-->
                                        <!--<small class="form-text text-muted" v-if="error != null && error.desc">{{ error.footer[0] }}</small>-->
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
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';
    import Ckeditor from 'vue-ckeditor2';

    export default {
        data(){
          return {
              setting: {},
              settingEng: {},
//              settingHrv: {},
//              settingRus: {},
              error: null,
              config: {
                  toolbar: [
                      [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'Image' ]
                  ],
                  height: 300,
                  filebrowserBrowseUrl: 'media'
              }
          }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'switches': Switches,
            'ckeditor': Ckeditor
        },
        created(){
            this.getSetting('sr');
            this.getSetting('en');
//            this.getSetting('hr');
//            this.getSetting('ru');
        },
        methods: {
            getSetting(locale){
                axios.get('api/settings/1/edit?locale=' + locale)
                    .then(res => {
                        if(res.data.setting != null){
                            if(locale == 'sr') {
                                this.setting = res.data.setting;
//                            }else if(locale == 'hr') {
//                                this.settingHrv = res.data.setting;
//                            }else if(locale == 'ru'){
//                                this.settingRus = res.data.setting;
                            }else{
                                this.settingEng = res.data.setting;
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
                    data = this.setting;
//                }else if(locale == 'hr') {
//                    data = this.settingHrv;
//                }else if(locale == 'ru'){
//                    data = this.settingRus;
                }else{
                    data = this.settingEng;
                }
                axios.post('api/settings/' + this.setting.id + '/updateLang?locale=' + locale, data)
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
            general(){
                axios.patch('api/settings/' + this.setting.id + '/update', this.setting)
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
            }
        }
    }
</script>
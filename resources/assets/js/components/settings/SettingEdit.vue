<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Home</router-link></li>
                            <li>Settings edit</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row bela">
                <div class="col-md-12">
                    <div class="card">
                        <h5>Settings edit</h5>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <h5>General info</h5>
                        <hr>
                        <form @submit.prevent="general()">
                            <div class="form-group">
                                <label for="Phone1">Phone 1</label>
                                <input type="text" name="Phone1" class="form-control" id="Phone1" placeholder="Enter phone 1" v-model="setting.phone1">
                                <small class="form-text text-muted" v-if="error != null && error.phone1">{{ error.phone1[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label for="Phone1">Phone 2</label>
                                <input type="text" name="Phone2" class="form-control" id="Phone2" placeholder="Enter phone 2" v-model="setting.phone2">
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
                                <input type="text" name="Analytics" class="form-control" id="analytics" placeholder="Enter google analytics" v-model="setting.analytics">
                                <small class="form-text text-muted" v-if="error != null && error.analytics">{{ error.analytics[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Newsletter</label><br>
                                <switches v-model="setting.newsletter" theme="bootstrap" color="primary"></switches>
                            </div>
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
                                        <label for="address">Address</label>
                                        <input type="text" name="address" class="form-control" id="address" placeholder="address" v-model="setting.address">
                                        <small class="form-text text-muted" v-if="error != null && error.address">{{ error.address[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Title" v-model="setting.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="keywords">Keywords</label>
                                        <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Keywords" v-model="setting.keywords">
                                        <small class="form-text text-muted" v-if="error != null && error.keywords">{{ error.keywords[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <ckeditor
                                                v-model="setting.desc"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Footer text</label>
                                        <ckeditor
                                                v-model="setting.footer"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.footer[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Edit on English</button>
                                    </div>
                                </form>
                            </div><!-- #eng -->

                            <div class="tab-pane fade" id="ita" role="tabpanel" aria-labelledby="contact-tab">
                                <form @submit.prevent="submit('it')">
                                    <div class="form-group">
                                        <label for="address2">Address</label>
                                        <input type="text" name="address" class="form-control" id="address2" placeholder="address" v-model="settingIta.address">
                                        <small class="form-text text-muted" v-if="error != null && error.address">{{ error.address[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="title2">Title</label>
                                        <input type="text" name="title" class="form-control" id="title2" placeholder="Title" v-model="settingIta.title">
                                        <small class="form-text text-muted" v-if="error != null && error.title">{{ error.title[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="keywords2">Keywords</label>
                                        <input type="text" name="keywords" class="form-control" id="keywords2" placeholder="Keywords" v-model="settingIta.keywords">
                                        <small class="form-text text-muted" v-if="error != null && error.keywords">{{ error.keywords[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <ckeditor
                                                v-model="settingIta.desc"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.desc[0] }}</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Footer text</label>
                                        <ckeditor
                                                v-model="settingIta.footer"
                                                :config="config">
                                        </ckeditor>
                                        <small class="form-text text-muted" v-if="error != null && error.desc">{{ error.footer[0] }}</small>
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
    import swal from 'sweetalert2';
    import Switches from 'vue-switches';
    import Ckeditor from 'vue-ckeditor2';

    export default {
        data(){
          return {
              setting: {},
              settingIta: {},
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
            this.getSetting('en');
            this.getSetting('it');
        },
        methods: {
            getSetting(locale){
                axios.get('api/settings/1/edit?locale=' + locale)
                    .then(res => {
                        if(res.data.setting != null){
                            if(locale == 'en'){
                                this.setting = res.data.setting;
                            }else{
                                this.settingIta = res.data.setting;
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
                    data = this.setting;
                }else{
                    data = this.settingIta;
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
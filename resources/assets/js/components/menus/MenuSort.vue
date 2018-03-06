<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Home</router-link></li>
                            <li><router-link tag="a" :to="'/menus'">Menus</router-link></li>
                            <li>Menus sort</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <ul class="sortable">
                        <draggable v-model="links" :options="{group:'people'}" @start="drag=true" @end="drag=false" @change="updateLinks()">
                            <li v-for="element in links" :key="element.id">
                                {{element.title}}
                                <font-awesome-icon class="float-right" icon="bars"/>
                            </li>
                        </draggable>
                    </ul>
                    <button class="btn btn-success" @click="save()">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert2';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
    import draggable from 'vuedraggable';

    export default {
        data(){
            return {
                links: []
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon,
            'draggable': draggable
        },
        created(){
            this.getMenuLinks();
        },
        methods: {
            getMenuLinks(){
                axios.get('api/menu-links?id=' + this.$route.params.id)
                    .then(res => {
                        this.links = res.data.menuLinks;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            updateLinks(){
                this.links.map((link, index) => {
                    link.order = index + 1;
                })
            },
            save(){
                axios.post('api/menu-links/' + this.$route.params.id + '/order', {links: this.links})
                    .then(res => {
                        swal({
                            position: 'center',
                            type: 'success',
                            title: 'Success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                    .catch(e => {
                        console.log(e);
                    });
            }
        },
    }
</script>
<template>
    <div id="place">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcrumbs">
                        <ul class="list-group list-group-flush">
                            <li><router-link tag="a" :to="'/home'">Početna</router-link></li>
                            <li>Arhi klub</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">ime</th>
                                <th scope="col">email</th>
                                <th scope="col">grad</th>
                                <th scope="col">kreiran</th>
                                <th>akcija</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in architects">
                                <td>{{ row.id }}</td>
                                <td>{{ row.name }}</td>
                                <td>{{ row.email }}</td>
                                <td>{{ row.city }}</td>
                                <td>{{ row.created_at }}</td>
                                <td>
                                    <font-awesome-icon icon="pencil-alt" @click="editRow(row['id'])"/>
                                    <font-awesome-icon icon="times" @click="deleteRow(row)" />
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <paginate-helper :paginate="paginate" @clickLink="clickToLink($event)"></paginate-helper>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PaginateHelper from '../helper/PaginateHelper.vue';
    import swal from 'sweetalert2';
    import FontAwesomeIcon from '@fortawesome/vue-fontawesome';

    export default {
        data(){
            return {
                architects: {},
                paginate: {}
            }
        },
        components: {
            'font-awesome-icon': FontAwesomeIcon
        },
        created(){
            this.getArchi();
        },
        methods: {
            getArchi(){
                axios.get('api/architects')
                    .then(res => {
                        this.architects = res.data.architects.data;
                        this.columns = res.data.columns;
                        this.paginate = res.data.architects;
                        console.log(res.data.architects);
                    })
                    .catch(e => {
                        console.log(e);
                    });
            },
            editRow(id){
                this.$router.push('architects/' + id + '/edit');
            },
            deleteRow(row){
                swal({
                    title: 'Da li ste sigurni?',
                    text: "Nećete moći da povratite radnju!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#51d2b7',
                    cancelButtonColor: '#fb9678',
                    confirmButtonText: 'Da, obriši ga!',
                    cancelButtonText: 'Odustani'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('api/architects/' + row.id)
                            .then(res => {
                                this.architects = this.architects.filter(function (item) {
                                    return row.id != item.id;
                                });
                                swal(
                                    'Obrisano!',
                                    'Arhitekta je uspešno obrisan.',
                                    'success'
                                );
                            })
                            .catch(e => {
                                console.log(e);
                            });
                    }
                });
            },
            clickToLink(index){
                axios.get('api/architects?page=' + index)
                    .then(res => {
                        this.architects = res.data.architects.data;
                        this.paginate = res.data.architects;
                    })
                    .catch(e => {
                        console.log(e);
                    });
            }
        }
    }
</script>
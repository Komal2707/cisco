<template>
    <div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">SAP ID :</label>
                        <input v-model="router_details.sap_id" type="text" value class="form-control" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Host Name :</label>
                        <input v-model="router_details.hostname" type="text" value class="form-control" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Type :</label>
                        <v-select
                            label="name"
                            :options="meta.router_types"
                            :on-change="routerTypeChange"
                        ></v-select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Loop-Back :</label>
                        <input v-model="router_details.loopback" type="text" value class="form-control" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">MAC Address :</label>
                        <input v-model="router_details.mac_address" type="text" value class="form-control" />
                    </div>
                </div>
            </div>
            </div>
            <div class="box-footer">
            <button @click="submitRouterDetails" type="button" class="btn btn-primary">Submit</button>
            </div>
    </div>
</template>

<script>

    // import BankAccountBasicDetails from './BankAccountBasicDetails';

    export default {
        // components: {BankAccountBasicDetails},
        props:['router','meta'],

        data(){
            return {
                router_details: {
                    'id' : null,
                    'sap_id' : null,
                    'hostname' : null,
                    'type' : null,
                    'loopback' : null,
                    'mac_address' : null,
                }
            };
        },

        mounted: function(){

            if( this.router ){
                this.router_details.id = this.router.id;
                this.router_details.sap_id = this.router.sap_id;
                this.router_details.hostname = this.router.hostname;
                this.router_details.type = this.router.type;
                this.router_details.loopback = this.router.loopback;
                this.router_details.mac_address = this.router.mac_address;
            }

        },
        
        methods:{
            submitFormValidation: function() {

                if( !this.router_details.sap_id )
                    return notyf.alert( 'Please enter the sap-id')

                if( !this.router_details.hostname )
                    return notyf.alert( 'Please enter the hostname')

                if( !this.router_details.type )
                    return notyf.alert( 'Please enter the type')

                if( !this.router_details.loopback )
                    return notyf.alert( 'Please enter the loopback')

                if( !this.router_details.mac_address )
                    return notyf.alert( 'Please enter the MAC Address')

                return true;
            },

            routerTypeChange: function(selected) {
                this.router_details.type = selected.name;
            },

            submitRouterDetails: function() {
                if(this.submitFormValidation()) {
                    axios.post('/admin/cisco/router/store/', { router : this.router_details }).then( function (response) {
                        if( response.data.id ) {
                            if( this.router_details.id )
                                notyf.confirm('Router Record Updated Succesfully');
                            else
                                notyf.confirm('Router Record Created Succesfully');
                            setTimeout(function(){ window.location.href = "/admin/cisco/lists/router/"; }, 1000);
                        }
                    }.bind(this));
                }
            }
        },

    }
</script>
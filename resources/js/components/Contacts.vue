<template>
    <div>
        <h1>Add Contact</h1>
        <hr>
        <form action="#" @submit.prevent="edit ? updateContact(contact.id) : createContact()">
            <div class="form-group">
                <label for="">Name</label>
                <input v-model="contact.name" type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input v-model="contact.email" type="text" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Phone</label>
                <input v-model="contact.phone" type="text" name="phone" class="form-control">
            </div>
            <div class="form-group">
                <button v-show="!edit" type="submit" class="btn btn-primary">New Contact</button>
                <button v-show="edit" type="submit" class="btn btn-primary">Update Contact</button>
            </div>
        </form>
        <h1>Contacts</h1>
        <ul class="list-group mb-5">
            <li class="list-group-item" v-for="contact in list">
                <ul class="list-group">
                    <li class="list-group-item">{{ contact.name }}</li>
                    <li class="list-group-item">{{ contact.email }}</li>
                    <li class="list-group-item">{{ contact.phone }}</li>
                    <li class="list-group-item">
                        <button @click="showContact(contact.id)" class="btn btn-primary">Edit</button>
                        <button @click="deleteContact(contact.id)" class="btn btn-danger">Delete</button>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            edit: false,
            list: [],
            contact: {
                id: '',
                name: '',
                email: '',
                phone: '',
            }
        }
    },
    mounted: function(){
        console.log('Contacts Component Loaded...');
        this.fetchContactList();
    },
    methods: {
        fetchContactList: function(){
            console.log('Fetching Contacts...');
            axios.get('api/contacts')
                .then((response) => {
                    console.log(response.data); 
                    this.list = response.data;
                }).catch((error) => {
                    console.log(error);
                });
            return;
        },
        createContact: function(){
            console.log('creating contact');
            let self = this;
            let params = Object.assign({}, self.contact);
            axios.post('api/contact/store', params)
                .then(function(){
                    self.contact.name = '';
                    self.contact.email = '';
                    self.contact.phone = '';
                    self.edit = false;
                    self.fetchContactList();
                }).catch(function(error){
                    console.log(error);
                });
            return;
        },
        showContact: function(id){
            let self = this;
            axios.get('api/contact/' + id)
                .then(function(response){
                    self.contact.id = response.data.id;
                    self.contact.name = response.data.name;
                    self.contact.email = response.data.email;
                    self.contact.phone = response.data.phone;
                });
                self.edit = true;
        },
        updateContact: function(id){
            console.log('updating contact ' + id + '...');
            let self = this;
            let params = Object.assign({}, self.contact);
            axios.patch('api/contact/' + id, params);
            self.contact.name = '';
            self.contact.email = '';
            self.contact.phone = '';
            self.edit = false;
            self.fetchContactList();
        },
        deleteContact: function(id){
            axios.delete('api/contact/' + id)
                .catch((error) => {
                    console.log(error); 
                });
            this.fetchContactList();
        }
    },
}
</script>
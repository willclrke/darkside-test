<template>
    <div>
        <form @submit.prevent="submitForm">
            <label for="name">Name:</label>
            <input v-model="formData.name" type="text" id="name">
            <label for="email">Email:</label>
            <input v-model="formData.email" type="email" id="email">
            <label for="phone">Phone:</label>
            <input v-model="formData.phone" type="tel" id="phone">
            <label for="address">Address:</label>
            <input v-model="formData.address" type="text" id="address">
            <button type="submit">Submit</button>
        </form>
        <div v-if="message" :class="{'alert alert-success': isSuccess, 'alert alert-danger': !isSuccess}">
            {{ message }}
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            formData: {
                name: '',
                email: '',
                phone: '',
                address: ''
            },
            message: '',
            isSuccess: false
        };
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('/submit', this.formData);
                this.message = response.data.success;
                this.isSuccess = true;
                this.formData = {}; // Reset form data
            } catch (error) {
                this.message = error.response.data.errors.file[0];
                this.isSuccess = false;
            }
        }
    }
};
</script>

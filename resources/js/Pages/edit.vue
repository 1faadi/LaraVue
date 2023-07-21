<script setup>
import {useForm} from "@inertiajs/vue3";
import {router} from "@inertiajs/vue3";

const props=defineProps({
    errors:Object,
    customer:Object,
})
const form=useForm({
    name:props.customer.name,
    email:props.customer.email,
    phone:props.customer.phone,
})
function submit(id){
    router.put('/customers/'+id,form)
}
</script>

<template>
    <div class="card col-6 offset-3">
        <div class="card-header">
            Edit the User
        </div>
        <div class="card-body">
            <form @submit.prevent="submit(customer.id)">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="name" v-model="form.name" id="name" class="form-control" >
                    <div class="text-danger text-xs" v-if="errors.name">{{ errors.name }}</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="email" class="form-control" v-model="form.email" id="email">
                    <div class="text-danger text-xs" v-if="errors.email">{{ errors.email }}</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Phone</label>
                    <input type="number" class="form-control" v-model="form.phone" id="phone">
                    <div class="text-danger text-xs" v-if="errors.phone">{{ errors.phone }}</div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</template>

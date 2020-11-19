<template>
    <div>
        <b-overlay :show="!show" rounded="sm">
            <b-form @submit="onSubmit" @reset="onReset">

                <b-form-group
                    id="numberGroup"
                    label="Your number:"
                    label-for="Enter number"
                    description="We show you nearest number after submit."
                >
                    <b-form-input
                        id="numberInput"
                        v-model="form.number"
                        type="number"
                        required
                        :placeholder="String(fib(Math.floor(Math.random() * 10) + 1))"
                    >
                    </b-form-input>
                </b-form-group>
                <b-alert style="margin: 10px" v-if="form.result" variant="success" show>Your number is: {{form.result}}</b-alert>
                <b-button :disabled="!show" style="margin: auto" type="submit" variant="primary">Submit</b-button>
            </b-form>
        </b-overlay>
    </div>
</template>


<script>
    import axios from 'axios'
    export default {
        data() {
            return {
                form: {
                    number: '',
                    result: ''
                },
                show: true,
            }
        },
        methods: {
            onSubmit(evt) {
                evt.preventDefault()
                let self = this;

                axios.post('/api/fibo/' + this.form.number)
                    .then(function (resp) {
                        self.form.result = resp.data['result'];
                        self.show = true;
                    })
                    .catch(function (resp) {
                        alert(resp)
                    });
                this.form.result = result;
            },
            onReset(evt) {
                evt.preventDefault()
                this.show = false
                this.form.number = '';
                this.$nextTick(() => {
                    this.show = true
                })
            },
            fib(n) {
                let a = 1;
                let b = 1;
                for (let i = 3; i <= n; i++) {
                    let c = a + b;
                    a = b;
                    b = c;
                }
                return b;
            }
        }
    }
</script>

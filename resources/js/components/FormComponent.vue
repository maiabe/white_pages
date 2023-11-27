
<template>
    <form :action="actionRoute" method="POST">
        {{ entry }}
        <!-- Axios library automatically handles CSRF for any form submissions -->
        <div v-for="field in entry" class="form-group" :key="field.name">
            <label :for="field.name">{{ field.displayName }}</label>

            <input v-if="field.type=='text'"
                    :name="formValues[field.key]"
                    :type="field.type"
                    :value="field.value"
                    class="form-control"
            />
            <select v-if="field.type=='select'"
                    class="form-select form-control"
                    :name="formValues[field.name]" >
                <option v-for="option in field.options" :key="option">{{ option }}</option>
            </select>
        </div>
    </form>
</template>

<script>
    export default {
        props: {
            method: {
                type: String
            },
            entry: {
                type: Object,
                /* required: true, */
            },
            actionRoute: {
                type: String,
                /* required: true, */
            },
            routeParam: {
                type: String
            },
            submitButtonId: {
                type: String,
            }
        },
        data() {
            return {
                formValues: {},
            }
        },
        mounted() {
            const button = document.getElementById(this.submitButtonId); 
            button.addEventListener('click', this.submitForm);
        },
        methods: {
            getFormAction() {
                console.log(this.formValues);
                const resultRoute = this.actionRoute.replace('dynamicDeptGrp', URI.encode(this.formValues));
                console.log(resultRoute);
                return resultRoute;
            },
            /* async submitForm(e) {
                try {
                        const response = await axios.put(this.actionRoute, this.entry, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json',
                        },
                    });

                    console.log(response.data); // Handle the response as needed

                } catch (error) {
                    console.error('Error submitting form:', error);
                }
            } */
            submitForm(e) {
                e.preventDefault();
                const formObj = this;

                console.log(formObj);
                console.log(e.target);
                const form = e.target.closest('.modal-content').querySelector('form');
                console.log(form);
                console.log(this.routeParam);
                console.log(this.entry);
                console.log(this.formValues);
                

                const formInputs = form.querySelectorAll('.form-control');
                console.log(formInputs);
                const formObject = {};
                formInputs.forEach(input => {
                    formObject[input.name] = input.value;
                    
                });
                console.log(formObject);

                axios.post(this.actionRoute, formObject)
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(
                        'axios error'
                    );
                    console.log(error); 
                });

                /* console.log(this.method);
                form.method = this.method;
                
                this.actionRoute = this.actionRoute.replace('dynamicDeptGrp', formObject);

                /* form.submit(); */
            }
        }
    }
</script>
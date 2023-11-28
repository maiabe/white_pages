
<template>
    <form method="POST">
        <!-- Axios library automatically handles CSRF for any form submissions -->
        <div v-for="field in entry" class="form-group">
            <label :for="field.name">{{ field.displayName }}</label>
            <input v-if="field.inputType=='text'"
                    :v-model="entry[field.key]"
                    :name="field.name"
                    :type="field.inputType"
                    :value="field.value"
                    class="form-control"
            />
            <select v-if="field.inputType=='select'"
                    :v-model="entry[field.key]"
                    class="form-select form-control"
                    :name="field.name" >
                <option v-for="option in field.options" :selected="field.value === option">{{ option }}</option>
            </select>
        </div>
    </form>
</template>

<script>
    export default {
        props: {
            entry: {
                type: Object,
                /* required: true, */
            },
            actionRoute: {
                type: String,
                /* required: true, */
            },
            submitButtonId: {
                type: String,
            }
        },
        /* data() {
            const formData = {};
            const fieldTypes = {};

            console.log(this.entry);
            for (const key of Object.keys(this.entry)) {
                const fieldName = this.entry[key].name;
                const fieldType = this.entry[key].type;
                formData[fieldName] = this.entry[key].value;
                fieldTypes[fieldName] = fieldType;
            }
            console.log(formData);
            return {
                model: this.entry,
            };
        }, */
        mounted() {
            const button = document.getElementById(this.submitButtonId); 
            button.addEventListener('click', this.submitForm);
        },
        methods: {
            submitForm(e) {
                e.preventDefault();
                console.log(e.target);

                const form = e.target.closest('.modal-content').querySelector('form');
                console.log(form);
                
                const formInputs = form.querySelectorAll('.form-control');
                console.log(formInputs);
                const formObject = {};
                formInputs.forEach(input => {
                    formObject[input.name] = input.value;
                });
                console.log(formObject);

                console.log(this.entry);
                const formData = {};
                for(const field in this.entry) {
                    const fieldName = this.entry[field].name;
                    formData[fieldName] = this.entry[field].value;
                }

                console.log(formData);

                axios.post(this.actionRoute, formData)
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(
                        'axios error'
                    );
                    console.log(error); 
                });
            },
        }
    }
</script>
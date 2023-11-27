<template>
    <!-- Create form -->
    <!-- <FormComponent
        :method="'POST'"
        :entry="entry"
        :actionRoute="actionRoute"
        :routeParam="'deptGrp'"
        :submitButtonId="submitButtonId"
    /> -->
    <form method="POST">
        <!-- Axios library automatically handles CSRF for any form submissions -->
        <div v-for="field in entry" class="form-group">
            <label :for="field.name">{{ field.displayName }}</label>
            
            <input v-if="field.type=='text'"
                    :name="field.name"
                    :type="field.type"
                    :value="field.value"
                    class="form-control"
            />
            <select v-if="field.type=='select'"
                    class="form-select form-control"
                    :name="field.name" >
                <option v-for="option in field.options" :key="option">{{ option }}</option>
            </select>
        </div>
    </form>

</template>

<script>
    import FormComponent from '../FormComponent.vue';

    export default {
        name: 'EditComponent',
        props: {
            entry: {
                type: Object
            },
            actionRoute: {
                type: String
            },
            submitButtonId: {
                type: String
            }
        },
        components: {
            FormComponent
        },
        data() {
            const viewObject = this.entry;
            const fields = Object.keys(viewObject);
            const fieldVals = Object.values(viewObject);
            console.log(fields);
            console.log(fieldVals);
            const result = {};
            fields.forEach((field, i) => {
                result[field] = fieldVals[i]['value'];
            });
            console.log(result);

            const route = this.actionRoute.replace('dynamicDeptGrp', JSON.stringify(result));
            console.log(route);

            return {
                formObject: result,
                formRoute: route
            }
        },
        mounted() {
            const button = document.getElementById(this.submitButtonId);
            button.addEventListener('click', this.submitFormTest);
        },
        methods: {
            submitForm(e) {
                e.preventDefault();
                const formObj = this;

                console.log(formObj);
                console.log(e.target);
                const form = e.target.closest('.modal-content').querySelector('form');
                console.log(form);
                console.log(this.entry);
                
                const formInputs = form.querySelectorAll('.form-control');
                console.log(formInputs);
                const formObject = {};
                formInputs.forEach(input => {
                    formObject[input.name] = input.value;
                    
                });
                console.log(formObject);
                const formRoute = this.actionRoute.replace('dynamicDeptGrp', {dept_grp: JSON.stringify(formObject)});
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
            },
            async submitFormTest(e) {
                const form = e.target.closest('.modal-content').querySelector('form');
                const formInputs = form.querySelectorAll('.form-control');
                const formData = {};
                formInputs.forEach(input => {
                    formData[input.name] = input.value;
                });
                try {
                    const response = await axios.post('/dept_groups/update', {
                        formData: JSON.stringify(formData),
                    }, 
                    {
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    }
                    );

                    // handle success
                    console.log(response.data);
                } catch (error) {
                    // handle error
                    console.error(error);
                }
            },
        }
    }
</script>